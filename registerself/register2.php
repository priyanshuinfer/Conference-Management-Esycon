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

// Fetch user profile data (only name)
$stmt = $conn->prepare("SELECT CONCAT(title, ' ', first_name, ' ', middle_initial, ' ', last_name, ' ', suffix) as full_name FROM users WHERE id = ?");
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
      border: 2px solid black;
      padding: 10px;
      display: inline-block;
      border-radius: 8px;
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
      <img src="esyconlog.png" alt="ESY CON Logo" width="140">
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
  <div class="p-4 shadow-sm mx-auto" style="max-width: 1100px; background: linear-gradient(135deg, #0d0820, #5f9fff); border: 1px solid #ddd; border-radius: 8px;">
    <h1 class="text-white fw-light fs-2 mb-3">17th IEEE International Symposium on Embedded Multicore/Many-core Systems-on-Chip (MCSoC-2024)</h1>
    <p class="text-warning fs-4 fw-semibold">December 16 - 19, 2024, Kuala Lumpur, Malaysia</p>
  </div>
</div>





  <div class="container">
    <!-- Registration Section -->
    <div class="card mb-4">
      <div class="card-header bg-primary text-white">
        <h5>Register for 17th IEEE MCSoC-2024</h5>
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
            <li><strong>Until November 30, 2024:</strong> 50% of the registration fee plus bank handling charge.</li>
            <li><strong>After November 30, 2024:</strong> 100% of the registration fee (No refund).</li>
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
          <td>MCSoCAuthor-non-IEEE-member</td>
          <td>MCSoC - for authors only - For non-IEEE members</td>
          <td>Attendees who are not a member</td>
          <td>$635.00</td>
          <td>Cannot be canceled</td>
          <td>0</td>
          <td><button class="btn btn-register btn-sm" onclick="addToCart(this)">Add</button></td>
        </tr>
        <tr>
          <td>MCSoCExtra-page</td>
          <td>MCSoC - For extra pages $50 USD/page</td>
          <td>All</td>
          <td>$50.00</td>
          <td>Cannot be canceled</td>
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
      <button class="btn btn-primary btn-lg">Pay</button>
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
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
