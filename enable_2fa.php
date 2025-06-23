<?php
session_start();
require_once 'GoogleAuthenticator.php';

if (!isset($_SESSION['user_id_temp'])) {
    header("Location: login.php");
    exit();
}

$ga = new PHPGangsta_GoogleAuthenticator();

$servername = "localhost";
$username = "root";
$password = "Pr@1106";
$dbname = "esycon";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$userId = $_SESSION['user_id_temp'];
$email = $_SESSION['email_temp'];

// Generate or get existing secret for this session (don't save to DB yet)
if (!isset($_SESSION['ga_secret_temp'])) {
    $_SESSION['ga_secret_temp'] = $ga->createSecret();
}
$secret = $_SESSION['ga_secret_temp'];

// Generate QR code URL
$qrCodeUrl = $ga->getQRCodeGoogleUrl('EsyCon (' . $email . ')', $secret);

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = htmlspecialchars($_POST['ga_code'] ?? '', ENT_QUOTES, 'UTF-8');

    if ($ga->verifyCode($secret, $code, 2)) {
        // Save secret in DB permanently
        $stmt = $conn->prepare("UPDATE users SET ga_secret = ? WHERE id = ?");
        $stmt->bind_param("si", $secret, $userId);
        if ($stmt->execute()) {
            $success = "Two-factor authentication enabled successfully! You can now <a href='login.php'>login</a>.";
            // Cleanup temp session vars
            unset($_SESSION['user_id_temp'], $_SESSION['email_temp'], $_SESSION['ga_secret_temp']);
        } else {
            $error = "Database error while saving secret.";
        }
        $stmt->close();
    } else {
        $error = "Invalid code. Please try again.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head><title>Enable Two-Factor Authentication</title></head>
<body>
<h2>Enable Two-Factor Authentication (2FA)</h2>

<?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>
<?php if ($success) { echo "<p style='color:green;'>$success</p>"; exit; } ?>

<p>Scan this QR code with your Google Authenticator app:</p>
<img src="<?php echo $qrCodeUrl; ?>" alt="QR Code"><br><br>

<form method="POST" action="enable_2fa.php">
    Enter the 6-digit code from your app: <input type="text" name="ga_code" maxlength="6" pattern="\d{6}" required>
    <button type="submit">Verify & Enable</button>
</form>
</body>
</html>
