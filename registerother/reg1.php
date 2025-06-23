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

// Fetch user profile data (only name, current affiliation, gender, and email)
$stmt = $conn->prepare("SELECT CONCAT(title, ' ', first_name, ' ', middle_initial, ' ', last_name, ' ', suffix) as full_name, current_affiliation, gender, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($full_name, $current_affiliation, $gender, $email);
$stmt->fetch();
$stmt->close();

// Fetch all authors for the dropdown
$authors = [];
$result = $conn->query("SELECT id, CONCAT(title, ' ', first_name, ' ', middle_initial, ' ', last_name, ' ', suffix) as full_name FROM users");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $authors[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>17th IEEE MCSOC-2024 Registration</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>


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

    <!-- Header Section -->
    <div class="container mt-3">
        <div class="bg-warning p-4 rounded text-center">
            <h1 class="h4">17th IEEE International Symposium on Embedded Multicore/Many-core Systems-on-Chip (MCSOC-2024)</h1>
            <p class="mb-0">December 16 - 19, 2024, Kuala Lumpur, Malaysia</p>
        </div>
    </div>

    <!-- Navigation Section -->
    
    <!-- Breadcrumb -->
    <div class="container mt-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light p-2 rounded">
                <li class="breadcrumb-item"><a href="#">Conference</a></li>
                <li class="breadcrumb-item"><a href="#">Register</a></li>
                <li class="breadcrumb-item active" aria-current="page">Register person</li>
            </ol>
        </nav>
    </div>

    <!-- Form Section -->
    <div class="container mt-3">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="h5 mb-3">Register person</h2>
                <form>
                    <div class="mb-3">
                        <label for="email" class="form-label">Name or email address or EDAS ID</label>
                        <input type="text" class="form-control" id="email" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="co-authors" class="form-label">Or select from co-authors</label>
                        <div class="mb-3">
    <label for="co-authors" class="form-label">Select Author</label>
    <select class="form-select" id="co-authors" name="co_authors">
        <option value="">-- select from co-authors --</option>
        <?php foreach ($authors as $author): ?>
            <option value="<?php echo $author['id']; ?>">
                <?php echo htmlspecialchars($author['full_name']); ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

                    </div>
                    <button type="submit" class="btn btn-primary">Register new person</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <div class="container mt-3">
        <div class="text-center small text-muted">
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
