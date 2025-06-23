<?php
// This is a sample PHP file for a webpage structure with a static date and content. 
// If you want to add any server-side dynamic content, you can use PHP variables, functions, etc.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>My Profile | EsyCon</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Background gradient with smooth transition */
        body {
            background: linear-gradient(356deg, rgba(251,132,134,1) 24%, rgba(254,206,77,1) 100%);
            background-attachment: fixed;
            transition: background 0.5s ease;
        }

        /* Custom background color for navbar */
        .bg-custom {
            background-color: #0d0820 !important;
        }

        /* Navbar styling */
        .navbar {
            background-color: #0d0820;
            padding: 20px 10px;
        }

        .navbar .nav-link {
            color: #ffffff !important;
            font-weight: bold;
        }

        .navbar-brand img {
            width: 140px;
        }

        .dropdown-menu a {
            color: #333 !important;
        }

        /* White background for the content section */
        .content {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .content h1 {
            font-size: 1.8rem;
            margin-bottom: 20px;
        }

        .date-icon {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .date-icon input {
            width: 100%;
            padding-right: 30px;
        }

        .date-icon i {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            color: #999;
        }

        .btn {
            background-color: #0d0820;
            color: #fff;
            font-weight: bold;
        }

        /* Footer styling */
        .footer {
            font-size: 0.9rem;
            color: #333;
            margin-top: 20px;
            text-align: center;
        }

        .footer a {
            color: #0d0820;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand text-white" href="#">
            <img src="esyconlog.png" alt="ESY CON Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <!-- Home item with dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="homeDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Home
                    </a>
                    <div class="dropdown-menu" aria-labelledby="homeDropdown">
                        <a class="dropdown-item" href="dashboard.php">Dashboard</a>
                        <a class="dropdown-item" href="index.php">Logout</a>
                    </div>
                </li>
                <!-- Other navbar items -->
                <li class="nav-item">
                    <a class="nav-link" href="submit_paper.php">Submit Paper</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="travel_grants.php">Travel Grants</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register_table.php">Register</a>
                </li>
                <!-- My Account item with dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                    <a class="nav-link" href="help.php">Help</a>
                </li>
            </ul>
        </div>
    </nav>
    
    <div class="container">
        <div class="content">
            <h1>Email sent to</h1>
            <div class="form-group">
                <label for="month-year">Month and year</label>
                <div class="date-icon">
                    <input type="text" id="month-year" class="form-control" value="<?php echo date('F, Y'); ?>">
                    <i class="fas fa-calendar-alt"></i>
                </div>
            </div>
            <a href="#" class="btn btn-block">List messages</a>
        </div>
        <div class="footer mt-4">
            <p>EDAS at foxtrot for <?php echo $_SERVER['REMOTE_ADDR']; ?> (<?php echo date('D, d M, Y h:i:s A T'); ?>) <a href="#">Request help</a></p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
