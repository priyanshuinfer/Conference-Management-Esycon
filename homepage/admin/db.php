<?php
$host = 'localhost';
$db   = 'esycon';
$user = 'root';  // Default for XAMPP
$pass = 'Pr@1106';      // Default is empty
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
