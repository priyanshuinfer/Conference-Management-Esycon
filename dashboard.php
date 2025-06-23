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

// Fetch the current number for the user
$stmt = $conn->prepare("SELECT current_number, CONCAT(first_name, ' ', middle_initial, ' ', last_name) as full_name, current_affiliation, gender, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->store_result(); // Store the result before fetching
$stmt->bind_result($current_number, $full_name, $current_affiliation, $gender, $email);
$stmt->fetch();

// Increment the current number by 1131
$new_current_number = $current_number + 1131;

// Update the current number in the database
$update_stmt = $conn->prepare("UPDATE users SET current_number = ? WHERE id = ?");
$update_stmt->bind_param("ii", $new_current_number, $user_id);
$update_stmt->execute();
$update_stmt->close();

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | EsyCon</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* Custom Styles */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #ffffff, #e0e0e0);

            margin: 0;
            padding: 0;
        }
        h1, h2, p {
            text-align: left !important;
        }
        .info-container {
           margin-top: 30px;
           padding: 15px;
           background-color: #f9f9f9;
           border-radius: 8px;
           box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .info-container .alert {
           margin-bottom: 15px;
           padding: 15px;
           border-radius: 8px;
           display: flex;
           align-items: center;
           background-color: #e9f7fc;
           color: #333;
        }

        .info-container .info-icon {
            width: 30px; /* Icon size */
            height: 30px;
            transition: transform 0.3s ease, filter 0.3s ease; /* Smooth animation */
        }


        .info-container .info-icon:hover {
            transform: scale(1.2) rotate(10deg); /* Scale and rotate */
            filter: brightness(1.2); /* Slightly brighten the image */
            cursor: pointer; /* Pointer cursor */
        }
        .info-container .alert .dotted-link {
            color: #007bff;
            text-decoration: underline;
        }

        .info-container .alert .dotted-link:hover {
            color: #0056b3;
        }

        .modal-header {
            background-color: #343A40;
            color: white;
        }
        .modal-footer .btn {
            background-color: white;
            color: black;
        }
        .navbar-toggler-icon {
            background-image: none; /* Remove Bootstrap's default icon */
            border: none; /* Remove any borders */
            display: inline-block;
            width: 30px;
            height: 24px;
            position: relative;
        }

        .navbar-toggler-icon::before,
        .navbar-toggler-icon::after,
        .navbar-toggler-icon div {
            content: '';
            display: block;
            width: 100%;
            height: 4px;
            background-color: white; /* White lines */
            position: absolute;
            left: 0;
        }

        .navbar-toggler-icon div {
            top: 10px; /* Middle line */
        }

        .navbar-toggler-icon::before {
            top: 0; /* Top line */
        }

        .navbar-toggler-icon::after {
            bottom: 0; /* Bottom line */
        }
        .submissions-table th, .submissions-table td {
        vertical-align: middle;
        text-align: center;
    }

    .submissions-table tbody tr:nth-child(odd) {
        background-color: #f0f0f0; /* Light gray */
    }

    .submissions-table tbody tr:nth-child(even) {
        background-color: #ffffff; /* White */
    }

    .submissions-table a {
        text-decoration: underline dotted;
        color: #000;
    }

    .icon-btn {
        background: none;
        border: none;
        font-size: 1.2rem;
        color: #000;
        cursor: pointer;
    }

    .icon-btn:hover {
        color: #007bff;
    }

    .table-title {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 15px;
    }
    table-subtitle{
        font-size: 1.8rem;
        
        margin-bottom: 15px;

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
                <span class="navbar-toggler-icon">
                    <div></div> <!-- Middle line -->
                </span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link text-white font-weight-bold dropdown-toggle" href="" id="homeDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Home
          </a>
          <div class="dropdown-menu" aria-labelledby="homeDropdown">
            <a class="dropdown-item" href="dashboard.php">Dashboard</a>
            <a class="dropdown-item" href="index.php">Logout</a>
            <a class="dropdown-item" href="homepage/index.php">Logout</a>
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

<!-- Main Content -->
<div class="container mt-4 p-4 bg-white shadow-lg rounded">
    <h1 class="title text-left">Esy-Con Conference Management System</h1>
    <p class="text-left">Welcome, <strong><?php echo htmlspecialchars($full_name); ?></strong>!</p>
    <p class="text-left">Click on the menu items above to submit and review papers.</p>

    <!-- Profile Table -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover align-middle mt-4">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Current</th>
                    <th scope="col">ESYCON Identifier</th>
                    <th scope="col">Name</th>
                    <th scope="col">Affiliation</th>
                    <th scope="col">Email</th>
                    <th scope="col">This is a different person!</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $new_current_number; ?></td>
                    <td>#</td>
                    <td><?php echo htmlspecialchars($full_name); ?></td>
                    <td><?php echo htmlspecialchars($current_affiliation); ?></td>
                    <td><?php echo htmlspecialchars($email); ?></td>
                    <td><span class="icon">👥</span></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Information Boxes -->
    <div class="info-container">
        <?php
        $info_messages = [
            "Please indicate whether you want to receive   <a href='#'>occasional email updates</a>    about new ESYCON features.",
            "Papers in which <a href='#'class='dotted-link'>languages</a> can you review?",
            "Your personalized list of conflicts-of-interest has not been <a href='#' class='dotted-link'>updated</a> in the last year."
        ];
        foreach ($info_messages as $message) {
            echo "<div class='alert alert-info'>
                    <img src='https://cdn3d.iconscout.com/3d/premium/thumb/warning-3d-icon-download-in-png-blend-fbx-gltf-file-formats--alert-error-alarm-attention-basic-user-interface-v2-pack-icons-9148349.png' alt='Info' class='info-icon'>
                    <strong></strong> $message
                  </div>";
        }
        ?>
    </div>

    <!-- Recent Emails Section -->
    <h2 class="professional-header text-left">Recent Email Messages</h2>
    <input type="text" class="form-control mb-3" placeholder="Search Recent Emails">
    <div class="table-responsive">
        <table class="table recent-email table-striped table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Date</th>
                    <th>Conference or Journal</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo date('d M Y H:i:s'); ?></td>
                    <td>[ESYCON] Setting up your ESYCON account password</td>
                    <td>Important information about your account setup.</td>
                </tr>
                <tr>
                    <td><?php echo date('d M Y H:i:s'); ?></td>
                    <td>ESYCON email reachability test - please ignore</td>
                    <td>This is a system-generated test email.</td>
                </tr>
            </tbody>
        </table>
    </div>
   <h2 class="table-title">My pending, active and accepted papers</h2>
   <h6 class="table-subtitle">Only papers for upcoming and recently-concluded conferences and journal issues are shown.

</h6>

<div class="table-responsive">
    <table class="table table-bordered submissions-table">
        <thead>
            <tr>
                <th>Conference</th>
                <th>Paper title (details)</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Add/Delete Authors</th>
                <th>Withdraw</th>
                <th>Review Manuscript</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $conn = new mysqli($servername, $username, $password, $dbname);
        $stmt = $conn->prepare("SELECT id, title, manuscript_filename FROM papers WHERE user_id = ? LIMIT 1");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $title = htmlspecialchars($row['title']);
            $hasManuscript = !empty($row['manuscript_filename']);
            $status = $hasManuscript ? "Active (has manuscript)" : "Draft (missing manuscript)";
            $paperId = $row['id'];

            echo "<tr>
                <td><a href='#'>11th ICET<br>2025</a></td>
                <td><a href='view_paper.php?id=$paperId'>$title</a></td>
                <td>$status</td>
                <td><a href='paper_submit/edit_title.php?id=$paperId' class='icon-btn' title='Edit Paper'><i class='fas fa-pen'></i></a></td>
                <td><a href='paper_submit/submitdash.php?paper_id=$paperId' class='icon-btn' title='Add/Delete Authors'><i class='fas fa-user-plus'></i></a></td>
                <td><a href='withdraw_paper.php?id=$paperId' class='icon-btn' title='Withdraw Paper'><i class='fas fa-times-circle'></i></a></td>
                <td><a href='paper_submit/upload_manuscript.php?paper_id=$paperId' class='icon-btn' title='Review Manuscript'><i class='fas fa-cloud-upload-alt'></i><br><small>until Jun 26</small></a></td>
            </tr>";
        } else {
            echo "<tr><td colspan='7'>No papers submitted yet.</td></tr>";
        }

        $stmt->close();
        $conn->close();
        ?>
        </tbody>
    </table>
</div>
    <!-- Profile Section -->
    <div class="profile-header text-center">
        <h2 class="professional-header">My Profile 
            <a href="edit_profile.php">
                <img src="https://cdn-icons-png.flaticon.com/512/1827/1827951.png" alt="Profile Image" class="profile-img" style="width: 30px; height: 25px;">
            </a>
        </h2>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Field</th>
                    <th scope="col">Information</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Name</th>
                    <td><?php echo htmlspecialchars($full_name); ?></td>
                </tr>
                <tr>
                    <th scope="row">Current Affiliation</th>
                    <td><?php echo htmlspecialchars($current_affiliation); ?></td>
                </tr>
                <tr>
                    <th scope="row">Gender</th>
                    <td><?php echo htmlspecialchars($gender); ?></td>
                </tr>
                <tr>
                    <th scope="row">Email</th>
                    <td><?php echo htmlspecialchars($email); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>



<!-- Conference Details Modal -->
<div class="modal fade" id="conferenceDetailsModal" tabindex="-1" role="dialog" aria-labelledby="conferenceDetailsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="conferenceDetailsLabel">Conference Details</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" id="closeModalButton">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <h4>17th IEEE MCSoC-2024</h4>
                <p><strong>Date:</strong> June 17-19, 2025</p>
                <p><strong>Location:</strong> Bengaluru,India</p>
                <p>Join us for an insightful conference with leading experts in the field.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <a href="registerself/register1.php" class="btn btn-outline-primary">Register Self</a>
                <a href="registerother/reg1.php" class="btn btn-outline-primary">Register Others</a>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Automatically trigger the modal on page load
    $(document).ready(function () {
        $('#conferenceDetailsModal').modal('show');

        // Auto close the modal after 10 seconds
        setTimeout(function () {
            $('#conferenceDetailsModal').modal('hide');
        }, 10000); // 10000ms = 10 seconds
    });
</script>
</body>
</html>
