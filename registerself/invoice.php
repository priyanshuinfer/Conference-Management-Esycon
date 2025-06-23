<?php
session_start();
include 'db_connection.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit();
}

$user_id = $_SESSION['user_id'];

// Fetch full name
$stmt = $conn->prepare("SELECT TRIM(CONCAT_WS(' ', first_name, middle_initial, last_name, suffix)) AS full_name FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($full_name);
$stmt->fetch();
$stmt->close();

// Count submitted papers
$stmt = $conn->prepare("SELECT COUNT(*) AS paper_count FROM papers WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();
$paper_count = $result['paper_count'] ?? 0;

// Calculate invoice
$base_fee = 5000;
$discount_rate = ($paper_count > 1) ? 0.25 : 0;
$discount_amount = $base_fee * $discount_rate;
$total_due = $base_fee - $discount_amount;
$invoice_id = strtoupper(uniqid("INV"));
$date = date("d M Y");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>ESYCON Invoice</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .invoice-box {
      max-width: 800px;
      margin: auto;
      padding: 30px;
      border: 1px solid #ccc;
      border-radius: 10px;
      background-color: #fff;
    }
    .invoice-header {
      text-align: center;
      border-bottom: 2px solid #007bff;
      margin-bottom: 20px;
    }
    .invoice-footer {
      margin-top: 30px;
      font-size: 14px;
      text-align: center;
      color: #666;
    }
    .credits {
      margin-top: 30px;
      font-size: 13px;
      color: #444;
      text-align: center;
    }
    .btn-download {
      margin-top: 20px;
      text-align: center;
    }
    #pdf-template {
      display: none;
    }
  </style>
</head>
<body class="bg-light">

<div class="invoice-box mt-5">
  <div class="invoice-header">
    <img src="../esyconlog.png" style="max-width: 150px; height: auto; margin-bottom: 10px;" />

    <h3>ESYCON – Conference Management System</h3>
    <p><strong>Invoice ID:</strong> <?= $invoice_id ?> | <strong>Date:</strong> <?= $date ?></p>
  </div>

  <p><strong>Attendee Name:</strong> <?= htmlspecialchars($full_name) ?></p>
  <p><strong>Paper Submissions:</strong> <?= $paper_count ?></p>

  <table class="table table-bordered mt-3">
    <thead class="table-primary">
      <tr>
        <th>Description</th>
        <th>Amount (INR)</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Base Registration Fee</td>
        <td>₹<?= number_format($base_fee, 2) ?></td>
      </tr>
      <?php if ($discount_rate > 0): ?>
      <tr>
        <td>Discount for Multiple Submissions (<?= $discount_rate * 100 ?>%)</td>
        <td class="text-danger">-₹<?= number_format($discount_amount, 2) ?></td>
      </tr>
      <?php endif; ?>
      <tr class="table-success">
        <td><strong>Total Payable</strong></td>
        <td><strong>₹<?= number_format($total_due, 2) ?></strong></td>
      </tr>
    </tbody>
  </table>

  <div class="alert alert-info mt-4">
    <strong>Why the discount?</strong><br>
    We offer a 25% discount to attendees who submit more than one paper. This encourages active participation and broader contribution to the conference.
  </div>

  <div class="btn-download">
    <button class="btn btn-outline-primary" onclick="downloadPDF()">Download PDF Invoice</button>
  </div>

  <div class="credits">
    
  </div>
</div>

<!-- PDF Template (Hidden) -->
<!-- PDF Template (Hidden) -->
<div id="pdf-template" style="display: none;">
  <div style="padding: 30px; font-family: Arial, sans-serif;">
    <div style="text-align: center;">
      <!-- ✅ Different Logo for PDF -->
      <img src="https://via.placeholder.com/150x40?text=ESYCON+PDF+Logo" style="max-width: 150px; height: auto; margin-bottom: 10px;" alt="ESYCON PDF Logo" />
      <h2 style="margin-bottom: 5px;">Conference Registration Invoice</h2>
      <p style="margin-top: 0;">Invoice ID: <?= $invoice_id ?> | Date: <?= $date ?></p>
    </div>
    <hr style="margin: 20px 0;">
    <p><strong>Attendee Name:</strong> <?= htmlspecialchars($full_name) ?></p>
    <p><strong>Paper Submissions:</strong> <?= $paper_count ?></p>

    <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
      <tr style="background-color: #f2f2f2;">
        <th style="border: 1px solid #ccc; padding: 8px;">Description</th>
        <th style="border: 1px solid #ccc; padding: 8px;">Amount (INR)</th>
      </tr>
      <tr>
        <td style="border: 1px solid #ccc; padding: 8px;">Base Registration Fee</td>
        <td style="border: 1px solid #ccc; padding: 8px;">₹<?= number_format($base_fee, 2) ?></td>
      </tr>
      <?php if ($discount_rate > 0): ?>
      <tr>
        <td style="border: 1px solid #ccc; padding: 8px;">Discount for Multiple Submissions (<?= $discount_rate * 100 ?>%)</td>
        <td style="border: 1px solid #ccc; padding: 8px; color: red;">-₹<?= number_format($discount_amount, 2) ?></td>
      </tr>
      <?php endif; ?>
      <tr style="background-color: #e6ffee;">
        <td style="border: 1px solid #ccc; padding: 8px;"><strong>Total Payable</strong></td>
        <td style="border: 1px solid #ccc; padding: 8px;"><strong>₹<?= number_format($total_due, 2) ?></strong></td>
      </tr>
    </table>

    <p style="margin-top: 20px;">
      <strong>Why the discount?</strong><br>
      ESYCON offers a 25% discount to attendees submitting more than one paper to encourage broader participation.
    </p>

    <hr style="margin-top: 30px;">
    <p style="text-align: center; font-size: 12px;">Developed by: Shreya, Aayush, Priyanshu, Kuldeep</p>
  </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
function downloadPDF() {
  const element = document.getElementById("pdf-template").cloneNode(true);
  element.style.display = 'block';

  // Append temporarily for rendering
  document.body.appendChild(element);

  html2pdf().from(element).set({
    margin: 0.5,
    filename: '<?= $invoice_id ?>.pdf',
    image: { type: 'jpeg', quality: 0.98 },
    html2canvas: { scale: 2 },
    jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
  }).save().then(() => {
    document.body.removeChild(element);
  });
}
</script>

</body>
</html>
