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

// Check if a new profile photo has been uploaded
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_photo'])) {
    $photo_dir = "uploads/";
    $photo_file = $photo_dir . basename($_FILES["profile_photo"]["name"]);
    $upload_ok = 1;
    $image_file_type = strtolower(pathinfo($photo_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["profile_photo"]["tmp_name"]);
    if ($check !== false) {
        $upload_ok = 1;
    } else {
        echo "File is not an image.";
        $upload_ok = 0;
    }

    if (!in_array($image_file_type, ['jpg', 'jpeg', 'png', 'gif'])) {
        echo "Only JPG, JPEG, PNG & GIF files are allowed.";
        $upload_ok = 0;
    }

    if ($upload_ok && move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $photo_file)) {
        $stmt = $conn->prepare("UPDATE users SET profile_photo = ? WHERE id = ?");
        $stmt->bind_param("si", $photo_file, $user_id);
        $stmt->execute();
        $stmt->close();
    }
}

$stmt = $conn->prepare("SELECT CONCAT(first_name, ' ', middle_initial, ' ', last_name, ' ') as full_name, current_affiliation, gender, email, state, created_at, department, telephone FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($full_name, $current_affiliation, $gender, $email, $state, $created_at, $department, $telephone);
$stmt->fetch();
$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>My Profile | EsyCon</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body style="background: rgb(34,193,195); background: linear-gradient(356deg, rgba(251,132,134,1) 24%, rgba(254,206,77,1) 100%);">
    <style>
        .bg-custom {
            background-color: #0d0820 !important; /* Override Bootstrap */
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 767px) {
            .navbar-brand img {
                width: 120px;
            }

            .container {
                padding: 10px;
            }

            .table th, .table td {
                font-size: 14px;
            }

            .card-body {
                padding: 10px;
            }

            .alert {
                font-size: 14px;
            }
        }
    </style>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #0d0820; padding: 20px 10px;">
        <a class="navbar-brand text-white" href="#">
            <img src="esyconlog.png" alt="ESY CON Logo" width="140">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link text-white font-weight-bold dropdown-toggle" href="" id="homeDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Home</a>
                    <div class="dropdown-menu" aria-labelledby="homeDropdown">
                        <a class="dropdown-item" href="dashboard.php">Dashboard</a>
                        <a class="dropdown-item" href="index.php">Logout</a>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link text-white font-weight-bold" href="submit_paper.php">Submit Paper</a></li>
                <li class="nav-item"><a class="nav-link text-white font-weight-bold" href="travel_grants.php">Travel Grants</a></li>
                <li class="nav-item"><a class="nav-link text-white font-weight-bold" href="register_table.php">Register</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link text-white font-weight-bold dropdown-toggle" href="myprofile.php" id="accountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">My Account</a>
                    <div class="dropdown-menu" aria-labelledby="accountDropdown">
                        <a class="dropdown-item" href="myprofile.php">My Profile</a>
                        <a class="dropdown-item" href="myemail.php">My Email Messages</a>
                        <a class="dropdown-item" href="mypapers.php">My Papers</a>
                        <a class="dropdown-item" href="chairing.php">Chairing</a>
                        <a class="dropdown-item" href="area_of_interest.php">My Area of Interest</a>
                        <a class="dropdown-item" href="conflict_of_interest.php">My Conflict of Interest</a>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link text-white font-weight-bold" href="help.php">Help</a></li>
            </ul>
        </div>
    </nav>

    <!-- Profile Section -->
    <div class="container mt-4">
        <div class="bg-custom text-dark p-3 rounded-top d-flex justify-content-between align-items-center">
            <h5 class="text-white mb-0"><?php echo htmlspecialchars($full_name); ?></h5>
            <div>
                <a href="#" class="text-primary mr-3"><i class="fas fa-edit"></i> Edit</a>
                <a href="#" class="text-danger mr-3"><i class="fas fa-exclamation-triangle"></i> Conflicts</a>
                <a href="#" class="text-warning"><i class="fas fa-envelope"></i> List email received</a>
            </div>
        </div>

        <div class="card mt-2">
            <div class="card-body text-left">
                <table class="table">
                    <tr><th>Name</th><td><?php echo htmlspecialchars($full_name); ?></td></tr>
                    <tr><th>Telephone Number</th><td><?php echo htmlspecialchars($telephone); ?></td></tr>
                    <tr><th>Type</th><td>Student</td></tr>
                    <tr><th>Affiliation</th><td><?php echo htmlspecialchars($current_affiliation); ?></td></tr>
                    <tr><th>Email Address</th><td><?php echo htmlspecialchars($email); ?> <i class="fas fa-check-square text-success ml-2"></i><small class="text-muted">Valid Since: <?php echo htmlspecialchars($created_at); ?></small></td></tr>
                    <tr><th>Photo</th><td><i class="fas fa-camera text-primary"></i></td></tr>
                    <tr><th>Department</th><td><?php echo htmlspecialchars($department); ?></td></tr>
                    <tr><th>Languages</th><td><i class="fas fa-language text-primary"></i></td></tr>
                    <tr><th>Conflict of Interest</th><td><a href="edit_conflict.php" class="text-info"><i class="fas fa-edit"></i> Edit</a> | <a href="delete_conflict.php" class="text-danger"><i class="fas fa-trash"></i> Delete</a></td></tr>
                </table>

                <div class="alert alert-warning mt-3" role="alert">
                    <h5 class="alert-heading">Registration invoices and payments</h5>
                    <a href="#" class="text-info">17th IEEE MCSoc-2024</a>
                </div>
            </div>
        </div>

        <a href="dashboard.php" class="btn btn-secondary mt-4">Back to Dashboard</a>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
