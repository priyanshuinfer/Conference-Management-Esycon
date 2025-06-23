<?php
require('../fpdf/fpdf.php');
session_start();
require_once 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized Access");
}

$user_id = $_SESSION['user_id'];

// Fetch full name from the database
$stmt = $conn->prepare("SELECT CONCAT(first_name, ' ', middle_initial, ' ', last_name) AS full_name FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($full_name);
$stmt->fetch();
$stmt->close();

if (empty($full_name)) $full_name = "Participant";

// ✅ Generate a unique certificate ID (can be hardcoded or derived from user ID)
$certificate_id = 'CERT' . str_pad($user_id, 6, '0', STR_PAD_LEFT); // e.g., CERT000123

// ✅ Verification URL (adjust domain as needed)


class PDF extends FPDF {
    function Header() {}
    function Footer() {}
}

$pdf = new PDF('L', 'mm', 'A4');
$pdf->AddPage();

// Background certificate image
$pdf->Image('certificate.png', 0, 0, 297, 210);

// Title
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 20);
$pdf->SetXY(20, 110);
$pdf->MultiCell(257, -80, "This is to certify that", 0, 'C');

// Full name in blue
$pdf->SetTextColor(0, 49, 106);
$pdf->SetFont('Arial', 'B', 28);
$pdf->SetXY(20, 120);
$pdf->MultiCell(282, -35, strtoupper($full_name), 0, 'C');

// Event info
$pdf->SetTextColor(60, 60, 60);
$pdf->SetFont('Arial', '', 18);
$pdf->SetXY(20, 140);
$pdf->MultiCell(257, -40, "has participated in the event 'EsyCon Conference 2025'", 0, 'C');

// Organizer and date
$pdf->SetFont('Arial', '', 16);
$pdf->SetXY(20, 150);
$pdf->MultiCell(257, -40, "organized by EsyCon CMS on " . date("d F Y"), 0, 'C');



// ✅ Optionally, store this certificate ID in a local file for verification use
file_put_contents('certificates.json', json_encode([$certificate_id => $full_name], JSON_PRETTY_PRINT));

$pdf->Output('I', 'EsyCon_Certificate.pdf');
?>
