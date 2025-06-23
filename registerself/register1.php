<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "Pr@1106";
$dbname = "esycon";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

$paper_count = 0;
$discount_eligible = false;

$stmt = $conn->prepare("SELECT COUNT(*) FROM papers WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($paper_count);
$stmt->fetch();
$stmt->close();

if (isset($_POST['pay'])) {
    $_SESSION['paper_count'] = $user_paper_count;
    $_SESSION['user_name'] = $user_name;

    // Redirect to invoice page
    header("Location: invoice.php");
    exit();
}

// Fetch user profile data (only name)
$stmt = $conn->prepare("SELECT CONCAT(' ', first_name, ' ', middle_initial, ' ', last_name, ' ', suffix) as full_name FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($full_name);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MCSoC-2024 Registration</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to bottom, #f8e6a0, #ffffff);
      font-family: Arial, sans-serif;
    }

    .navbar {
      background-color: #0d0820;
    }

    .navbar-brand img {
      width: 140px;
    }

    .nav-link {
      color: #fff !important;
    }

    .dropdown-menu a {
      color: #000 !important;
    }

    .table {
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      margin-bottom: 30px;
    }

    .table th,
    .table td {
      vertical-align: middle;
    }

    .info-banner {
      background-color: #eaf6ff;
      border-left: 4px solid #007bff;
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 5px;
    }

    .btn-register {
      background-color: #007bff;
      color: #fff;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .btn-register:hover {
      background-color: #0056b3;
    }

    .btn-register:focus {
      outline: none;
      box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.5);
    }

    .attendee-box {
      background-color: #90EE90;
      color: lightgray;
      border: 1px solid black;
      padding: 10px;
      display: inline-block;
      border-radius: 2px;
      margin-top: 20px;
    }

    .attendee-box p {
      font-weight: bold;
      color: black;
    }

    .attendee-name {
      font-weight: lighter;
    }

    .table-hover tbody tr:hover {
      background-color: #f1f1f1;
    }

    .table-bordered th, .table-bordered td {
      border: 1px solid #dee2e6;
    }

    h5 {
      color: #333;
      font-weight: bold;
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #0d0820; padding: 20px 10px;">
    <a class="navbar-brand text-white" href="#">
      <img src="new.png" alt="ESY CON Logo" width="140">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link text-white font-weight-bold dropdown-toggle" href="" id="homeDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Home
          </a>
          <div class="dropdown-menu" aria-labelledby="homeDropdown">
            <a class="dropdown-item" href="../dashboard.php">Dashboard</a>
            <a class="dropdown-item" href="index.php">Logout</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white font-weight-bold" href="submit_paper.php">Submit Paper</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white font-weight-bold" href="travel_grants.php">Travel Grants</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white font-weight-bold" href="register_table.php">Register</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link text-white font-weight-bold dropdown-toggle" href="myprofile.php" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            My Account
          </a>
          <div class="dropdown-menu" aria-labelledby="accountDropdown">
            <a class="dropdown-item" href="myprofile.php">My Profile</a>
            <a class="dropdown-item" href="myemail.php">My Email Messages</a>
            <a class="dropdown-item" href="mypapers.php">My Papers</a>
            <a class="dropdown-item" href="chairing.php">Chairing</a>
            <a class="dropdown-item" href="area_of_interest.php">My Area of Interest</a>
            <a class="dropdown-item" href="conflict_of_interest.php">My Conflict of Interest</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white font-weight-bold" href="help.php">Help</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Header -->
  <div class="text-center my-4">
  <div class="p-4 shadow-sm mx-auto" style="max-width: 1100px; background: linear-gradient(to bottom, #ffffff, #e3e6ea); color: #212529;; border: 1px solid #ddd; border-radius: 8px;">
    <h1 class="text-dark fw-bold">11th International Conference on Electrical Engineering (ICEENG)-2025</h1>
    <p class="text-secondary fs-4 fw-semibold">June 16 - 19, 2025, Bengaluru,India</p>
  </div>
</div>





  <div class="container">
    <!-- Registration Section -->
    <div class="card mb-4">
      <div class="card-header fw-semibold text-uppercase" style="background: diagonal-gradient(135deg,rgb(255, 255, 255),rgb(134, 131, 131));color: white;">
        <h5>Register for 11th International Conference on Electrical Engineering (ICEENG)</h5>
      </div>
      <div class="card-body">
        <!-- Attendee Name with Light Green Box, Black Border, Light Text, and Bold Name -->
        <div class="attendee-box">
          <p>Attendee: <span class="attendee-name"><?php echo $full_name; ?></span></p>
        </div>
        <p> - <a href="#" class="text-primary">select another</a></p>
        <div class="info-banner">
          <p><strong>Cancellations:</strong> Made by presenters will NOT be accepted. For others, when a cancellation notification is received:</p>
          <ul>
            <li><strong>Until June 16, 2025:</strong> 50% of the registration fee plus bank handling charge.</li>
            <li><strong>After June 16, 2025:</strong> 100% of the registration fee (No refund).</li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Available Registrations -->
    <h5>Available registrations</h5>
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>Event/Option</th>
          <th>Description</th>
          <th>Available for</th>
          <th>Amount</th>
          <th>Cancellation fee</th>
          <th>Covers extra pages?</th>
          <th>Register</th>
        </tr>
      </thead>
      <tbody id="available-registrations">
        <tr>
          <td>ICEENG:Student-Full-non-IEEE:Student-Full-non-IEEE</td>
          <td>ICEENG
- Student registration - Full registration - non-IEEE</td>
          <td>students who are not a member</td>
          <td>$635.00</td>
          <td>$222.50</td>
          <td>3</td>
          <td><button class="btn btn-register btn-sm" onclick="addToCart(this)">Add</button></td>
        </tr>
        <tr>
          <td>ICEENG:Student-Online-non-IEEE:Student-Online-non-IEEE</td>
          <td>ICEENG
- Student registration - Online registration - non-IEEE member</td>
          <td>students who are not a member</td>
          <td>$350.00</td>
          <td>$127.50	</td>
          <td>1</td>
          <td><button class="btn btn-register btn-sm" onclick="addToCart(this)">Add</button></td>
        </tr>
      </tbody>
    </table>

    <!-- Registered, but not paid -->
    <h5>Registered, but not paid</h5>
    <table class="table table-bordered table-hover">
      <thead>
        <tr>
          <th>Event/Option</th>
          <th>Description</th>
          <th>Available for</th>
          <th>Amount (invoice)</th>
          <th>Papers covered</th>
          <th>Cancel</th>
        </tr>
      </thead>
      <tbody id="registered-cart"></tbody>
    </table>

    
    <div class="text-end">
    <div class="text-end">
  <!-- Payment Button -->
 <form method="POST">
  <button type="submit" name="pay" class="btn btn-success">
    Pay Now
  </button>
</form>

<!-- Loading Animation (hidden by default) -->
<div id="loading-animation" 
     style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; z-index: 9999; backdrop-filter: blur(5px); width: 100%; height: 100%; background: rgba(255, 255, 255, 0.8);">
  <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
    <span class="visually-hidden">Processing...</span>
  </div>
  <p class="text-primary mt-3 fs-4">Processing your payment...</p>
</div>
  </div>

  <script>
    // JavaScript for dynamic functionality remains the same
    function addToCart(button) {
      const row = button.closest('tr');
      const cart = document.getElementById('registered-cart');
      const clonedRow = row.cloneNode(true);
      clonedRow.querySelector('button').textContent = 'Remove';
      clonedRow.querySelector('button').className = 'btn btn-danger btn-sm';
      clonedRow.querySelector('button').setAttribute('onclick', 'removeFromCart(this)');
      cart.appendChild(clonedRow);
      row.remove();
    }

    function removeFromCart(button) {
      const row = button.closest('tr');
      const available = document.getElementById('available-registrations');
      const clonedRow = row.cloneNode(true);
      clonedRow.querySelector('button').textContent = 'Add';
      clonedRow.querySelector('button').className = 'btn btn-register btn-sm';
      clonedRow.querySelector('button').setAttribute('onclick', 'addToCart(this)');
      available.appendChild(clonedRow);
      row.remove();
    }
    function showLoadingAndRedirect() {
  const cart = document.getElementById('registered-cart');
  const rows = cart.querySelectorAll('tr');

  let totalUSD = 0;

  rows.forEach(row => {
    const amountText = row.children[3].textContent.replace('$', '').trim();
    totalUSD += parseFloat(amountText);
  });

  let discount = 0;
  let discountEligible = <?php echo $discount_eligible ? 'true' : 'false'; ?>;

  if (discountEligible) {
    discount = 0.25 * totalUSD;
  }

  const totalAfterDiscount = totalUSD - discount;
  const totalINR = totalAfterDiscount * 83; // Approx USD to INR

  const invoiceHTML = `
    <p><strong>Total (USD):</strong> $${totalUSD.toFixed(2)}</p>
    ${discount > 0 ? `<p><strong>Discount (25%):</strong> -$${discount.toFixed(2)}</p>` : ''}
    <p><strong>Final Total (INR):</strong> ₹${totalINR.toFixed(2)}</p>
  `;

  document.getElementById('invoiceDetails').innerHTML = invoiceHTML;

  // Show invoice modal
  const invoiceModal = new bootstrap.Modal(document.getElementById('invoiceModal'));
  invoiceModal.show();
}

  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Invoice Popup Modal -->
<div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="invoiceModalLabel">Invoice Summary</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="invoiceDetails">
        <!-- Details added dynamically -->
      </div>
    </div>
  </div>
</div>

</body>

</html>
