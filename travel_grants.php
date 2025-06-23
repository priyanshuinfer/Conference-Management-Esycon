<?php
// travel_grants.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"/>
    <title>Travel Grants</title>
    <style>
        /* Background gradient */
        body {
            background: linear-gradient(to bottom, #ffffff, #e0e0e0);
        }

        /* Ensure the table is scrollable on smaller screens */
        .table-responsive {
            overflow-x: auto;
        }

        /* Adjust font sizes for different screen sizes */
        @media (max-width: 768px) {
            .navbar-brand img {
                width: 100px;
            }

            .container {
                padding: 10px;
            }

            .table th, .table td {
                font-size: 12px;
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
            <!-- Home item with dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link text-white font-weight-bold dropdown-toggle" href="dashboard.php" id="homeDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Home
                </a>
                <div class="dropdown-menu" aria-labelledby="homeDropdown">
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

<!-- Container for Travel Grants -->
<div class="container mt-4 p-4 shadow-lg bg-white shadow rounded">
    <h2 class="text-center font-weight-bold mb-4">Current Travel Grants</h2>

    <!-- Travel Grants Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Conference</th>
                    <th>Description (apply)</th>
                    <th>Conditions</th>
                    <th>Only Students</th>
                    <th>Only Authors</th>
                    <th>Allow applicant from same region as conference?</th>
                    <th>Country</th>
                    <th>Deadline</th>
                    <th>Application Status</th>
                    <th>Jury Role</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ITMAC 2024</td>
                    <td><a href="travel_conference/conference1.php">Student Registration Grant</a><br>Selected papers with student first author where student is attending the conference in person.</td>
                    <td>Accepted paper with student first author, attending in person</td>
                    <td>&#9989;</td>
                    <td>&#10060;</td>
                    <td>&#9989;</td>
                    <td>Asia</td>
                    <td>Oct 15, 2024</td>
                    <td>Open</td>
                    <td>Asia/Globecom</td>
                </tr>
                <tr>
                    <td>CS-24 Workshops</td>
                    <td><a href="travel_conference/conference2.php">COMSOC Conference Travel Grant</a><br>The Conference Travel Grant (CTG) aims at providing partial financial support for participation in IEEE ComSoc conferences...</td>
                    <td>Must be COMSOC member and GLOBECOM 2024 participant</td>
                    <td>&#9989;</td>
                    <td>&#10060;</td>
                    <td>&#10060;</td>
                    <td>Any</td>
                    <td>Oct 15, 2024</td>
                    <td>Open</td>
                    <td></td>
                </tr>
                <tr>
                    <td>GC-24 Workshops</td>
                    <td><a href="travel_conference/conference3.php">IEEE WICE Student Grants</a><br>On a competitive basis, IEEE GLOBECOM 2024 offers a number of WICE grants to students who have co-authored an accepted peer-reviewed paper for the conference...</td>
                    <td>Must be a WICE member attending GLOBECOM 2024</td>
                    <td>&#9989;</td>
                    <td>&#10060;</td>
                    <td>&#10060;</td>
                    <td>Any</td>
                    <td>Oct 15, 2024</td>
                    <td>Open</td>
                    <td></td>
                </tr>
                <!-- Add other rows here -->
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
