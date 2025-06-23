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
            margin-bottom: 20px;
        }

        .content h1 {
            font-size: 1.8rem;
            margin-bottom: 20px;
        }

        .content table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .content table th, .content table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
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
            <h1>Conferences and journals containing my papers</h1>
            <p>Only papers from conferences or journal issues that have not ended are shown, but you can also see <a href="#">all papers</a>. Dates listed are deadlines for submitting manuscripts for registered papers. You can only upload papers that have at least one author.</p>
            <table>
                <tr>
                    <th>Conference</th>
                    <th>Paper title (details)</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Add and delete authors</th>
                    <th>Withdraw or unwithdraw</th>
                </tr>
                <?php
                // Fetch data from the database or define it statically for now
                $papers = [
                    ['conference' => 'NA', 'title' => 'NA', 'status' => 'NA'],
                ];

                foreach ($papers as $paper) {
                    echo "<tr>";
                    echo "<td><a href='#'>{$paper['conference']}</a></td>";
                    echo "<td><a href='#'>{$paper['title']}</a></td>";
                    echo "<td>{$paper['status']}</td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
        <div class="footer">
            <?php 
                // Dynamic date and user IP details could be added here
                echo "EDAS at foxtrot - " . date("D, d M Y H:i:s O") . " <a href='#'>Request help</a>"; 
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
