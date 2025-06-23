<!DOCTYPE html>
<html>
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"/>
    
    <title>ICEENG 2025 Paper Submission</title>
    <style>
        /* General Body Styling */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(180deg, #fdf4c4 0%, #f1c232 100%);
            margin: 0;
            padding: 0;
        }

        /* Navbar Styling */
        .navbar {
            display: flex;
            align-items: center;
            background-color: #0d0820;
            padding: 15px 20px;
            color: white;
        }

        .navbar-logo img {
            width: 100px;
            margin-right: 20px;
        }

        .navbar-links {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .navbar-links a {
            color: white;
            font-weight: bold;
            text-decoration: none;
        }

        /* Banner Image Styling */
        .banner {
            max-width: 80%;
            height: auto;
            display: block;
            margin: 7px auto;
        }

        /* Main Container */
        .container {
            max-width: 1000px;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            margin: 20px auto;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #f1c232;
        }

        /* Heading */
        h1 {
            color: #333;
            font-size: 1.8em;
            text-align: center;
            margin-bottom: 15px;
        }

        /* Important Dates Section */
        .header-row {
    margin-bottom: 20px;
    font-weight: bold;
    color: #333;
}

.header-row div {
    margin-bottom: 10px; /* Adds space between rows */
    color: black;
    text-decoration: none;
}

.date-box {
    display: inline-block;
    background-color: #f2f2f2;
    padding: 2px 8px;
    border-radius: 4px;
    color: #007bff;
    font-weight: normal;
    margin-left: 5px;
}



        /* Table Styling */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th, .table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .table td a {
            color: #007bff;
            text-decoration: none;
        }

        /* Footer */
        footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9em;
            color: #333;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #0d0820; padding: 20px 10px;">
    <a class="navbar-brand text-white" href="#">
        <img src="esyconlog.png" alt="ESY CON Logo" width="140">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <!-- Home item with dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link text-white font-weight-bold dropdown-toggle" href="" id="homeDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Home
                </a>
                <div class="dropdown-menu" aria-labelledby="homeDropdown">
                    <a class="dropdown-item" href="dashboard.php">Dashboard</a>
                    <a class="dropdown-item" href="index.php">Logout</a>
                </div>
            </li>
            <!-- Other navbar items -->
            <li class="nav-item">
                <a class="nav-link text-white font-weight-bold" href="submit_paper.php">Submit Paper</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white font-weight-bold" href="travel_grants.php">Travel Grants</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white font-weight-bold" href="register_table.php">Register</a>
            </li>
            <!-- My Account item with dropdown -->
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
    

    <!-- Banner Image -->
    <img class="banner" src="banner.jpg" alt="Military Technical College - ICEENG 2025">

    <!-- Main Content Container -->
    <div class="container">
        <h1>Knowledge Discovery and Data Mining Conference</h1>
        <p>Click on the name of the track to submit a paper; tracks without links are not accepting submissions at this time.</p>

        <!-- Important Dates -->
        <div class="header-row">
    <div>Register paper by <span class="date-box">Jan 27, 2025</span></div>
    <div>Review manuscript deadline <span class="date-box">Jan 27, 2025</span></div>
    <div>Invited talk abstract deadline <span class="date-box">Apr 6, 2025</span></div>
    <div>Invited talk presentation deadline <span class="date-box">Apr 6, 2025</span></div>
</div>



        <!-- Tracks Table -->
        <table class="table">
            <thead>
                <tr>
                    <th>Conference</th>
                    <th>Track (submit paper)</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>KDDMC 2025</td>
                    <td><a href="submitted1.php">Biomedical engineering</a></td>
                    <td></td>
                </tr>
                <tr>
                    <td>KDDMC 2025</td>
                    <td><a href="#">Computer engineering and artificial intelligence</a></td>
                    <td></td>
                </tr>
                <tr>
                    <td>KDDMC 2025</td>
                    <td><a href="#">Control systems and automation</a></td>
                    <td></td>
                </tr>
                <tr>
                    <td>KDDMC 2025</td>
                    <td><a href="#">Electrical engineering poster</a></td>
                    <td>Poster Track (2-3 pages Short Paper)</td>
                </tr>
                
                </tr>
                <!-- Additional rows here -->
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer>
        <p>© 2025 EsyCon Conference. All Rights Reserved.</p>
    </footer>

</body>
</html>