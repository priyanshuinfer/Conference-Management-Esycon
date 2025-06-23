<?php
session_start();
include 'navbar.php';

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

$paper_id = $_GET['paper_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $abstract = $_POST['abstract'];
    $keywords = [$_POST['keyword1'], $_POST['keyword2'], $_POST['keyword3'], $_POST['keyword4'], $_POST['keyword5'], $_POST['keyword6']];
    

    $sql = "UPDATE papers SET title=?, abstract=?, keyword1=?, keyword2=?, keyword3=?, keyword4=?, keyword5=?, keyword6=? WHERE id=?";
    $stmt = $conn->prepare($sql);
   $stmt->bind_param("ssssssssi", 
    $title, 
    $abstract, 
    $keywords[0], 
    $keywords[1], 
    $keywords[2], 
    $keywords[3], 
    $keywords[4], 
    $keywords[5], 
    $notes, 
    
);

    $stmt->execute();
    header("Location: submitdash.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM papers WHERE id = ?");
$stmt->bind_param("i", $paper_id);
$stmt->execute();
$result = $stmt->get_result();
$paper = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Paper Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
        }
        .container-box {
            background: #ffffff;
            padding: 30px;
            margin-top: 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        h2 {
            color: #333;
        }
        textarea {
            resize: vertical;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="container-box">
        <h2 class="mb-4">Edit Paper Details</h2>
        <form method="POST">
            <div class="form-group">
                <label for="title"><strong>Paper Title</strong></label>
                <input type="text" class="form-control" name="title" value="<?= htmlspecialchars($paper['title']) ?>" required>
            </div>

            <div class="form-group">
                <label for="abstract"><strong>Abstract</strong></label>
                <textarea class="form-control" name="abstract" rows="5" required><?= htmlspecialchars($paper['abstract']) ?></textarea>
            </div>

            <?php for ($i = 1; $i <= 6; $i++): ?>
                <div class="form-group">
                    <label for="keyword<?= $i ?>"><strong>Keyword <?= $i ?></strong></label>
                    <input type="text" class="form-control" name="keyword<?= $i ?>" value="<?= htmlspecialchars($paper["keyword$i"]) ?>">
                </div>
            <?php endfor; ?>

            

            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="submitdash.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
