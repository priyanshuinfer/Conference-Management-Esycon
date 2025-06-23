<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "Pr@1106";
$dbname = "esycon";

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access. Please login.");
}

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT 
            p.id AS paper_id,
            p.title, p.abstract,
            p.keyword1, p.keyword2, p.keyword3,
            p.keyword4, p.keyword5, p.keyword6,
            p.personal_notes, p.non_preferred_reviewers,
            p.manuscript_filename, p.predicted_track,
            u.first_name, u.last_name,
            u.current_affiliation, u.email
        FROM papers p
        JOIN users u ON p.user_id = u.id
        WHERE p.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if (!$row = $result->fetch_assoc()) {
    echo "No paper found for this user.";
    exit();
}

$paper_id = $row['paper_id'];

// Predict track based on keywords
function predictTrack($keywords) {
    $keywords = array_filter(array_map('strtolower', $keywords));
    $all = implode(' ', $keywords);

    if (preg_match('/ai|machine learning|deep learning|neural/', $all)) return "AI";
    if (preg_match('/biomedical|health|bio|medical/', $all)) return "Biomedical Engineering";
    if (preg_match('/control|robotics|automation/', $all)) return "Control Systems";

    return "General";
}

$keywords = [
    $row['keyword1'], $row['keyword2'], $row['keyword3'],
    $row['keyword4'], $row['keyword5'], $row['keyword6']
];
$predicted_track = predictTrack($keywords);

// Save predicted track if not already saved
if ($row['predicted_track'] !== $predicted_track) {
    $update_track_sql = "UPDATE papers SET predicted_track = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_track_sql);
    $update_stmt->bind_param("si", $predicted_track, $paper_id);
    $update_stmt->execute();
    $update_stmt->close();
}

// Check for other papers in the same track by this user
$track_sql = "SELECT COUNT(*) FROM papers WHERE user_id = ? AND id != ? AND predicted_track = ?";
$track_stmt = $conn->prepare($track_sql);
$track_stmt->bind_param("iis", $user_id, $paper_id, $predicted_track);
$track_stmt->execute();
$track_stmt->bind_result($same_track_count);
$track_stmt->fetch();
$track_stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Paper Submission</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f9f9f9; }
        .container {
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            margin-top: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .info-label { font-weight: bold; }
        .section-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }
        .highlight-blue {
            background-color: #e6f2ff;
            border-bottom: 2px dotted #007bff;
            padding: 2px 4px;
            border-radius: 3px;
        }
        .edit-icon {
            color: #007bff;
            margin-left: 10px;
            cursor: pointer;
        }
        .edit-icon:hover { color: #0056b3; }
    </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container">
    <?php include 'stepper.php'; renderStepper(2); ?>

    <h2 class="section-title">User ID: #<?= $user_id ?></h2>

    <p><span class="info-label">Author:</span> <span class="highlight-blue"><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></span></p>
    <p><span class="info-label">Affiliation:</span> <span class="highlight-blue"><?= htmlspecialchars($row['current_affiliation']) ?></span></p>
    <p><span class="info-label">Email:</span> <span class="highlight-blue"><?= htmlspecialchars($row['email']) ?></span></p>

    <hr>

    <p><span class="info-label">Paper Title:</span> 
        <span class="highlight-blue"><?= htmlspecialchars($row['title']) ?></span>
        <a href="edit_title.php?paper_id=<?= $paper_id ?>" class="edit-icon"><i class="fas fa-edit"></i></a>
    </p>

    <p><span class="info-label">Abstract:</span><br><?= nl2br(htmlspecialchars($row['abstract'])) ?></p>

    <p><span class="info-label">Keywords:</span>
        <?= htmlspecialchars($row['keyword1']) ?>;
        <?= htmlspecialchars($row['keyword2']) ?>;
        <?= htmlspecialchars($row['keyword3']) ?>;
        <?= htmlspecialchars($row['keyword4']) ?>;
        <?= htmlspecialchars($row['keyword5']) ?>;
        <?= htmlspecialchars($row['keyword6']) ?>
    </p>

    <p><span class="info-label">Predicted Track:</span> 
        <span class="highlight-blue"><?= htmlspecialchars($predicted_track) ?></span>
    </p>

    <hr>

    <div class="mt-4">
        <h5>Additional Options</h5>
        <a href="add_notes.php?paper_id=<?= $paper_id ?>" class="btn btn-outline-dark mb-2">Add/Edit Personal Notes</a><br>
        <a href="add_reviewers.php?paper_id=<?= $paper_id ?>" class="btn btn-outline-dark mb-2">Add/Edit Non-Preferred Reviewers</a>
    </div>

    <hr>

    <?php if ($same_track_count > 0): ?>
        <div class="alert alert-danger mt-4 text-center" role="alert">
            <i class="fas fa-ban text-danger mr-2"></i>
            You have already submitted a paper in the <strong><?= htmlspecialchars($predicted_track) ?></strong> track. You cannot submit another.
        </div>
    <?php else: ?>
        <a href="upload_manuscript.php?paper_id=<?= $paper_id ?>" class="btn btn-outline-dark">
            <i class="fas fa-file-upload"></i> Submit Paper
        </a>
    <?php endif; ?>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
