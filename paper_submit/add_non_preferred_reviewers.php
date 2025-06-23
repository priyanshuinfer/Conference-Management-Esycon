<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Set your MySQL password if any
$dbname = "esycon";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get paper ID
$paper_id = isset($_GET['paper_id']) ? intval($_GET['paper_id']) : 0;
if ($paper_id <= 0) {
    die("Invalid paper ID.");
}

// Get paper details
$sql = "SELECT title, non_preferred_reviewers FROM papers WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $paper_id);
$stmt->execute();
$result = $stmt->get_result();

if (!$result || $result->num_rows === 0) {
    die("Paper not found.");
}

$paper = $result->fetch_assoc();
$stmt->close();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $non_preferred = $_POST['non_preferred_reviewers'] ?? '';

    $update = $conn->prepare("UPDATE papers SET non_preferred_reviewers = ? WHERE id = ?");
    $update->bind_param("si", $non_preferred, $paper_id);
    if ($update->execute()) {
        header("Location: submitdash.php");
        exit();
    } else {
        echo "Error updating record.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Non-Preferred Reviewers</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #0d0820; padding: 20px 10px;">
    <a class="navbar-brand text-white" href="#">
        <img src="esyconlog.png" alt="ESY CON Logo" width="140">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link text-white font-weight-bold dropdown-toggle" href="#" id="homeDropdown" role="button" data-toggle="dropdown">
                    Home
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="../dashboard.php">Dashboard</a>
                    <a class="dropdown-item" href="../index.php">Logout</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white font-weight-bold" href="../submit_paper.php">Submit Paper</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white font-weight-bold" href="../travel_grants.php">Travel Grants</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white font-weight-bold" href="../register_table.php">Register</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link text-white font-weight-bold dropdown-toggle" href="../myprofile.php" id="accountDropdown" role="button" data-toggle="dropdown">
                    My Account
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="myprofile.php">My Profile</a>
                    <a class="dropdown-item" href="myemail.php">My Email Messages</a>
                    <a class="dropdown-item" href="chairing.php">Chairing</a>
                    <a class="dropdown-item" href="area_of_interest.php">My Area of Interest</a>
                    <a class="dropdown-item" href="conflict_of_interest.php">My Conflict of Interest</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white font-weight-bold" href="../help.php">Help</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Main Content -->
<div class="container mt-4">
    <h4 class="mb-3">Add Non-Preferred Reviewers for #<?= htmlspecialchars($paper_id) ?>: <?= htmlspecialchars($paper['title']) ?></h4>
    <div class="alert alert-info">Below, you can list reviewers you prefer to exclude from reviewing this paper. This is only visible to chairs and is not shared with authors.</div>

    <form method="POST">
        <div class="form-group">
            <label for="non_preferred_reviewers">List of Non-Preferred Reviewers</label>
            <textarea name="non_preferred_reviewers" id="non_preferred_reviewers" rows="5" class="form-control"><?= htmlspecialchars($paper['non_preferred_reviewers'] ?? '') ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save Non-Preferred Reviewers</button>
        <a href="submitdash.php" class="btn btn-secondary ml-2">Cancel</a>
    </form>
</div>

</body>
</html>