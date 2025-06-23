<?php
// Example PHP logic to check for eligibility
$author = false; // Example condition, this would come from the actual user data
$deadline_passed = true; // Example, set to true if deadline is passed

// Function to display status message
function getStatusMessage($author, $deadline_passed) {
    if (!$author) {
        return "You are not qualified for this grant: not an author for ITNAC 2024.";
    } elseif ($deadline_passed) {
        return "You are not qualified for this grant: past deadline.";
    } else {
        return "You are eligible to apply for the travel grant.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Travel Grant</title>
    <style>
        /* Global styles */
        body {
            font-family: 'Garamond', serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Cover photo section */
        .cover {
            position: relative;
            height: 300px;
            background-image: url('https://img.freepik.com/free-vector/business-conference-2023-geometric-banner-design-vector-illustration_1142-13793.jpg'); /* Replace with the actual cover photo URL */
            background-size: cover;
            background-position: center;
        }

        /* Navbar container (with logo inside it) */
        .navbar {
            position: absolute;
            top: 240px;
            left: 100px;
            background-color: #f0b22e; /* Deep yellow color */
            padding: 10px 20px;
            border-radius: 5px;
            display: flex;
            align-items: center; /* Align items vertically */
        }

        /* Logo styles inside navbar */
        .navbar img.logo {
            max-width: 100px; /* Adjust size as necessary */
            margin-right: 20px; /* Space between logo and nav links */
        }
        
        /* Navbar links */
        .navbar a {
            margin: 0 10px;
            text-decoration: none;
            color: black;
            font-size: 16px;
            font-weight: bold;
        }

        /* Main content styles */
        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            font-family: 'Garamond', serif;
        }

        .error {
            background-color: #f8d7da;
            border:2px solid #850101;
            color: #721c24;
            padding: 15px;
            border-radius: 9px;
            margin-top: 20px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }

        /* Button styling */
        .apply-button {
            background-color: #f0b22e;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 20px;
        }

        .apply-button:hover {
            background-color: #d69f27;
        }
        .navbar .logo-text {
        font-size: 24px;
        font-weight: bold;
        color: black;
        margin-right: 20px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Adds a shadow effect */
        }
        .modal {
            display: none; /* Hidden by default */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
        }

        .modal-content {
            background-color: white;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            border-radius: 8px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: #000;
        }

        /* Timezone table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f0b22e;
            color: white;
        }
        #deadlineLink {
            color: blue; /* Change the color to blue */
            text-decoration: none; /* Remove underline, if desired */
        }
        #deadlineLink:hover {
            text-decoration: underline; /* Add underline on hover, optional */
        }
    </style>
</head>
<body>

    <!-- Cover Photo with Navbar and Logo -->
    <div class="cover">
        <div class="navbar">
            <div class="logo-text">IEEE GLOBECOM 2024</div> <!-- Text-based logo -->
            <a href="#">Home</a>
            <a href="#">Register</a>
            <a href="#">Travel Grants</a>
            <a href="#">Help</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <h1>Apply for Travel Grant</h1>
        <p>Selected papers with student first author where the student is attending the conference in person.</p>
        <ul>
            <li>Authors of papers accepted for this conference only.</li>
            <li>Students only.</li>
        </ul>

        <p>Accepted paper with student first author where student is attending the conference in person.</p>
        <p>The application deadline is <a id="deadlineLink">Oct 16</a></p>

        <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Deadline in Different Time Zones</h2>
            <table>
                <tr>
                    <th>Time Zone</th>
                    <th>Time</th>
                </tr>
                <tr>
                    <td>UTC (Coordinated Universal Time)</td>
                    <td>October 16, 2024, 00:00 UTC</td>
                </tr>
                <tr>
                    <td>EST (Eastern Standard Time - New York)</td>
                    <td>October 15, 2024, 8:00 PM EST</td>
                </tr>
                <tr>
                    <td>PST (Pacific Standard Time - Los Angeles)</td>
                    <td>October 15, 2024, 5:00 PM PST</td>
                </tr>
                <tr>
                    <td>CET (Central European Time - Paris)</td>
                    <td>October 16, 2024, 2:00 AM CET</td>
                </tr>
                <tr>
                    <td>IST (Indian Standard Time - New Delhi)</td>
                    <td>October 16, 2024, 5:30 AM IST</td>
                </tr>
                <tr>
                    <td>AEST (Australian Eastern Standard Time - Sydney)</td>
                    <td>October 16, 2024, 11:00 AM AEST</td>
                </tr>
            </table>
        </div>
    </div>
    <script>
        // Get the modal and the link
        var modal = document.getElementById("myModal");
        var link = document.getElementById("deadlineLink");
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on the link, open the modal
        link.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

        <?php
        // Display the appropriate message based on eligibility
        $message = getStatusMessage($author, $deadline_passed);
        if (!$author || $deadline_passed) {
            echo "<div class='error'>$message</div>";
        } else {
            echo "<div class='success'>$message</div>";
            echo "<button class='apply-button'>Apply Now</button>";
        }
        ?>
    </div>

</body>
</html>
