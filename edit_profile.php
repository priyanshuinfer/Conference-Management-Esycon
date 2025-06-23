<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "Pr@1106";
$dbname = "esycon";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

// Fetch user details from the database
$stmt = $conn->prepare("SELECT first_name, current_affiliation, gender, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->store_result(); // Store the result before fetching
$stmt->bind_result($first_name, $current_affiliation, $gender, $email);
$stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Update user information
    $updated_first_name = $_POST['first_name'];
    $updated_affiliation = $_POST['current_affiliation'];
    $updated_gender = $_POST['gender'];
    $updated_email = $_POST['email'];

    $update_stmt = $conn->prepare("UPDATE users SET first_name = ?, current_affiliation = ?, gender = ?, email = ? WHERE id = ?");
    $update_stmt->bind_param("ssssi", $updated_first_name, $updated_affiliation, $updated_gender, $updated_email, $user_id);
    $update_stmt->execute();
    $update_stmt->close();

    header("Location: myprofile.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile | EsyCon</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Remove default margin and padding for body */
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #E0E0E0, #FFFFFF);
            color: #333;
        }

        .navbar {
            background-color: #0d0820;
            padding: 20px 10px;
            position: fixed;  /* Make navbar fixed to the top */
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            z-index: 1000;  /* Ensures navbar stays on top */
        }

        .navbar-brand img {
            width: 140px;
        }

        .navbar-nav .nav-link {
            color: white;
            font-weight: bold;
        }

        .navbar-nav .nav-item:hover {
            background-color: #4c3c75;
        }

        .navbar-nav .nav-item {
            padding: 10px;
        }

        .navbar-toggler-icon {
            color: white;
        }

        .container {
            max-width: 850px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-top: 100px;  /* Add margin top to avoid content getting hidden behind navbar */
        }

        .form-group label {
            font-weight: bold;
            color: #444;
        }

        h2 {
            text-align: center;
            font-size: 2.2rem;
            color: #0056b3;
            margin-bottom: 40px;
            font-weight: 600;
        }

        .btn {
            background-color: #0056b3;
            color: white;
            font-size: 16px;
            font-weight: 500;
            border-radius: 50px;
            padding: 12px;
            text-transform: uppercase;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn:hover {
            background-color: #003d7a;
            transform: translateY(-2px);
        }

        .btn:active {
            transform: translateY(2px);
        }

        .form-control {
            border-radius: 5px;
            box-shadow: inset 0 1px 3px rgba(0,0,0,.12), inset 0 0 0 1px rgba(0,0,0,.07);
            border: 1px solid #ddd;
            font-size: 16px;
            padding: 15px;
        }

        .form-control:focus {
            border-color: #0056b3;
            box-shadow: 0 0 5px rgba(0, 86, 179, .5);
        }

        .profile-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding: 10px;
        }

        .profile-header a {
            text-decoration: none;
            color: #0056b3;
            font-size: 1.2rem;
            font-weight: bold;
        }

        .profile-header a:hover {
            text-decoration: underline;
        }

        .profile-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            transition: transform 0.3s ease;
        }

        .profile-img:hover {
            transform: scale(1.1);
        }

        .form-row {
            margin-bottom: 20px;
        }

        .form-row .form-control {
            transition: transform 0.2s ease;
        }

        .form-row .form-control:hover {
            transform: scale(1.02);
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #0d0820; padding: 20px 10px;">
    <a class="navbar-brand text-white" href="#">
        <img src="esyconlog.png" alt="ESY CON Logo" width="140">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link text-white font-weight-bold dropdown-toggle" href="" id="homeDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Home
                </a>
                <div class="dropdown-menu" aria-labelledby="homeDropdown">
                    <a class="dropdown-item" href="dashboard.php">Dashboard</a>
                    <a class="dropdown-item" href="index.php">Logout</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white font-weight-bold" href="submit_paper.php">Submit Paper</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white font-weight-bold" href="travel_grants.php">Travel Grants</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white font-weight-bold" href="register_table.php">Register</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link text-white font-weight-bold dropdown-toggle" href="myprofile.php" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    My Account
                </a>
                <div class="dropdown-menu" aria-labelledby="accountDropdown">
                    <a class="dropdown-item" href="myprofile.php">My Profile</a>
                    <a class="dropdown-item" href="myemail.php">My Email Messages</a>
                    <a class="dropdown-item" href="mypapers.php">My Papers</a>
                    <a class="dropdown-item" href="chairing.php">Chairing</a>
                    <a class="dropdown-item" href="area_of_interest.php">My Area of Interest</a>
                    <a class="dropdown-item" href="conflict_of_interest.php">My Conflict of Interest</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white font-weight-bold" href="help.php">Help</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="profile-header">
        <h2>Edit Profile</h2>
        <a href="myprofile.php">
            <img src="https://cdn-icons-png.flaticon.com/512/1827/1827951.png" alt="Back to Profile" class="profile-img">
        </a>
    </div>

    <form method="POST" action="edit_profile.php">
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="current_affiliation">Current Affiliation</label>
                <input type="text" class="form-control" id="current_affiliation" name="current_affiliation" value="<?php echo htmlspecialchars($current_affiliation); ?>" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="gender">Gender</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="Male" <?php echo $gender == 'Male' ? 'selected' : ''; ?>>Male</option>
                    <option value="Female" <?php echo $gender == 'Female' ? 'selected' : ''; ?>>Female</option>
                    <option value="Other" <?php echo $gender == 'Other' ? 'selected' : ''; ?>>Other</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Update Profile</button>
    </form>
</div>

<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
