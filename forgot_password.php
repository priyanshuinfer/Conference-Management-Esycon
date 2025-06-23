<?php
// Initialize a message variable to display feedback to the user
$message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    // Database connection (Update credentials as needed)
    $conn = new mysqli("localhost", "root", "Pr@1106", "esycon");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if email exists in 'users' table
    $sql = "SELECT id FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Generate token & set expiration time
        $token = bin2hex(random_bytes(32));
        $expires = date("Y-m-d H:i:s", strtotime("+3 hours"));

        // Insert token into 'password_resets' table
        $sql = "INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $email, $token, $expires);
        $stmt->execute();

        // Build the reset link (for local testing, we just display it)
        $reset_link = "http://localhost/revised/reset_password.php?token=" . $token;

        $message = "
            <p style='color: green; margin-top: 16px;'>
                Reset link generated successfully!<br>
                <strong>Copy this link to reset your password:</strong><br>
                <a href='$reset_link' target='_blank' style='color: #5563de;'>$reset_link</a>
            </p>
        ";
    } else {
        $message = "<p style='color: red; margin-top: 16px;'>Email not found!</p>";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Forgot Password</title>
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
      background: #f5f7fa; /* Fallback background */
      /* Subtle background gradient & purple/blue glow */
      background: linear-gradient(to bottom right, #f5f7fa, #f9faff) no-repeat;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      color: #333;
    }
    .forgot-wrapper {
      display: flex;
      flex-wrap: wrap; /* Stacks on smaller screens */
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
    .forgot-left input[type="email"] {
      width: 100%;
      padding: 12px 16px;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 14px;
      outline: none;
      transition: border-color 0.2s;
      margin-bottom: 16px;
    }
    .forgot-left input[type="email"]:focus {
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
  </style>
</head>
<body>
  <div class="forgot-wrapper">
    <!-- LEFT: FORM -->
    <div class="forgot-left">
      <h1>Forgot Password</h1>
      <p>Enter your e-mail address, and we'll give you reset instructions.</p>

      <!-- Display any success/error messages here -->
      <?php echo $message; ?>

      <!-- If using this same file to process, action="" or action="forgot_password.php" -->
      <form action="forgot_password.php" method="POST">
        <label for="email">Enter e-mail address</label>
        <input type="email" id="email" name="email" required>

        <button type="submit">Send New Password</button>
      </form>

      <!-- Back to login link -->
      <a href="#" class="back-link">Back to login</a>
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
