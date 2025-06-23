<!DOCTYPE html>
<html lang="en">
<head>
    <title>Conferences Accepting Submissions</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"/>
    <style>
        /* Background gradient */
        body {
            background: linear-gradient(to bottom, #ffffff, #e0e0e0);
        }
        /* Custom card styling */
        .custom-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 14px 88px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
    </style>
</head>
<body>

<!-- Navbar Section -->
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #0d0820; padding: 20px 10px;">
    <a class="navbar-brand text-white" href="#">
        <img src="new.png" alt="ESY CON Logo" width="140">
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

<!-- Main Content Section with Card -->
<div class="container mt-5">
    <div class="custom-card">
        <h1 class="mb-3">Conferences Accepting Submissions</h1>
        <p class="text-muted">
            Dates listed are deadlines for registering papers for the track or sub-conference. If tracks or sub-conferences have several different deadlines, the range is shown. All deadlines are Asia/Calcutta time unless otherwise noted. Click on 
            <i class="fas fa-plus"></i> to submit paper. Deadlines in italics have expired.
        </p>

        <!-- Search Bar -->
        <div class="input-group mb-4">
            <input type="text" class="form-control" placeholder="Name of conference or journal">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">Search</button>
            </div>
        </div>

        <!-- Conference Table -->
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>Area</th>
                        <th>Conference</th>
                        <th>Name</th>
                        <th>Details</th>
                        <th>Where & When</th>
                        <th>Latest Deadline</th>
                        <th>Submit</th>
                    </tr>
                </thead>
                <tbody>
                
                <?php
$conferences = [
    [
        'area' => 'Electrical Engineering',
        'conference' => '15th ICEENG 2025',
        'name' => '2025 15th International Conference on Electrical Engineering (ICEENG)',
        'location' => 'Cairo, Egypt',
        'date' => 'May 12, 2025',
        'deadline' => 'June 16, 2025',
        'expired' => false,
    ],
    [
        'area' => 'Computer Science',
        'conference' => 'ICML 2025',
        'name' => 'International Conference on Machine Learning',
        'location' => 'Vienna, Austria',
        'date' => 'June 15, 2025',
        'deadline' => 'July 15, 2025',
        'expired' => false,
    ],
    [
        'area' => 'Artificial Intelligence',
        'conference' => 'NeurIPS 2025',
        'name' => 'Conference on Neural Information Processing Systems',
        'location' => 'San Francisco, USA',
        'date' => 'Dec 10, 2025',
        'deadline' => 'August 15, 2025',
        'expired' => false,
    ],
    [
        'area' => 'Communications',
        'conference' => '17th IEEE MCSoC-2024',
        'name' => 'IEEE International Symposium on Embedded Multicore/Manycore SoCs',
        'location' => 'Kuala Lumpur, Malaysia',
        'date' => 'Dec 16, 2024',
        'deadline' => 'Sep 25, 2025',
        'expired' => true,
    ],
    [
        'area' => 'Biomedical Engineering',
        'conference' => 'IEEE EMBC 2025',
        'name' => 'IEEE Engineering in Medicine and Biology Conference',
        'location' => 'Tokyo, Japan',
        'date' => 'July 21, 2025',
        'deadline' => 'Oct 1, 2025',
        'expired' => false,
    ],
    [
        'area' => 'Cybersecurity',
        'conference' => 'Black Hat Asia 2025',
        'name' => 'Black Hat Asia',
        'location' => 'Singapore',
        'date' => 'Mar 25, 2025',
        'deadline' => 'Nov, 2025',
        'expired' => false,
    ],
    [
        'area' => 'Robotics',
        'conference' => 'ICRA 2025',
        'name' => 'International Conference on Robotics and Automation',
        'location' => 'Paris, France',
        'date' => 'May 30, 2025',
        'deadline' => 'Dec 15, 2025',
        'expired' => false,
    ],
    [
        'area' => 'Data Science',
        'conference' => 'KDD 2025',
        'name' => 'Knowledge Discovery and Data Mining Conference',
        'location' => 'Berlin, Germany',
        'date' => 'Aug 10, 2025',
        'deadline' => 'Mar 15, 2026',
        'expired' => false,
    ],
    [
        'area' => 'Software Engineering',
        'conference' => 'ICSE 2025',
        'name' => 'International Conference on Software Engineering',
        'location' => 'Sydney, Australia',
        'date' => 'May 23, 2025',
        'deadline' => 'Jan 10, 2026',
        'expired' => false,
    ],
    [
        'area' => 'Quantum Computing',
        'conference' => 'Q2B 2025',
        'name' => 'Quantum for Business Conference',
        'location' => 'San Jose, USA',
        'date' => 'Dec 8, 2025',
        'deadline' => 'Jun 1, 2026',
        'expired' => false,
    ]
];

foreach ($conferences as $index => $conf) {
    $confNumber = $index + 1; // Get the conference number (1 to 10)
    echo "<tr>";
    echo "<td>{$conf['area']}</td>";
    echo "<td><a href=\"paper_submit/submit{$confNumber}.php\">{$conf['conference']}</a></td>";
    echo "<td>{$conf['name']}</td>";
    echo "<td><a href='info/confdetails{$confNumber}.php'><i class='fas fa-info-circle info-icon'></i></a></td>";
    echo "<td>{$conf['location']}<br/>{$conf['date']}</td>";
    echo "<td><a href=\"\">" . ($conf['expired'] ? "<i>{$conf['deadline']}</i>" : $conf['deadline']) . "</a></td>";
    echo "<td><a href='paper_submit/submit{$confNumber}.php'><i class='fas fa-plus'></i></a></td>";
    echo "</tr>";
}

?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bootstrap and FontAwesome Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
