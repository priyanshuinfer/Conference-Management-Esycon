<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help for EDAS</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body style="background: linear-gradient(356deg, rgba(251,132,134,1) 24%, rgba(254,206,77,1) 100%);">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #0d0820; padding: 15px;">
    <a class="navbar-brand text-white" href="#">
        <img src="esyconlog.png" alt="ESY CON Logo" width="120">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link text-white font-weight-bold dropdown-toggle" href="#" id="homeDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Home
                </a>
                <div class="dropdown-menu" aria-labelledby="homeDropdown">
                    <a class="dropdown-item" href="dashboard.php">Dashboard</a>
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
                <a class="nav-link text-white font-weight-bold dropdown-toggle" href="myprofile.php" id="accountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
            <li class="nav-item">
                <a class="nav-link text-white font-weight-bold" href="help.php">Help</a>
            </li>
        </ul>
    </div>
</nav>

<!-- Main Content -->
<div class="container my-4 bg-white p-4 shadow-sm rounded">
    <h2>Help for <br>ESYCON Help</h2>
    <p>For problems with ESYCON itself, <a href="#" class="text-primary" style="text-decoration: dotted underline;">contact the help staff</a>.</p>
    <p>The <a href="#" class="text-primary" style="text-decoration: dotted underline;">manual</a> provides a background on ESYCON features and operations.</p>

    <!-- Search Form -->
    <form class="mt-4">
        <div class="form-row">
            <div class="form-group col-md-6">
                <input type="text" class="form-control" id="searchFaq" placeholder="Search FAQ for">
            </div>
            <div class="form-group col-md-6">
                <select class="form-control" id="topic">
                    <option>-- any topic --</option>
                    <option>Topic 1</option>
                    <option>Topic 2</option>
                    <option>Topic 3</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
        <p class="mt-2"><a href="#" class="text-primary" style="text-decoration: dotted underline;">All frequently asked questions</a>.</p>
    </form>

    <hr>

    <!-- Icons Section -->
    <h4>Icons</h4>
    <div class="row text-center">
        <!-- Icons adjusted for responsiveness -->
        <div class="col-6 col-md-3 mb-3">
            <i class="fas fa-edit" style="font-size: 30px;"></i>
            <div>Edit</div>
        </div>
        <div class="col-6 col-md-3 mb-3">
            <i class="fas fa-trash-alt" style="font-size: 30px;"></i>
            <div>Delete</div>
        </div>
        <div class="col-6 col-md-3 mb-3">
            <i class="fas fa-history" style="font-size: 30px;"></i>
            <div>History</div>
        </div>
        <div class="col-6 col-md-3 mb-3">
            <i class="fas fa-file-alt" style="font-size: 30px;"></i>
            <div>Review</div>
        </div>
        <!-- Add more icons as needed -->
    </div>
</div>

<!-- Footer -->
<footer class="text-black text-center py-3" style="background-color: #f8f9fa;">
    <p>&copy; 2024 Esycon. All Rights Reserved.</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
