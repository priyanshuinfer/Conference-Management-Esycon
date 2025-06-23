<?php
session_start();
require_once 'GoogleAuthenticator.php';

$servername = "localhost";
$username = "root";
$password = "Pr@1106";
$dbname = "esycon";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$ga = new PHPGangsta_GoogleAuthenticator();

$error = '';
$showQr = false;
$showGaCodeInput = false;
$qrCodeUrl = '';
$email = '';
$telephone = '';
$step = 'initial'; // initial, setup_2fa, verify_2fa

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read posted values
    $email = htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8');
    $telephone = htmlspecialchars($_POST['telephone'] ?? '', ENT_QUOTES, 'UTF-8');
    $ga_code = htmlspecialchars($_POST['ga_code'] ?? '', ENT_QUOTES, 'UTF-8');
    $secret = $_SESSION['temp_ga_secret'] ?? '';

    // Step 1: Verify email and phone
    if (empty($email) || empty($telephone)) {
        $error = "Please enter email and telephone.";
    } else {
        $stmt = $conn->prepare("SELECT id, telephone, ga_secret FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($userId, $storedTelephone, $ga_secret);
            $stmt->fetch();

            if ($telephone !== $storedTelephone) {
                $error = "Incorrect telephone number.";
            } else {
                if (empty($ga_secret)) {
                    // 2FA not setup yet → setup flow
                    if (empty($secret)) {
                        // Generate secret and store in session
                        $secret = $ga->createSecret();
                        $_SESSION['temp_ga_secret'] = $secret;
                        $_SESSION['temp_user_id'] = $userId;
                        $_SESSION['temp_email'] = $email;
                    }

                    if (empty($ga_code)) {
                        // Show QR + input for code
                        $showQr = true;
                        $step = 'setup_2fa';
                    } else {
                        // Verify entered GA code to finalize setup
                        if ($ga->verifyCode($secret, $ga_code, 2)) {
                            // Save secret in DB
                            $stmt2 = $conn->prepare("UPDATE users SET ga_secret = ? WHERE id = ?");
                            $stmt2->bind_param("si", $secret, $userId);
                            if ($stmt2->execute()) {
                                // Setup done, login user
                                unset($_SESSION['temp_ga_secret'], $_SESSION['temp_user_id'], $_SESSION['temp_email']);
                                $_SESSION['user_id'] = $userId;
                                $_SESSION['email'] = $email;
                                header("Location: dashboard.php");
                                exit();
                            } else {
                                $error = "Database error while saving secret.";
                                $showQr = true;
                                $step = 'setup_2fa';
                            }
                            $stmt2->close();
                        } else {
                            $error = "Invalid verification code. Please try again.";
                            $showQr = true;
                            $step = 'setup_2fa';
                        }
                    }

                    // Generate QR code URL for display
                    $qrCodeUrl = $ga->getQRCodeGoogleUrl('EsyCon (' . $email . ')', $secret);

                } else {
                    // 2FA already setup → verify login code
                    if (empty($ga_code)) {
                        // Show GA code input only
                        $showGaCodeInput = true;
                        $step = 'verify_2fa';
                        $_SESSION['temp_user_id'] = $userId;
                        $_SESSION['temp_email'] = $email;
                    } else {
                        // Verify code
                        if ($ga->verifyCode($ga_secret, $ga_code, 2)) {
                            // Login success
                            $_SESSION['user_id'] = $userId;
                            $_SESSION['email'] = $email;
                            unset($_SESSION['temp_user_id'], $_SESSION['temp_email']);
                            header("Location: homepage/index.php");
                            exit();
                        } else {
                            $error = "Invalid Google Authenticator code.";
                            $showGaCodeInput = true;
                            $step = 'verify_2fa';
                            $_SESSION['temp_user_id'] = $userId;
                            $_SESSION['temp_email'] = $email;
                        }
                    }
                }
            }
        } else {
            $error = "User not found.";
        }
        $stmt->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login with 2FA</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
  background: linear-gradient(135deg, rgb(245, 247, 250), rgb(230, 236, 241));
  font-family: 'Inter', sans-serif;
  color: #333;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  min-height: 100vh;
  margin: 0;
}

.card {
  background: linear-gradient(135deg, #ffffff, #f5f7fa);
  padding: 2rem;
  border-radius: 1rem;
  width: 100%;
  max-width: 400px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
  text-align: center;
  border: 1px solid #e0e6ed;
}

h2 {
  color: #2563eb;
  margin-bottom: 1rem;
}

input[type="email"],
input[type="text"],
input[type="password"] {
  width: 100%;
  padding: 0.75rem;
  margin: 0.5rem 0;
  border: 1px solid #cbd5e1;
  border-radius: 8px;
  background-color: #f1f5f9;
  color: #111;
  transition: border-color 0.3s, background-color 0.3s;
}

input[type="email"]:focus,
input[type="text"]:focus,
input[type="password"]:focus {
  outline: none;
  border-color: #3b82f6;
  background-color: #e2e8f0;
}

input[readonly] {
  background-color: #e5e7eb;
}

.button {
  background: linear-gradient(90deg, #3b82f6, #60a5fa);
  color: white;
  border: none;
  padding: 0.8rem;
  width: 100%;
  border-radius: 0.5rem;
  margin-top: 1rem;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.3s, transform 0.2s;
}

.button:hover {
  background: linear-gradient(90deg, #2563eb, #3b82f6);
  transform: translateY(-2px);
}

.error {
  color: #dc2626;
  margin-bottom: 1rem;
}

.qr-img {
  margin: 1rem 0;
  background-color: #ffffff;
  display: inline-block;
  padding: 0.5rem;
  border-radius: 0.5rem;
  box-shadow: 0 0 6px rgba(0, 0, 0, 0.1);
}

.code-inputs {
  display: flex;
  justify-content: space-between;
  gap: 0.5rem;
  margin: 1rem 0;
}

.code-inputs input {
  flex: 1;
  text-align: center;
  font-size: 1.5rem;
  padding: 0.75rem;
  border-radius: 8px;
  border: 1px solid #cbd5e1;
  background-color: #f1f5f9;
  color: #111;
  transition: border-color 0.3s, background-color 0.3s;
}

.code-inputs input:focus {
  border-color: #3b82f6;
  background-color: #e2e8f0;
  outline: none;
}

  </style>
</head>
<body>

<div class="card">
  <h2>Login</h2>

  <?php if ($error): ?>
    <div class="error"><?php echo $error; ?></div>
  <?php endif; ?>

  <form method="POST" action="login.php">

    <?php if ($step === 'initial'): ?>
      <input type="email" name="email" required placeholder="Enter your email" value="<?php echo htmlspecialchars($email); ?>">
      <input type="text" name="telephone" required placeholder="Enter your telephone" value="<?php echo htmlspecialchars($telephone); ?>">
      <button type="submit" class="button">Next</button>

    <?php elseif ($step === 'setup_2fa'): ?>
      <p>Scan this QR code with Google Authenticator:</p>
      <div class="qr-img">
        <img src="<?php echo $qrCodeUrl; ?>" alt="QR Code">
      </div>
      <input type="text" name="ga_code" maxlength="6" pattern="\d{6}" required placeholder="Enter 6-digit code">
      <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
      <input type="hidden" name="telephone" value="<?php echo htmlspecialchars($telephone); ?>">
      <button type="submit" class="button">Verify & Enable 2FA</button>

    <?php elseif ($step === 'verify_2fa'): ?>
      <input type="email" name="email" readonly value="<?php echo htmlspecialchars($email); ?>">
      <input type="text" name="telephone" readonly value="<?php echo htmlspecialchars($telephone); ?>">
      <input type="text" name="ga_code" maxlength="6" pattern="\d{6}" required placeholder="Enter 6-digit code">
      <button type="submit" class="button">Verify & Login</button>
    <?php endif; ?>

  </form>
</div>

</body>
</html>
