<?php
session_start();
require 'db_connection.php';

$paperId = isset($_GET['paper_id']) ? intval($_GET['paper_id']) : 0;
$userId = $_SESSION['user_id'] ?? 0;

if (!$paperId || !$userId) {
    die("Invalid access.");
}

// Fetch paper title
$stmt = $conn->prepare("SELECT title FROM papers WHERE id = ?");
$stmt->bind_param("i", $paperId);
$stmt->execute();
$stmt->bind_result($title);
$stmt->fetch();
$stmt->close();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $note = trim($_POST['personal_note'] ?? '');
    $visibleToChairs = isset($_POST['visible_to_chairs']) ? 1 : 0;

    if (!empty($note)) {
        $stmt = $conn->prepare("INSERT INTO personal_notes (paper_id, user_id, note, visible_to_chairs) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iisi", $paperId, $userId, $note, $visibleToChairs);
        $stmt->execute();
        $stmt->close();
        header("Location: submitdash.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Personal Note</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background: linear-gradient(to bottom, #FFD700, #FFF);">

<!-- Navbar -->
<?php include 'navbar.php'; ?>

<div class="container mt-4 bg-white p-4 rounded shadow-sm">
    <h4 class="mb-3">Add personal note for <span class="text-primary font-weight-bold">#<?= htmlspecialchars($paperId) ?></span>: <em><?= htmlspecialchars($title) ?></em></h4>
    <p class="text-muted">Below, you can add a personal note to the paper. The note is only visible to you, not the authors or chair.</p>

    <div class="alert alert-info" role="alert">This is not a review.</div>

    <form method="post">
        <div class="form-group">
            <label for="personal_note">Personal note for paper</label>
            <textarea class="form-control" name="personal_note" id="personal_note" rows="6" required></textarea>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="visible_to_chairs" id="visible_to_chairs">
            <label class="form-check-label" for="visible_to_chairs">Conference chairs</label>
        </div>
        <button type="submit" class="btn btn-primary">Add paper note</button>
    </form>
</div>
</body>
</html>
