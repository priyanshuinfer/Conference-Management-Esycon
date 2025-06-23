<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


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
$title = $_POST['title'];
$abstract = $_POST['abstract'];
$keywords = [
    $_POST['keyword1'], $_POST['keyword2'], $_POST['keyword3'],
    $_POST['keyword4'], $_POST['keyword5'], $_POST['keyword6']
];

// Track keyword mapping
$track_keywords = [
    "Biomedical Engineering" => ['bioinstrumentation', 'biomechanics', 'medical imaging', 'biomaterials', 'healthcare'],
    "Computer Engineering and Artificial Intelligence" => ['ai', 'artificial intelligence', 'machine learning', 'data science', 'computer architecture', 'software'],
    "Control Systems and Automation" => ['control', 'robotics', 'automation', 'intelligent systems'],
    "Electrical Engineering Poster" => ['poster', 'preliminary', 'emerging topics'],
    "Electrical Power Engineering" => ['power generation', 'transmission', 'distribution', 'smart grid', 'renewable'],
    "Electron Devices, Circuits and Systems" => ['circuit', 'embedded', 'analog', 'digital'],
    "Microwave, Antennas and Propagation" => ['microwave', 'antenna', 'rf', 'propagation']
];

// Predict track
$predicted_track = "Uncategorized";
foreach ($track_keywords as $track => $track_terms) {
    foreach ($keywords as $kw) {
        foreach ($track_terms as $term) {
            if (stripos($kw, $term) !== false) {
                $predicted_track = $track;
                break 3; // Stop all loops if a match is found
            }
        }
    }
}

// Check if the user has already submitted a paper in the predicted track
$check_sql = "SELECT COUNT(*) FROM papers WHERE user_id = ? AND predicted_track = ?";
$check_stmt = $conn->prepare($check_sql);
$check_stmt->bind_param("is", $user_id, $predicted_track);
$check_stmt->execute();
$check_stmt->bind_result($count);
$check_stmt->fetch();
$check_stmt->close();

session_start(); // Make sure this is at the top of the file if not already present
if ($count > 0) {
    $_SESSION['error_message'] = "You have already submitted a paper in the \"$predicted_track\" track. Duplicate submissions are not allowed.";
    header("Location: submitdash.php");
    exit();
}


// Proceed with paper submission
$insert_sql = "INSERT INTO papers (user_id, title, abstract, keyword1, keyword2, keyword3, keyword4, keyword5, keyword6, predicted_track)
               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$insert_stmt = $conn->prepare($insert_sql);
$insert_stmt->bind_param("isssssssss", $user_id, $title, $abstract, 
                         $keywords[0], $keywords[1], $keywords[2], 
                         $keywords[3], $keywords[4], $keywords[5], 
                         $predicted_track);

if ($insert_stmt->execute()) {
    $new_paper_id = $insert_stmt->insert_id;
    header("Location: submitdash.php?paper_id=$new_paper_id");
    exit();
} else {
    echo "Error: " . $conn->error;
}

$insert_stmt->close();
$conn->close();
?>
