<?php
// --- Database Connection ---
$servername = "localhost";
$username = "root";
$password = "Pr@1106"; // Change as per your setup
$dbname = "esycon";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// --- Fetch Data ---
$userResult = $conn->query("SELECT COUNT(*) AS total FROM users");
$userCount = $userResult->fetch_assoc()['total'];

$paperResult = $conn->query("SELECT COUNT(*) AS total FROM papers");
$paperCount = $paperResult->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>ESYCON Admin Panel</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f4f9;
        }

        .admin-container {
            display: flex;
            height: 100vh;
        }

        .sidebar {
            background: #0d0820;
            color: white;
            padding: 20px;
            width: 220px;
        }

        .sidebar h2 {
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            margin-bottom: 15px;
            color: white;
            text-decoration: none;
        }

        .sidebar a:hover {
            background: #1e1a35;
            padding-left: 10px;
            transition: 0.3s;
        }

        .main-content {
            padding: 30px;
            flex: 1;
        }

        .stats {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            width: 220px;
            text-align: center;
        }

        .card h2 {
            margin: 0;
            font-size: 2.5rem;
            color: #512da8;
        }

        .card p {
            margin-top: 10px;
            font-weight: bold;
            color: #333;
        }

        h1 {
            margin: 0;
            color: #333;
        }

        .footer {
            margin-top: 40px;
            color: #777;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="admin-container">
    <aside class="sidebar">
        <h2>ESYCON Admin</h2>
        <a href="#">Dashboard</a>
        <a href="#">Manage Users</a>
        <a href="#">Manage Papers</a>
        <a href="#">Registrations</a>
        <a href="#">Notifications</a>
        <a href="#">Logout</a>
    </aside>

    <main class="main-content">
        <h1>Admin Dashboard</h1>
        <div class="stats">
            <div class="card">
                <h2><?= $userCount ?></h2>
                <p>Total Users</p>
            </div>
            <div class="card">
                <h2><?= $paperCount ?></h2>
                <p>Submitted Papers</p>
            </div>
        </div>

        <div class="footer">
            &copy; <?= date('Y') ?> ESYCON Conference System. Admin Panel.
        </div>
    </main>
</div>

</body>
</html>
