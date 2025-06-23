<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "Pr@1106";
$dbname = "esycon";

// Check user session
if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access. Please login.");
}

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

// Get paper ID from query parameter
if (!isset($_GET['paper_id'])) {
    die("Paper ID not provided.");
}
$paper_id = intval($_GET['paper_id']);

// Fetch paper title
$stmt = $conn->prepare("SELECT title, non_preferred_reviewers FROM papers WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $paper_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    die("Paper not found or access denied.");
}
$paper = $result->fetch_assoc();
$title = $paper['title'];
$current_reviewers = $paper['non_preferred_reviewers'] ?? "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reviewers = $_POST['non_preferred_reviewers'] ?? "";
    $stmt = $conn->prepare("UPDATE papers SET non_preferred_reviewers = ? WHERE id = ? AND user_id = ?");
    $stmt->bind_param("sii", $reviewers, $paper_id, $user_id);
    if ($stmt->execute()) {
        header("Location: submitdash.php");
        exit();
    } else {
        echo "Error saving reviewers.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Non-Preferred Reviewers</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
            padding: 30px;
        }
        .reviewer-container {
            background: white;
            padding: 25px;
            border-radius: 10px;
            max-width: 800px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h4 {
            font-weight: 600;
        }
    </style>
</head>
<body>
<div class="reviewer-container">
    <h4>Add non-preferred reviewers for #<?= $paper_id ?>: <?= htmlspecialchars($title) ?></h4>
    <p class="text-muted">Specify the names, institutions, or emails of reviewers you prefer not to review your paper.</p>

    <form method="post">
        <div class="form-group">
            <label for="non_preferred_reviewers"><strong>Non-preferred reviewers</strong></label>
            <textarea class="form-control" id="non_preferred_reviewers" name="non_preferred_reviewers" rows="6" required><?= htmlspecialchars($current_reviewers) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save Reviewers</button>
        <a href="submitdash.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
