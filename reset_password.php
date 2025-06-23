<?php
/******************************************************
 * RESET PASSWORD LOGIC
 ******************************************************/
$message = ""; // To display status/debug info

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve POST data
    $token       = $_POST["token"];
    $new_password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Connect to DB
    $conn = new mysqli("localhost", "root", "Pr@1106", "esycon");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // 1) Check if the token is passed in the URL
    if (!isset($_GET['token'])) {
        $message .= "<p style='color:red;'>No token received in URL!</p>";
    } else {
        $message .= "<p>Token received: <strong>" . $_GET['token'] . "</strong></p>";
    }

    // 2) Validate token (must exist & not be expired)
    $sql = "SELECT email FROM password_resets WHERE token = ? AND expires_at > NOW()";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->fetch();
    $stmt->close();

    if ($email) {
        $message .= "<p style='color:green;'>Token is valid and not expired for: $email</p>";
        // TODO: Update user’s password in the `users` table if desired:
        /*
        $update_sql = "UPDATE users SET password = ? WHERE email = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ss", $new_password, $email);
        if ($update_stmt->execute()) {
            $message .= "<p style='color:green;'>Password updated successfully!</p>";
            // Optionally delete the token from password_resets
            $delete_sql = "DELETE FROM password_resets WHERE token = ?";
            $delete_stmt = $conn->prepare($delete_sql);
            $delete_stmt->bind_param("s", $token);
            $delete_stmt->execute();
        } else {
            $message .= "<p style='color:red;'>Error updating password.</p>";
        }
        */
    } else {
        $message .= "<p style='color:red;'>Invalid or expired token!</p>";
    }

    // 3) For debugging: Check if token exists at all
    $sql = "SELECT * FROM password_resets WHERE token = ?";
    $stmt = $conn->prepare($sql);
    $tokenFromUrl = $_GET['token'] ?? "";
    $stmt->bind_param("s", $tokenFromUrl);

    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $message .= "<p>Token found in DB! Expires at: " . $row['expires_at'] . "</p>";
    } else {
        $message .= "<p style='color:red;'>Token not found in DB!</p>";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Reset Password</title>
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    /* RESET */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(to bottom right, #f5f7fa, #f9faff);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #333;
    }
    .forgot-wrapper {
      display: flex;
      flex-wrap: wrap;
      width: 90%;
      max-width: 900px;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.08);
      overflow: hidden;
    }
    /* LEFT SECTION: Form */
    .forgot-left {
      flex: 1 1 400px;
      padding: 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .forgot-left h1 {
      font-size: 24px;
      font-weight: 600;
      margin-bottom: 8px;
    }
    .forgot-left p {
      font-size: 14px;
      color: #666;
      margin-bottom: 16px;
    }
    .forgot-left label {
      display: block;
      margin-bottom: 6px;
      font-size: 14px;
      font-weight: 500;
      color: #333;
    }
    .forgot-left input[type="password"] {
      width: 100%;
      padding: 12px 16px;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 14px;
      outline: none;
      transition: border-color 0.2s;
      margin-bottom: 16px;
    }
    .forgot-left input[type="password"]:focus {
      border-color: #5563de;
    }
    .forgot-left button {
      width: 100%;
      padding: 12px 16px;
      background: #5563de;
      border: none;
      border-radius: 4px;
      color: #fff;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.3s;
    }
    .forgot-left button:hover {
      background: #4553c6;
    }
    .forgot-left a.back-link {
      display: inline-block;
      margin-top: 16px;
      color: #5563de;
      text-decoration: none;
      font-size: 14px;
    }
    .forgot-left a.back-link:hover {
      text-decoration: underline;
    }
    /* RIGHT SECTION: Icons/Illustration */
    .forgot-right {
      flex: 1 1 300px;
      background: linear-gradient(135deg, rgba(85,99,222,0.05), rgba(85,99,222,0.15));
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
      min-height: 300px;
    }
    /* Icon Grid Container */
    .icon-grid {
      display: grid;
      grid-template-columns: 80px 80px;
      grid-template-rows: 80px 80px;
      gap: 20px;
      opacity: 0.8;
    }
    .icon-box {
      border: 2px solid #5563de;
      border-radius: 8px;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 32px;
      color: #5563de;
      font-weight: bold;
    }
    .icon-box span {
      pointer-events: none;
    }
    /* MEDIA QUERIES */
    @media (max-width: 768px) {
      .forgot-right {
        flex: 1 1 100%;
        min-height: 200px;
      }
      .icon-grid {
        grid-template-columns: 60px 60px;
        grid-template-rows: 60px 60px;
      }
      .icon-box {
        font-size: 24px;
      }
    }
    /* MESSAGE STYLES */
    .message-box {
      margin-bottom: 16px;
      font-size: 14px;
      line-height: 1.4;
    }
  </style>
</head>
<body>
  <div class="forgot-wrapper">
    <!-- LEFT: FORM -->
    <div class="forgot-left">
      <h1>Reset Password</h1>
      <p>Please enter a new password for your account.</p>

      <!-- Display any success/error/debug messages -->
      <div class="message-box"><?php echo $message; ?></div>

      <form method="POST">
        <!-- Hidden token field (taken from $_GET['token']) -->
        <input type="hidden" name="token" value="<?php echo isset($_GET['token']) ? htmlspecialchars($_GET['token']) : ''; ?>">
        
        <label for="password">New Password</label>
        <input type="password" id="password" name="password" required placeholder="Enter new password">
        
        <button type="submit">Reset Password</button>
      </form>
      <!-- Back to login link (update href as needed) -->
      <a href="index.php" class="back-link">Back to login</a>
    </div>

    <!-- RIGHT: ICONS/GRAPHICS -->
    <div class="forgot-right">
      <div class="icon-grid">
        <div class="icon-box">
          <span>?</span>
        </div>
        <div class="icon-box">
          <span>&#9993;</span> <!-- Envelope symbol -->
        </div>
        <div class="icon-box">
          <span>&#9998;</span> <!-- Pencil/edit symbol -->
        </div>
        <div class="icon-box">
          <span>&#9992;</span> <!-- Airplane symbol -->
        </div>
      </div>
    </div>
  </div>
</body>
</html>
