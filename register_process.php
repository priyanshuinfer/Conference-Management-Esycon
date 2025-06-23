<?php
// Database connection
$servername = "localhost";
$username = "root"; 
$password = "Pr@1106";
$dbname = "esycon"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize and retrieve POST data
$title = mysqli_real_escape_string($conn, $_POST['title'] ?? '');
$first_name = mysqli_real_escape_string($conn, $_POST['first-name'] ?? '');
$middle_initial = mysqli_real_escape_string($conn, $_POST['middle-initial'] ?? '');
$last_name = mysqli_real_escape_string($conn, $_POST['last-name'] ?? '');
$suffix = mysqli_real_escape_string($conn, $_POST['suffix'] ?? '');
$status = mysqli_real_escape_string($conn, $_POST['status'] ?? '');
$current_affiliation = mysqli_real_escape_string($conn, $_POST['current-affiliation'] ?? '');
$job_title = mysqli_real_escape_string($conn, $_POST['job-title'] ?? '');
$department = $_POST['department'] ?? '';  // New department field
$room = mysqli_real_escape_string($conn, $_POST['room'] ?? '');
$street_address = mysqli_real_escape_string($conn, $_POST['street-address'] ?? '');
$post_office = mysqli_real_escape_string($conn, $_POST['post-office'] ?? '');
$state = mysqli_real_escape_string($conn, $_POST['state'] ?? '');
$county = mysqli_real_escape_string($conn, $_POST['county'] ?? '');
$email = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
$alt_email_1 = mysqli_real_escape_string($conn, $_POST['alt-email-1'] ?? '');
$alt_email_2 = mysqli_real_escape_string($conn, $_POST['alt-email-2'] ?? '');
$alt_email_3 = mysqli_real_escape_string($conn, $_POST['alt-email-3'] ?? '');
$telephone = mysqli_real_escape_string($conn, $_POST['telephone'] ?? '');
$mobile = mysqli_real_escape_string($conn, $_POST['mobile'] ?? '');
$timezone = mysqli_real_escape_string($conn, $_POST['timezone'] ?? '');
$special_needs = isset($_POST['special-needs']) && is_array($_POST['special-needs']) ? implode(', ', $_POST['special-needs']) : '';
$shirt_size = mysqli_real_escape_string($conn, $_POST['shirt-size'] ?? '');
$gender = mysqli_real_escape_string($conn, $_POST['gender'] ?? '');

// Prepared statement to insert data into the database
$stmt = $conn->prepare("INSERT INTO users 
(title, first_name, middle_initial, last_name, suffix, status, current_affiliation, job_title, room, street_address, post_office, state, county, email, alt_email_1, alt_email_2, alt_email_3, telephone, mobile, timezone, special_needs, shirt_size, gender, department) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Make sure to add department to the bind_param() list:
$stmt->bind_param(
    "ssssssssssssssssssssssss", 
    $title, $first_name, $middle_initial, $last_name, $suffix, $status, 
    $current_affiliation, $job_title, $room, $street_address, $post_office, $state, 
    $county, $email, $alt_email_1, $alt_email_2, $alt_email_3, $telephone, 
    $mobile, $timezone, $special_needs, $shirt_size, $gender, $department
);

// Execute statement
if ($stmt->execute()) {
    // Success message HTML
    echo '
    <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f0f0f0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }
            .success-message {
                width: 300px;
                padding: 20px;
                text-align: center;
                background-color: #ffffff;
                border-radius: 10px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                border-top: 10px solid #72c668;
            }
            .success-icon {
                background-color: #72c668;
                border-radius: 50%;
                width: 80px;
                height: 80px;
                margin: 0 auto 10px auto;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .success-icon .checkmark {
                font-size: 40px;
                color: white;
            }
            h1 {
                color: #512da8;
                font-size: 24px;
                margin: 10px 0;
            }
            p {
                color: #555555;
                font-size: 16px;
            }
            .continue-button {
                background-color: #512da8;
                color: white;
                border: none;
                padding: 10px 20px;
                border-radius: 5px;
                cursor: pointer;
                margin-top: 20px;
            }
            .continue-button:hover {
                background-color: #5cb357;
            }
        </style>
    </head>
    <body>
        <div class="success-message">
            <div class="success-icon">
                <span class="checkmark">✓</span>
            </div>
            <h1>SUCCESS</h1>
            <p>Congratulations, your account has been successfully created at EsyCon.</p>
            <button class="continue-button" onclick="window.location.href=\'index.php\'">SignIn</button>
        </div>
    </body>
    </html>
    ';
} else {
    // Log the error for debugging
    error_log("MySQL error: " . $stmt->error);
    
    // Display a user-friendly message
    echo "There was an error processing your request. Please try again.";
}

$stmt->close();
$conn->close();
?>
