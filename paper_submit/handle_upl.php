<?php
// Include database connection
$conn = new mysqli("localhost", "root", "Pr@1106", "esycon");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$paper_id = $_POST['paper_id'] ?? '';
$notify_authors = isset($_POST['notify_authors']) ? 1 : 0;

if (!$paper_id) {
    die("Paper ID is missing.");
}

$targetDir = "uploads/";
$uploadOk = 1;
$filePath = "";

// Changed query here: Fetch full author name and email from users table, joining papers with users
$authorQuery = $conn->prepare("SELECT CONCAT(first_name, ' ', IFNULL(middle_initial, ''), ' ', last_name) AS name, email FROM users JOIN papers ON users.id = papers.user_id WHERE papers.id = ?");
$authorQuery->bind_param("i", $paper_id);
$authorQuery->execute();
$authorResult = $authorQuery->get_result();

if ($authorResult->num_rows > 0) {
    $authorData = $authorResult->fetch_assoc();
    $name = trim($authorData['name']);  // trim to remove extra spaces if middle_initial null
    $email = $authorData['email'];
} else {
    die("Author information not found for this paper.");
}

$authorQuery->close();

if (isset($_FILES["file"]) && $_FILES["file"]["error"] === UPLOAD_ERR_OK) {
    $fileName = basename($_FILES["file"]["name"]);
    $targetFilePath = $targetDir . uniqid() . "_" . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    if ($_FILES["file"]["size"] > 20000000) {
        die("Error: File is too large. Must be under 20MB.");
    }

    if (!in_array($fileType, ['doc', 'docx', 'pdf'])) {
        die("Error: Only .doc, .docx, and .pdf files are allowed.");
    }

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
        $filePath = $targetFilePath;
    } else {
        die("Error: There was a problem uploading your file.");
    }
} elseif (!empty($_POST['file_url'])) {
    $filePath = $_POST['file_url'];
} else {
    die("No file or URL provided.");
}

$stmt = $conn->prepare("UPDATE papers SET manuscript_filename = ? WHERE id = ?");
$stmt->bind_param("si", $filePath, $paper_id);

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload Confirmation</title>
    <style>
        /* Your existing styles here */
        body {
            font-family: Arial, sans-serif;
            background: #f0f4f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .confirmation-box {
            background: #ffffff;
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 400px;
            animation: fadeInUp 1s ease-out;
        }
        .tick {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: #4CAF50;
            margin: 0 auto 20px;
            position: relative;
        }
        .tick::after {
            content: '';
            position: absolute;
            top: 16px;
            left: 18px;
            width: 16px;
            height: 30px;
            border-right: 5px solid white;
            border-bottom: 5px solid white;
            transform: rotate(45deg);
            animation: tickFade 0.6s ease forwards;
        }
        @keyframes tickFade {
            from { opacity: 0; transform: rotate(45deg) scale(0.5); }
            to { opacity: 1; transform: rotate(45deg) scale(1); }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .message {
            font-size: 18px;
            margin-bottom: 15px;
            color: #333;
        }
        .link {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: background 0.3s;
        }
        .link:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
<?php
if ($stmt->execute()) {
    echo '
    <div class="confirmation-box">
        <div class="tick"></div>
        <div class="message">File uploaded and saved successfully.</div>';

    // Send email notification if checked
    if ($notify_authors) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'esycon.conference@gmail.com';           // your gmail here
            $mail->Password   = 'tbpdkwkcyvcsqirv';      // your app password here
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('your_email@gmail.com', 'EsyCon');
            $mail->addAddress($email, $name);

            $mail->isHTML(true);
            $mail->Subject = 'Confirmation of Paper Submission ESYCON';
            $mail->Body    = "
                <p>Dear <strong>$name</strong>,</p>
                <p>We are pleased to inform you that your submission has been successfully received by <strong>ESYCON</strong>.</p>
  <p>Your paper has been recorded in our system and is currently under initial verification. Our review team will now begin evaluating your submission based on its completeness, relevance, and adherence to our submission guidelines.</p>

  <h3>What Happens Next:</h3>
  <ul>
    <li>Your submission will undergo review by our expert committee.</li>
    <li>You will be notified via email once the evaluation is complete.</li>
    <li>If any corrections or additional details are needed, we will contact you.</li>
  </ul>

  <p><strong>Estimated review time:</strong> 5–7 working days</p>

  <p>If you have any questions or need to update your submission, feel free to contact us at  
     


  <p>Thank you for your valuable contribution to ESYCON. We appreciate your participation and look forward to your continued engagement.</p>

  <p>Warm regards,<br>
  <strong>Team ESYCON</strong><br>
            ";

            $mail->send();
            echo '<div class="message">Email notification sent successfully.</div>';
        } catch (Exception $e) {
            echo '<div class="message" style="color:red;">Email could not be sent. Error: ' . htmlspecialchars($mail->ErrorInfo) . '</div>';
        }
    }

    echo '<a class="link" href="submitdash.php">Back to Dashboard</a>
    </div>';
} else {
    echo '<div class="confirmation-box"><div class="message">Error saving file info to database.</div></div>';
}

$stmt->close();
$conn->close();
?>
</body>
</html>
