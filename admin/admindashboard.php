<?php
session_start();

// Database connection (adjust with your credentials)
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query for user distribution (Admins and Regular Users)
$admin_count = $conn->query("SELECT COUNT(*) as count FROM admin_login")->fetch_assoc()['count'];
$user_count = $conn->query("SELECT COUNT(*) as count FROM login")->fetch_assoc()['count'];

// Query for booking distribution
$hotel_bookings = $conn->query("SELECT COUNT(*) as count FROM hotel_bookings")->fetch_assoc()['count'];
$tour_bookings = $conn->query("SELECT COUNT(*) as count FROM tour_bookings")->fetch_assoc()['count'];

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/admindashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="icon" type="image/png" href="../images/favicon.png">
    <title>Admin Panel</title>
</head>
<body>
    <header class="header">
        <div class="logo">
            <h1>Admin Panel</h1>
        </div>
        <nav class="navigation">
            <ul class="nav-menu">
                <li><a href="adminviewcity.php">View Cities</a></li>
                <li><a href="adminviewusers.php">View Users</a></li>
                <li><a href="adminusers.php">View Admins</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <div class="sidebar">
            <div class="logo">
                <img src="silhouette.png" alt="Silhouette Image"><br><br>
            </div>
            <h2 style="color: cornsilk;">Welcome, <?php echo $_SESSION['AdminLoginId'];?></h2>
            <ul class="sidebar-menu">
                <li><a href="#"><i class="fa fa-home"></i> Dashboard</a></li>
                <li><a href="adminviewtourbooking.php"><i class="fa fa-pencil"></i> Tour Booking Management</a></li>
                <li><a href="adminviewhotelbooking.php"><i class="fa fa-pencil"></i> Hotel Booking Management</a></li>
                <li><a href="adminviewtour.php"><i class="fa fa-edit"></i> Tour Management</a></li>
                <li><a href="adminviewhotel.php"><i class="fa fa-users"></i> Hotel Management</a></li>
                <li><a href="adminviewusers.php"><i class="fa fa-comments"></i> User Management</a></li>
                <li><a href="adminviewcity.php"><i class="fa fa-pencil"></i> City Management</a></li>
            </ul>
            <div class="sidebar-footer" style="color: #333;">
                <p style="color:cornsilk;">Logged in as Admin</p>
                <a href="adminlogout.php" style="color: cornsilk;"><i class="fa fa-sign-out"></i> Logout</a>
            </div>
        </div>

        <div class="content">
            <div class="dashboard-overview">
                <h2>Dashboard Overview</h2>
                <p>Welcome to Admin Dashboard. Here, you can manage journeys, users, and settings of the website.</p>
            </div>

            <br>
            <div class="dashboard-container">
                <div class="dashboard-widget pie-chart-container">
                    <h2>User Distribution</h2>
                    <canvas id="userPieChart" class="pie-chart" width="400" height="400"></canvas>
                </div>

                <div class="dashboard-widget pie-chart-container">
                    <h2>Booking Distribution</h2>
                    <canvas id="bookingPieChart" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <p>© 2025 Admin Panel</p>
    </footer>

    <script>
        var userPieData = {
            labels: ['Admins', 'Regular Users'],
            datasets: [{
                data: [<?php echo $admin_count; ?>, <?php echo $user_count; ?>],
                backgroundColor: ['#36a2eb', '#ffcd56']
            }]
        };

        var bookingPieData = {
            labels: ['Hotel Bookings', 'Tour Bookings'],
            datasets: [{
                data: [<?php echo $hotel_bookings; ?>, <?php echo $tour_bookings; ?>],
                backgroundColor: ['#ff6384', '#36a2eb']
            }]
        };

        var userPieChart = new Chart(document.getElementById('userPieChart'), {
            type: 'pie',
            data: userPieData
        });

        var bookingPieChart = new Chart(document.getElementById('bookingPieChart'), {
            type: 'pie',
            data: bookingPieData
        });
    </script>
</body>
</html>