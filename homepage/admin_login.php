<?php
session_start();
$login_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username      = trim($_POST['username']);
    $phone         = trim($_POST['phone']);
    $captcha_input = trim($_POST['captcha']);
    $correct_captcha = $_SESSION['captcha'] ?? '';

    if ($captcha_input === $correct_captcha) {
        $_SESSION['admin'] = $username;
        header("Location: admin/admin_dashboard.php");
        exit();
    } else {
        $login_error = 'Invalid CAPTCHA. Please try again.';
    }
}

// Generate a new 5-char CAPTCHA
$captcha_code         = substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789"), 0, 5);
$_SESSION['captcha']  = $captcha_code;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>EsyCon Admin Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
  <style>
    * { box-sizing: border-box; margin:0; padding:0; }
    body {
      font-family: 'Inter', sans-serif;
      height: 100vh;
      background: linear-gradient(135deg, #1f2631, #0d1118);
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .login-card {
      background: #ffffff10;
      backdrop-filter: blur(12px);
      border-radius: 16px;
      box-shadow: 0 16px 32px rgba(0,0,0,0.5);
      width: 360px;
      padding: 32px;
      position: relative;
      overflow: hidden;
    }
    .login-card::before {
  content: '';
  position: absolute;
  top: -50%; left: -50%;
  width: 200%; height: 200%;
  background: radial-gradient(circle at center, #3a3aff55, transparent 70%);
  animation: rotate-bg 10s linear infinite;
  pointer-events: none;    /* ← add this */
}

    @keyframes rotate-bg {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }
    .login-header {
      position: relative;
      z-index: 1;
      text-align: center;
      margin-bottom: 24px;
      color: #fff;
    }
    .login-header img {
      width: 64px;
      margin-bottom: 12px;
    }
    .login-header h2 {
      font-weight: 500;
    }
    .form-group {
      position: relative;
      margin-bottom: 24px;
      z-index: 1;
    }
    .form-group input {
      width: 100%;
      padding: 16px 12px 16px 12px;
      background: #ffffff20;
      border: none;
      border-radius: 8px;
      color: #fff;
      outline: none;
      transition: background .3s;
    }
    .form-group input:focus { background: #ffffff30; }
    .form-group label {
      position: absolute;
      top: 50%; left: 12px;
      transform: translateY(-50%);
      pointer-events: none;
      color: #ddd;
      transition: top .2s, font-size .2s;
    }
    .form-group input:focus + label,
    .form-group input:not(:placeholder-shown) + label {
      top: -8px;
      font-size: 12px;
      color: #fff;
    }
    .captcha-box {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: #ffffff20;
      padding: 12px 16px;
      border-radius: 8px;
      margin-bottom: 24px;
      color: #fff;
      font-family: monospace;
      font-size: 18px;
      letter-spacing: 4px;
      z-index: 1;
    }
    .captcha-box button {
      background: none;
      border: none;
      color: #fff;
      cursor: pointer;
      font-size: 18px;
    }
    .btn-login {
      width: 100%;
      padding: 14px;
      background: #3a3aff;
      border: none;
      border-radius: 8px;
      color: #fff;
      font-size: 16px;
      font-weight: 500;
      cursor: pointer;
      transition: background .3s, transform .1s;
      z-index: 1;
    }
    .btn-login:hover { background: #2d2dbb; }
    .btn-login:active { transform: scale(.98); }
    .error-msg {
      color: #ff6b6b;
      font-size: 14px;
      text-align: center;
      margin-top: -16px;
      margin-bottom: 16px;
      z-index: 1;
    }
  </style>
</head>
<body>
  <div class="login-card">
    <div class="login-header">
      <img src="new.png" alt="EsyCon Logo">
      <h2>Admin Portal</h2>
    </div>
    <form method="POST">
      <div class="form-group">
        <input type="text" name="username" id="user" placeholder=" " required>
        <label for="user">Username</label>
      </div>
      <div class="form-group">
        <input type="text" name="phone" id="phone" placeholder=" " required>
        <label for="phone">Phone Number</label>
      </div>
      <div class="captcha-box">
        <span><?php echo $_SESSION['captcha']; ?></span>
        <button type="button" onclick="location.reload();" title="Reload CAPTCHA">
          &#x21bb;
        </button>
      </div>
      <div class="form-group">
        <input type="text" name="captcha" id="cap" placeholder=" " required>
        <label for="cap">Enter CAPTCHA</label>
      </div>
      <?php if ($login_error): ?>
        <div class="error-msg"><?php echo $login_error; ?></div>
      <?php endif; ?>
      <button type="submit" class="btn-login">Log In</button>
    </form>
  </div>
</body>
</html>
