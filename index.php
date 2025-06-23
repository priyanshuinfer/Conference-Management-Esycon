<?php
// You can add any PHP logic here if needed in the future
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>EsyCon | Conference Management System</title>
</head>
<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form id="signUpForm">
                <h1>Create Account</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
              
            </form>
        </div>
        <div class="form-container sign-in">
        <form id="signInForm" action="Login.php" method="post">
                <div class="auth-protection">
                    <i class="fa-solid fa-lock"></i>
                    <span>Protected with Google Authenticator</span>
                </div> <br>

                <input type="email" id="signInEmail" name="email" placeholder="Email" required autocomplete="off">
                <input type="text" id="signInPassword" name="telephone" placeholder="Password" required autocomplete="off">
                <?php if (isset($_SESSION['show_2fa_setup']) && $_SESSION['show_2fa_setup']): ?>
    <p>Scan this QR code with Google Authenticator app:</p>
    <img src="<?php echo $_SESSION['qr_code_url']; ?>" alt="QR Code"><br>
    Enter the 6-digit code from the app: <input type="text" name="totp_code" maxlength="6" required><br>
  <?php elseif (isset($_SESSION['require_2fa_code']) && $_SESSION['require_2fa_code']): ?>
    Enter your 2FA code: <input type="text" name="totp_code" maxlength="6" required><br>
  <?php endif; ?>

  <button type="submit">Verify</button>
                


            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right " style="background-color: #0d0820; color: white;">
                <img src="new.png" alt="EsyCon Logo" class="logo">
                <!-- Add the logo here -->
                    <h1>EsyCon</h1>
                    <p>If you do not have an ESYCON login, you can</p>
                    <a href="registernew.php" class="button-link">
                       <button class="hidden" id="register">Create a new account</button>
                    </a>
                    <p>If you have difficulties, please contact <span style="font-weight: bold; color: white;">help@esycon.info</span></p>
                    </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
