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
    <title>Edit Areas of Interest | EsyCon</title>
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

        /* Content section styling */
        .content {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            margin-top: 30px;
            margin-bottom: 30px;
        }

        h2 {
            font-size: 1.8rem;
            margin-bottom: 20px;
        }

        .info {
            background-color: #f0f8ff;
            padding: 10px;
            border: 1px solid #add8e6;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 0.9em;
            color: #333;
        }

        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            max-height: 400px;
            overflow-y: auto;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .checkbox-group label {
            width: 50%;
            padding: 5px 0;
            font-size: 0.9em;
        }

        textarea, input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            resize: none;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input[type="checkbox"] {
            margin-right: 10px;
        }

        .submit-btn {
            background-color: #0d0820;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
        }

        .submit-btn:hover {
            background-color: #333;
        }

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
            <h2>Edit Areas of Interest</h2>
            <div class="info">
                By checking this box, you are agreeing to receive calls for papers in these areas. EDAS exerts no editorial control over the content of these messages.
            </div>

            <form>
                <input type="checkbox" id="calls" name="calls">
                <label for="calls">I want to receive call-for-papers in the areas listed below and those sent by chairs of conference series I have submitted papers to or attended</label><br><br>

                <input type="checkbox" id="updates" name="updates">
                <label for="updates">I want to receive occasional updates on new EDAS features</label><br><br>

                <textarea placeholder="Block CFPs from these email addresses (one per line)"></textarea><br>

                <input type="checkbox" id="reviewer" name="reviewer">
                <label for="reviewer">Include me in reviewer or TPC searches (by keywords or area)</label><br><br>

                <h3>Broad areas of interest</h3>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="interest" value="Aeronautical engineering"> Aeronautical engineering</label>
                    <label><input type="checkbox" name="interest" value="Agriculture"> Agriculture</label>
                    <label><input type="checkbox" name="interest" value="Artificial intelligence"> Artificial intelligence</label>
                    <label><input type="checkbox" name="interest" value="Automation"> Automation</label>
                    <label><input type="checkbox" name="interest" value="Biotechnology"> Biotechnology</label>
                    <label><input type="checkbox" name="interest" value="CAD"> CAD</label>
                    <label><input type="checkbox" name="interest" value="Data Mining"> Data Mining</label>
                    <label><input type="checkbox" name="interest" value="Electrical engineering"> Electrical engineering</label>
                    <label><input type="checkbox" name="interest" value="Energy"> Energy</label>
                    <label><input type="checkbox" name="interest" value="Environment"> Environment</label>
                    <label><input type="checkbox" name="interest" value="Food technology"> Food technology</label>
                    <label><input type="checkbox" name="interest" value="Humanities"> Humanities</label>
                    <label><input type="checkbox" name="interest" value="Medical Physics"> Medical Physics</label>
                    <label><input type="checkbox" name="interest" value="Robotics"> Robotics</label>
                    <label><input type="checkbox" name="interest" value="Security"> Security</label>
                    <label><input type="checkbox" name="interest" value="Television broadcast"> Television broadcast</label>
                    <label><input type="checkbox" name="interest" value="Web Technologies"> Web Technologies</label>
                </div>

                <h3>Narrow areas of interest</h3>
                <input type="text" placeholder="Enter keywords separated by commas">

                <button type="submit" class="submit-btn">Save Areas of Interest</button>
            </form>

            <div class="footer">
                Date: 2024-11-16 | Powered by EsyCon</a> Conference Management System
            </div>
        </div>
    </div>

    <!-- Add jQuery, Popper.js, and Bootstrap JS for navbar functionality -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>