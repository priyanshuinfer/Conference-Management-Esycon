<?php
$conn = new mysqli("localhost", "root", "Pr@1106", "esycon");

function predictTrack($keywords) {
    $keywords = array_filter(array_map('strtolower', $keywords));
    $all = implode(' ', $keywords);
    if (preg_match('/ai|machine learning|deep learning|neural/', $all)) return "AI";
    if (preg_match('/biomedical|health|bio|medical/', $all)) return "Biomedical Engineering";
    if (preg_match('/control|robotics|automation/', $all)) return "Control Systems";
    return "General";
}

$result = $conn->query("SELECT id, keyword1, keyword2, keyword3, keyword4, keyword5, keyword6 FROM papers");

while ($row = $result->fetch_assoc()) {
    $keywords = [
        $row['keyword1'], $row['keyword2'], $row['keyword3'],
        $row['keyword4'], $row['keyword5'], $row['keyword6']
    ];
    $track = predictTrack($keywords);
    $update = $conn->prepare("UPDATE papers SET predicted_track = ? WHERE id = ?");
    $update->bind_param("si", $track, $row['id']);
    $update->execute();
}

echo "Tracks updated.";
$conn->close();
?>
