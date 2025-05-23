<?php
session_start();
require_once 'dbconnect.php';

// Check if user is logged in
if (!isset($_SESSION["usersid"])) {
    header("Location: /login");
    exit();
}

// Initialize database connection using Flight
$conn = Flight::db();
if (!$conn) {
    die("Database connection failed");
}

// Get user info
$userid = $_SESSION["usersid"];
$userEmail = "";
$userName = "";

$sql = "SELECT usersEmail, usersUid FROM login WHERE usersId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userid);
$stmt->execute();
$stmt->bind_result($email, $username);
if ($stmt->fetch()) {
    $userEmail = $email;
    $userName = $username;
}
$stmt->close();

// Validate hotel_id
if (!isset($_GET['hotel_id'])) {
    die("Thiếu hotel_id");
}

$hotelId = (int) $_GET['hotel_id'];
$hotelName = 'Unknown Hotel';
$cityId = 0;
$costPerDay = 0;

// Get hotel info
$stmt = $conn->prepare("SELECT hotel, cost, cityid FROM hotels WHERE hotelid = ?");
$stmt->bind_param("i", $hotelId);
$stmt->execute();
$stmt->bind_result($hotelName, $baseCost, $cityId);
if ($stmt->fetch()) {
    $costPerDay = $baseCost;
} else {
    die("Không tìm thấy khách sạn.");
}
$stmt->close();

// Get city name
$stmt = $conn->prepare("SELECT city FROM cities WHERE cityid = ?");
$stmt->bind_param("i", $cityId);
$stmt->execute();
$stmt->bind_result($cityName);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserve at <?php echo htmlspecialchars($hotelName); ?></title>
    <link rel="stylesheet" href="/css/hotelbooking.css">
    <link rel="icon" type="image/png" href="/images/favicon.png">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-text">
                <h2>Reserve room: <?php echo htmlspecialchars($hotelName); ?></h2>
            </div>
            <img src="/hotelphotoID/<?php echo $hotelId; ?>.jpg" alt="Hotel Image" class="hotel-image">
        </div>
        <form method="post" action="/hotel/booking/submit">
            <input type="hidden" name="hotel" value="<?php echo $hotelId; ?>">
            <input type="hidden" name="city" value="<?php echo $cityId; ?>">
            <div class="form-container">
                <div class="form-left">
                    <div class="form-group">
                        <label for="name">Full name:</label>
                        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($userName); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($userEmail); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="tourists">People:</label>
                        <input type="number" id="tourists" name="tourists" value="1" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="number_of_rooms">Room:</label>
                        <input type="number" id="number_of_rooms" name="number_of_rooms" value="1" min="1" required>
                    </div>
                </div>
                <div class="form-right">
                    <div class="form-group">
                        <label for="check_in_date">Check in date:</label>
                        <input type="date" id="check_in_date" name="check_in_date" value="<?php echo date('Y-m-d'); ?>" min="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="check_out_date">Check out date:</label>
                        <input type="date" id="check_out_date" name="check_out_date" value="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" min="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="contact">Contact:</label>
                        <input type="text" id="contact" name="contact" required>
                    </div>
                    <div class="form-group">
                        <label for="room_type">Room type:</label>
                        <select id="room_type" name="room_type">
                            <option value="Standard">Standard (<?php echo number_format($costPerDay); ?>đ)</option>
                            <option value="Deluxe">Deluxe (<?php echo number_format($costPerDay + 200000); ?>đ)</option>
                            <option value="Suite">Suite (<?php echo number_format($costPerDay + 500000); ?>đ)</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="button-container">
                <span id="total-amount">Total: 0đ</span>
                <button type="submit">Reserve</button>
            </div>
        </form>
    </div>
    <script>
        function calculateTotal() {
            const roomType = document.getElementById('room_type').value;
            const checkInDate = new Date(document.getElementById('check_in_date').value);
            const checkOutDate = new Date(document.getElementById('check_out_date').value);
            const numberOfRooms = parseInt(document.getElementById('number_of_rooms').value) || 1;
            const baseCost = <?php echo $costPerDay; ?>;
            const roomExtraCosts = {
                'Standard': 0,
                'Deluxe': 200000,
                'Suite': 500000
            };
            const timeDiff = checkOutDate - checkInDate;
            const days = timeDiff / (1000 * 60 * 60 * 24);
            const costPerDay = baseCost + roomExtraCosts[roomType];
            let total = 0;
            if (days > 0 && !isNaN(costPerDay) && numberOfRooms > 0) {
                total = costPerDay * days * numberOfRooms;
            }
            document.getElementById('total-amount').textContent = 
                `Total: ${total.toLocaleString('vi-VN')}đ`;
        }
        document.getElementById('room_type').addEventListener('change', calculateTotal);
        document.getElementById('check_in_date').addEventListener('change', calculateTotal);
        document.getElementById('check_out_date').addEventListener('change', calculateTotal);
        document.getElementById('number_of_rooms').addEventListener('change', calculateTotal);
        calculateTotal();
    </script>
</body>
</html>