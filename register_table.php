<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conference Registration Table</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"/>
    <style>
        /* Background gradient */
        body {
            background: rgb(34,193,195);
            background: linear-gradient(356deg, rgba(251,132,134,1) 24%, rgba(254,206,77,1) 100%);
        }
    </style>
</head>
<body class="bg-light text-dark">

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

<div class="container my-5 p-4 bg-white shadow rounded">
    <h2 class="font-weight-bold mb-4">Conferences open for registration</h2>
    
    <!-- Filter Input -->
    <input type="search" class="form-control mb-3" placeholder="Search conferences..." id="searchInput">

    <div class="table-responsive">
        <table class="table table-hover table-striped table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Conference</th>
                    <th>Name</th>
                    <th>Home page</th>
                    <th>Where & When (program)</th>
                    <th>Register self</th>
                    <th>Register others</th>
                </tr>
            </thead>
            <tbody id="conferenceTable">
                <!-- Conference rows here -->
                <tr>
                    <td>11th ICEENG 2025</td>
                    <td>11th International Conference on Electrical Engineering (ICEENG)</td>
                    <td><a href="#" class="text-primary">Link</a></td>
                    <td>Bengaluru, India<br>June 16-22, 2025</td>
                    <td><a href="registerself/register1.php" class="btn btn-link text-primary"><i class="fas fa-link"></i></a></td>
                    <td><a href="registerother/reg1.php" class="btn btn-link text-primary"><i class="fas fa-link"></i></a></td>
                </tr>
                <tr>
                    <td>2024 7th ISRITI</td>
                    <td>2024 7th International Seminar on Research of Information Technology and Intelligent Systems (ISRITI)</td>
                    <td><a href="#">Link</a></td>
                    <td>Yogyakarta, Indonesia<br>December 11-12, 2024</td>
                    <td><a href="registerself/register2.php" class="btn btn-link text-primary"><i class="fas fa-link"></i></a></td>
                    <td><a href="registerother/register2.php" class="btn btn-link text-primary"><i class="fas fa-link"></i></a></td>
                </tr>
                <td>2024 7th ISRITI</td>
                    <td>2024 7th International Seminar on Research of Information Technology and Intelligent Systems (ISRITI)</td>
                    <td><a href="#">Link</a></td>
                    <td>Yogyakarta, Indonesia<br>December 11-12, 2024</td>

                <td><a href="registerself/register2.php" class="btn btn-link text-primary"><i class="fas fa-link"></i></a></td>
                <td><a href="registerother/register2.php" class="btn btn-link text-primary"><i class="fas fa-link"></i></a></td>
            </tr>
            <tr>
                <td>2024 9th ICSE</td>
                <td>2024 9th International Conference on Software Engineering (ICSE)</td>
                <td><a href="#">Link</a></td>
                <td>Singapore<br>December 21-23, 2024</td>
                <td><a href="registerself/register3.php" class="btn btn-link text-primary"><i class="fas fa-link"></i></a></td>
                <td><a href="registerother/register3.php" class="btn btn-link text-primary"><i class="fas fa-link"></i></a></td>
            </tr>
            <tr>
                <td>ICMLA 2024</td>
                <td>2024 9th International Conference on Software Engineering (ICSE)</td>
                <td><a href="#">Link</a></td>
                <td>Singapore<br>December 21-23, 2024</td>
                <td><a href="registerself/register3.php" class="btn btn-link text-primary"><i class="fas fa-link"></i></a></td>
                <td><a href="registerother/register3.php" class="btn btn-link text-primary"><i class="fas fa-link"></i></a></td>
            </tr>
            <tr>
                <td>ICASSP 2024</td>
                <td>2024 9th International Conference on Software Engineering (ICSE)</td>
                <td><a href="#">Link</a></td>
                <td>Singapore<br>December 21-23, 2024</td>
                <td><a href="registerself/register3.php" class="btn btn-link text-primary"><i class="fas fa-link"></i></a></td>
                <td><a href="registerother/register3.php" class="btn btn-link text-primary"><i class="fas fa-link"></i></a></td>
            </tr>
            <tr>
                <td>IFIP TC6 2024</td>
                <td>2024 9th International Conference on Software Engineering (ICSE)</td>
                <td><a href="#">Link</a></td>
                <td>Singapore<br>December 21-23, 2024</td>
                <td><a href="registerself/register3.php" class="btn btn-link text-primary"><i class="fas fa-link"></i></a></td>
                <td><a href="registerother/register3.php" class="btn btn-link text-primary"><i class="fas fa-link"></i></a></td>
            </tr>
            <tr>
                <td>IFIP TC6 2024</td>
                <td>2024 9th International Conference on Software Engineering (ICSE)</td>
                <td><a href="#">Link</a></td>
                <td>Singapore<br>December 21-23, 2024</td>
                <td><a href="registerself/register3.php" class="btn btn-link text-primary"><i class="fas fa-link"></i></a></td>
                <td><a href="registerothers/register3.php" class="btn btn-link text-primary"><i class="fas fa-link"></i></a></td>
            </tr>
            <tr>
                <td>ICTP 2024</td>
                <td>2024 9th International Conference on Software Engineering (ICSE)</td>
                <td><a href="#">Link</a></td>
                <td>Singapore<br>December 21-23, 2024</td>
                <td><a href="registerself/register3.php" class="btn btn-link text-primary"><i class="fas fa-link"></i></a></td>
                <td><a href="registerothers/register3.php" class="btn btn-link text-primary"><i class="fas fa-link"></i></a></td>
            </tr>
            <tr>
                <td>IEEE-IOTNC-2024</td>
                <td>2024 9th International Conference on Software Engineering (ICSE)</td>
                <td><a href="#">Link</a></td>
                <td>Singapore<br>December 21-23, 2024</td>
                <td><a href="registerself/register3.php" class="btn btn-link text-primary"><i class="fas fa-link"></i></a></td>
                <td><a href="registerothers/register3.php" class="btn btn-link text-primary"><i class="fas fa-link"></i></a></td>
            </tr>
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
// Filter functionality for conference search
document.getElementById('searchInput').addEventListener('input', function() {
    var filter = this.value.toLowerCase();
    var rows = document.getElementById('conferenceTable').getElementsByTagName('tr');

    for (var i = 0; i < rows.length; i++) {
        var columns = rows[i].getElementsByTagName('td');
        var match = false;

        // Check if any column contains the filter text
        for (var j = 0; j < columns.length; j++) {
            if (columns[j] && columns[j].textContent.toLowerCase().includes(filter)) {
                match = true;
                break;
            }
        }

        if (match) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }
    }
});
</script>

</body>
</html>
