<?php
// db connection
$conn = new mysqli("localhost", "root", "Pr@1106", "esycon");

// PHPMailer setup
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update_status'])) {
    $paper_id = $_POST['paper_id'];
    $new_status = $_POST['status'];

    // Insert or update status
    $stmt = $conn->prepare("
        INSERT INTO paper_status (paper_id, status)
        VALUES (?, ?)
        ON DUPLICATE KEY UPDATE status = VALUES(status)
    ");
    $stmt->bind_param("is", $paper_id, $new_status);
    $stmt->execute();
    $stmt->close();

    // Send email if status is 'Selected'
    if ($new_status === "Selected") {
        $stmt_email = $conn->prepare("
            SELECT users.email, users.first_name
            FROM users
            JOIN papers ON users.id = papers.user_id
            WHERE papers.id = ?
        ");
        $stmt_email->bind_param("i", $paper_id);
        $stmt_email->execute();
        $stmt_email->bind_result($email, $first_name);
        $stmt_email->fetch();
        $stmt_email->close();

        if (!empty($email)) {
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'esycon.conference@gmail.com';       // 🔒 Use App Password here
                $mail->Password = 'tbpdkwkcyvcsqirv';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('your_gmail@gmail.com', 'ESYCON Conference Team');
                $mail->addAddress($email, $first_name);

                $mail->isHTML(true);
                $mail->Subject = 'Paper Selection Confirmation';
                $mail->Body = "
                    Dear $first_name,<br><br>
                    Congratulations! Your paper has been <strong>Selected</strong> for the conference.<br><br>
                    Regards,<br>ESYCON Conference Committee
                ";

                $mail->send();
            } catch (Exception $e) {
                error_log("Mail Error: {$mail->ErrorInfo}");
            }
        }
    }
}

// Fetch all submitted papers
$sql = "
    SELECT 
        papers.id AS paper_id,
        papers.title,
        CONCAT(users.first_name, ' ', users.middle_initial, ' ', users.last_name) AS submitted_by,
        COALESCE(paper_status.status, 'Pending') AS status
    FROM papers
    JOIN users ON papers.user_id = users.id
    LEFT JOIN paper_status ON papers.id = paper_status.paper_id
";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard – ESYCON</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome for icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
  <style>
    body { min-height: 100vh; }
    .sidebar { min-width: 200px; max-width: 200px; background: #343a40; color: #fff; }
    .sidebar .nav-link { color: #ddd; }
    .sidebar .nav-link.active { background: #495057; color: #fff; }
    .table-responsive { margin-top: 1rem; }
  </style>
</head>
<body class="d-flex">

  <!-- Sidebar -->
  <nav class="sidebar d-flex flex-column p-3">
    <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <i class="fas fa-project-diagram fa-lg me-2"></i>
      <span class="fs-5">ESYCON Admin</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="#" class="nav-link active"><i class="fas fa-file-alt me-2"></i> Submissions</a>
      </li>
      <li>
        <a href="#" class="nav-link text-white"><i class="fas fa-users me-2"></i> Users</a>
      </li>
      <li>
        <a href="#" class="nav-link text-white"><i class="fas fa-chart-bar me-2"></i> Reports</a>
      </li>
      <li>
        <a href="#" class="nav-link text-white"><i class="fas fa-cog me-2"></i> Settings</a>
      </li>
    </ul>
    <hr>
    <div class="dropdown">
      <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
        <img src="https://via.placeholder.com/32" alt="" class="rounded-circle me-2">
        <strong>Admin</strong>
      </a>
      <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
        <li><a class="dropdown-item" href="/admin/dashboard.php">Profile</a></li>

        <li><a class="dropdown-item" href="#">Sign out</a></li>
      </ul>
    </div>
  </nav>

  <!-- Main content -->
  <div class="flex-grow-1 p-4">
    <!-- Top bar -->
    <nav class="navbar navbar-expand navbar-light bg-light mb-4">
      <div class="container-fluid">
        <button class="btn btn-outline-secondary d-md-none" type="button" data-bs-toggle="collapse" data-bs-target=".sidebar">
          <i class="fas fa-bars"></i>
        </button>
        <form class="d-flex ms-auto">
          <input class="form-control me-2" type="search" placeholder="Search papers..." aria-label="Search">
          <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i></button>
        </form>
      </div>
    </nav>

    <!-- Papers table -->
    <div class="card shadow-sm">
      <div class="card-header bg-white">
        <h5 class="mb-0">Submitted Papers</h5>
      </div>
      <div class="card-body table-responsive">
        <table class="table table-hover align-middle">
          <thead class="table-light">
            <tr>
              <th>ID</th>
              <th>Title</th>
              <th>Submitted By</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['paper_id']) ?></td>
              <td><?= htmlspecialchars($row['title']) ?></td>
              <td><?= htmlspecialchars($row['submitted_by']) ?></td>
              <td>
                <form method="post" class="d-flex align-items-center">
                  <input type="hidden" name="paper_id" value="<?= $row['paper_id'] ?>">
                  <select name="status" class="form-select form-select-sm me-2" onchange="this.form.submit()">
                    <option value="Pending"    <?= $row['status']==="Pending"     ? 'selected' : '' ?>>Pending</option>
                    <option value="Selected"   <?= $row['status']==="Selected"    ? 'selected' : '' ?>>Selected</option>
                    <option value="Not Selected" <?= $row['status']==="Not Selected"? 'selected' : '' ?>>Not Selected</option>
                  </select>
                  <input type="hidden" name="update_status" value="1">
                </form>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>

  <!-- Bootstrap JS bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
