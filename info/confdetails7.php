<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>My Profile | EsyCon</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Basic styling for background gradient and text alignment */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(356deg, rgba(251,132,134,1) 24%, rgba(254,206,77,1) 100%);
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            transition: background 0.5s ease;
        }

        /* Container to center content and provide padding */
        .container {
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            margin: 40px auto;
            width: 60%;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 1px solid #f0c040;
        }

        h1 {
            font-size: 2em;
            margin-bottom: 10px;
        }

        h2 {
            font-size: 1.2em;
            margin-top: 20px;
        }

        p {
            margin: 5px 0;
        }

        a {
            color: #0000EE;
            text-decoration: underline;
        }

        /* Navbar styling */
        .navbar {
            background-color: #0d0820;
            padding: 20px;
        }

        .navbar .nav-link {
            color: #ffffff !important;
            font-weight: bold;
        }

        .navbar-brand img {
            width: 140px;
        }

        /* Footer styling */
        .footer {
            font-size: 0.8em;
            color: #666;
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            border-top: 1px solid #ddd;
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
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="homeDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Home
                    </a>
                    <div class="dropdown-menu" aria-labelledby="homeDropdown">
                        <a class="dropdown-item" href="dashboard.php">Dashboard</a>
                        <a class="dropdown-item" href="index.php">Logout</a>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link" href="submit_paper.php">Submit Paper</a></li>
                <li class="nav-item"><a class="nav-link" href="travel_grants.php">Travel Grants</a></li>
                <li class="nav-item"><a class="nav-link" href="register_table.php">Register</a></li>
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
                <li class="nav-item"><a class="nav-link" href="help.php">Help</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1>Conference Details<bold></h1>
        <h2>Conference Name</h2>
        <p>	International Conference on Robotics and Automation</p>
        <h2>Short Name</h2>
        <p>	ICRA 2025</p>
        <h2>Conference URL</h2>
        <p><a>NA</a></p>
        <h2>Location</h2>
        <p>Paris, France</p>
        <h2>Dates</h2>
        <p>May 30, 2025</p>
        <h2>Topic Areas</h2>
        <p>Robotics</p>
        <h2>Submit Paper</h2>
        <p><a href="../paper_submit/submit7.php">https://esycon.info/N33014</a></p>
    </div>
    <div class="footer">
        <p>EDAS at delta for 2405:201:a40c:694c:2c2d:52a2:5eb:866e (Sun, 17 Nov 2024 11:12:31 +0530 IST) <a href="#">Request help</a></p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
