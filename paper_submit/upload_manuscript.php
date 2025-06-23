<?php
$paper_id = $_GET['paper_id'] ?? '';
$paper_title = "Revolutionizing Learning: The Role of Technology in Modern Education"; // Replace with DB fetch if needed
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Manuscript</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #e6f0ff; /* Light dull blue */
        }
        .main-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-top: 30px;
        }
    </style>
</head>
<body>
    


<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #0d0820; padding: 20px 10px;">
    <a class="navbar-brand text-white" href="#">
        <img src="esyconlog.png" alt="ESY CON Logo" width="140">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link text-white font-weight-bold dropdown-toggle" href="#" id="homeDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Home
                </a>
                <div class="dropdown-menu" aria-labelledby="homeDropdown">
                    <a class="dropdown-item" href="../dashboard.php">Dashboard</a>
                    <a class="dropdown-item" href="../index.php">Logout</a>
                </div>
            </li>
            <li class="nav-item"><a class="nav-link text-white font-weight-bold" href="../submit_paper.php">Submit Paper</a></li>
            <li class="nav-item"><a class="nav-link text-white font-weight-bold" href="../travel_grants.php">Travel Grants</a></li>
            <li class="nav-item"><a class="nav-link text-white font-weight-bold" href="../register_table.php">Register</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link text-white font-weight-bold dropdown-toggle" href="#" id="accountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    My Account
                </a>
                <div class="dropdown-menu" aria-labelledby="accountDropdown">
                    <a class="dropdown-item" href="myprofile.php">My Profile</a>
                    <a class="dropdown-item" href="myemail.php">My Email Messages</a>
                    <a class="dropdown-item" href="chairing.php">Chairing</a>
                    <a class="dropdown-item" href="area_of_interest.php">My Area of Interest</a>
                    <a class="dropdown-item" href="conflict_of_interest.php">My Conflict of Interest</a>
                </div>
            </li>
            <li class="nav-item"><a class="nav-link text-white font-weight-bold" href="../help.php">Help</a></li>
        </ul>
    </div>
</nav>

<!-- MAIN CONTAINER -->
<div class="container">
    
    <div class="main-container">
        <?php include 'stepper.php'; renderStepper(3); ?>
        <h4 class="mb-3">Upload Review Manuscript for Paper ID #<?= htmlspecialchars($paper_id) ?></h4>
        <p><strong>Title:</strong> <?= htmlspecialchars($paper_title) ?></p>

        <div class="alert alert-info">
            <p>To convert other file formats, such as Microsoft Word, to PDF, you can use online services. Examples include Adobe, PDFonline or FreePDFConvert.</p>
            <p>You can now upload your review manuscript for <strong><?= htmlspecialchars($paper_title) ?></strong> until <strong>Jun 26</strong>.</p>
            <p>Accepted formats: Microsoft Word (.doc), Microsoft Open Office XML (.docx), formatted as US letter or A4 size.</p>
            <p><strong>Max file size:</strong> 20 MB. <strong>Max length:</strong> 10 pages.</p>
        </div>

        <form action="handle_upl.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="file">Upload File:</label>
                <input type="file" name="file" class="form-control-file" required>
            </div>

            <div class="form-group">
                <label for="url">Or enter a file URL:</label>
                <input type="url" name="file_url" class="form-control" placeholder="Dropbox, Google Drive, etc.">
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" name="notify_authors" class="form-check-input" id="notify">
                <label class="form-check-label" for="notify">Send email notification to authors</label>
            </div>

            <input type="hidden" name="paper_id" value="<?= htmlspecialchars($paper_id) ?>">

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-upload"></i> Upload Manuscript
            </button>
        </form>
    </div>
</div>

<!-- Optional JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
