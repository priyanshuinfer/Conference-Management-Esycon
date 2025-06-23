<?php
$servername = "localhost";
$username = "root";
$password = "Pr@1106"; // Use your actual MySQL password if it's set
$dbname = "esycon"; // Replace with your actual database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
