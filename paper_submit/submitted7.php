<!DOCTYPE html>
<html lang="en">
<head>
   <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
   <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"/>
   
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>ICEENG 2025 Paper Submission - 	Invited talks</title>
   <style>
       body {
           font-family: Arial, sans-serif;
           background: linear-gradient(356deg, rgba(251,132,134,1) 24%, rgba(254,206,77,1) 100%);
           margin: 0;
           padding: 0;
       }

       .container {
           max-width: 1000px;
           margin: auto;
           background-color: #fff;
           padding: 40px;
           border-radius: 8px;
           box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
       }

       .navbar {
           display: flex;
           align-items: center;
           justify-content: space-between;
           background-color: #0d0820;
           padding: 8px 20px; /* Reduced padding for compact height */
           height: 90px; /* Fixed height for the navbar */
       }

       .banner {
            max-width: 80%;
            height: auto;
            display: block;
            margin: 1px auto;
        }

       .navbar-logo img {
           width: 120px;
           margin-right: 15px;
       }

       .navbar-nav {
           display: flex;
           gap: 15px;
       }

       .navbar-nav .nav-item .nav-link {
           color: white;
           font-weight: bold;
           padding: 0; /* Remove extra padding around links */
           line-height: 1; /* Adjust line height */
       }

       h1 {
           color: #333;
       }

       form {
           display: flex;
           flex-direction: column;
       }

       label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"], textarea, select {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        input[type="text"].required {
            border: 2px dashed red;
        }

        input[type="text"]:focus, textarea:focus, select:focus {
            outline: none;
            border-color: #007bff;
        }

        textarea {
            min-height: 100px;
        }

       .submit-button {
           padding: 10px 20px;
           background-color: #007bff;
           color: #fff;
           border: none;
           border-radius: 4px;
           cursor: pointer;
           font-weight: bold;
       }

       .submit-button:hover {
           background-color: #0056b3;
       }
   </style>
</head>
<body>
<nav class="navbar navbar-expand-lg">
    <a class="navbar-logo" href="#">
        <img src="esyconlog.png" alt="ESY CON Logo">
    </a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="homeDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Home
                </a>
                <div class="dropdown-menu" aria-labelledby="homeDropdown">
                    <a class="dropdown-item" href="../dashboard.php">Dashboard</a>
                    <a class="dropdown-item" href="index.php">Logout</a>
                </div>
            </li>
            <li class="nav-item"><a class="nav-link" href="submit_paper.php">Submit Paper</a></li>
            <li class="nav-item"><a class="nav-link" href="travel_grants.php">Travel Grants</a></li>
            <li class="nav-item"><a class="nav-link" href="register_table.php">Register</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="myprofile.php" id="accountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
            <li class="nav-item"><a class="nav-link" href="help.php">Help</a></li>
        </ul>
    </div>
</nav> <br><br>

<img class="banner" src="banner.jpg" alt="Military Technical College - ICEENG 2025">

<div class="container">
    <h1>Register a paper for 2025 15th International Conference on Electrical Engineering (ICEENG):	Invited talks</h1>
    <div class="tabs">
            <span class="tab active">Register paper</span>
            <span class="tab">Add authors</span>
            <span class="tab">Upload review manuscript</span>
        </div>

        <div class="warning">
            Manuscripts should not contain page numbers, headers, or footers.
        </div>

       
<form action="process_submission.php" method="POST">
    <label for="title">Title of paper (up to 150 characters)</label>
    <input type="text" id="title" name="title" required>
    
    <label for="keyword1">Keyword 1 (required)</label>
    <input type="text" id="keyword1" name="keyword1" class="required" required>
    
    <label for="keyword2">Keyword 2 (required)</label>
    <input type="text" id="keyword2" name="keyword2" class="required" required>

    <label for="keyword3">Keyword 3 (required)</label>
    <input type="text" id="keyword3" name="keyword3" class="required" required>
    
    <label for="keyword4">Keyword 4 (optional)</label>
    <input type="text" id="keyword4" name="keyword4">
    
    <label for="keyword5">Keyword 5 (optional)</label>
    <input type="text" id="keyword5" name="keyword5">
    
    <label for="keyword6">Keyword 6 (optional)</label>
    <input type="text" id="keyword6" name="keyword6">
    
    <label for="abstract">Paper abstract (between 20 and 250 words)</label>
    <textarea id="abstract" name="abstract" required></textarea>
    
    <button type="submit" class="submit-button">Register paper</button>
</form>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
