<?php
session_start();
require_once 'dbconnect.php'; // file kết nối CSDL

// Kiểm tra login
if (!isset($_SESSION["usersid"])) {
    header("Location: Login/login.php");
    exit();
}

// Lấy thông tin người dùng
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

// Nếu là GET thì hiển thị form
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!isset($_GET['hotel_id'])) {
        die("Thiếu hotel_id");
    }

    $hotelId = (int) $_GET['hotel_id'];
    $hotelName = 'Unknown Hotel';
    $cityId = 0;
    $costPerDay = 0;

    // Lấy thông tin khách sạn
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

    // Lấy tên thành phố
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
        <title>Đặt phòng tại <?php echo htmlspecialchars($hotelName); ?></title>
        <style>
            body {
                font-family: Arial, sans-serif;
                max-width: 1200px;
                margin: 0 auto;
                padding: 20px;
                background-color: #f4f4f4;
            }

            .container {
                background-color: white;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

            }

            .header {
                display: flex;
                align-items: center;
                margin-bottom: 20px;
            }

            .header-text {
                flex: 1;
                padding-right: 20px;
            }

            .header-text h2 {
                margin-left: 60px;
                color: #333;
                font-size: 36px;
                font-weight: bold;
                font-family: 'Helvetica Neue Web', Helvetica, Arial, sans-serif;
            }

            .hotel-image {
                width: 300px;
                height: 200px;
                border-radius: 8px;
                margin-right: 60px;
                margin-top: 30px;
                margin-bottom: 30px;
            }

            .form-container {
                display: flex;
                justify-content: space-between;
                gap: 40px;
            }

            .form-left,
            .form-right {
                flex: 1;
            }

            .form-group {
                margin-bottom: 20px;
                margin-left: 20px;
            }

            label {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
                color: #555;
            }

            input[type="text"],
            input[type="email"],
            input[type="number"],
            input[type="date"],
            select {
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 4px;
                font-size: 16px;
                box-sizing: border-box;
            }

            input[readonly] {
                background-color: #e9ecef;
                cursor: not-allowed;
            }

            input[type="number"] {
                max-width: 100px;
            }

            select {
                cursor: pointer;
            }

            .form-right .form-group {
                padding-right: 20px;
            }

            .button-container {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 20px;
                margin: 20px auto;
            }

            button {
                padding: 12px;
                width: 200px;
                background-color: #4CAF50;
                color: white;
                border: none;
                border-radius: 4px;
                font-size: 16px;
                cursor: pointer;
                transition: background-color 0.3s;
            }

            button:hover {
                background-color: #45a049;
            }

            #total-amount {
                font-size: 16px;
                color: #333;
                font-weight: bold;
            }

            @media (max-width: 768px) {
                .header {
                    flex-direction: column;
                    text-align: center;
                }

                .header-text {
                    padding-right: 0;
                }

                .hotel-image {
                    max-width: 100%;
                }

                .form-container {
                    flex-direction: column;
                }

                .form-right .form-group {
                    padding-right: 0;
                }

                .button-container {
                    flex-direction: column;
                    gap: 10px;
                }
            }
        </style>
    </head>

    <body>
        <div class="container">
            <div class="header">
                <div class="header-text">
                    <h2>Reserve room: <?php echo htmlspecialchars($hotelName); ?></h2>
                </div>
                <img src="hotelphotoID/<?php echo $hotelId; ?>.jpg" alt="Hotel Image" class="hotel-image">
            </div>
            <form method="post">
                <input type="hidden" name="hotel" value="<?php echo $hotelId; ?>">
                <input type="hidden" name="city" value="<?php echo $cityId; ?>">
                <div class="form-container">
                    <div class="form-left">
                        <div class="form-group">
                            <label for="name">Full name:</label>
                            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($userName); ?>"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($userEmail); ?>"
                                readonly>
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
                            <input type="date" id="check_in_date" name="check_in_date" value="<?php echo date('Y-m-d'); ?>"
                                min="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="check_out_date">Check out date:</label>
                            <input type="date" id="check_out_date" name="check_out_date"
                                value="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" min="<?php echo date('Y-m-d'); ?>"
                                required>
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

                // Base cost from PHP
                const baseCost = <?php echo $costPerDay; ?>;
                // Room type extra costs
                const roomExtraCosts = {
                    'Standard': 0,
                    'Deluxe': 200000,
                    'Suite': 500000
                };

                // Calculate days
                const timeDiff = checkOutDate - checkInDate;
                const days = timeDiff / (1000 * 60 * 60 * 24);
                
                // Calculate cost per day
                const costPerDay = baseCost + roomExtraCosts[roomType];
                
                // Calculate total
                let total = 0;
                if (days > 0 && !isNaN(costPerDay) && numberOfRooms > 0) {
                    total = costPerDay * days * numberOfRooms;
                }

                // Update total amount display
                document.getElementById('total-amount').textContent = 
                    `Total: ${total.toLocaleString('vi-VN')}đ`;
            }

            // Add event listeners to update total on input change
            document.getElementById('room_type').addEventListener('change', calculateTotal);
            document.getElementById('check_in_date').addEventListener('change', calculateTotal);
            document.getElementById('check_out_date').addEventListener('change', calculateTotal);
            document.getElementById('number_of_rooms').addEventListener('change', calculateTotal);

            // Initial calculation
            calculateTotal();
        </script>
    </body>

    </html>
    <?php
}

// POST handling remains unchanged
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Nhận dữ liệu từ form
    $name = $_POST['name'] ?? $userName;
    $email = $_POST['email'] ?? $userEmail;
    $tourists = (int) ($_POST['tourists'] ?? 1);
    $number_of_rooms = (int) ($_POST['number_of_rooms'] ?? 1);
    $check_in_date = $_POST['check_in_date'] ?? date('Y-m-d');
    $check_out_date = $_POST['check_out_date'] ?? date('Y-m-d');
    $room_type = $_POST['room_type'] ?? 'Standard';
    $contact = $_POST['contact'] ?? '';
    $hotelId = (int) ($_POST['hotel'] ?? 0);
    $cityId = (int) ($_POST['city'] ?? 0);

    // Kiểm tra ngày
    $today = date('Y-m-d');
    if ($check_in_date < $today || $check_out_date < $today) {
        die("Ngày nhận/trả phòng không được nhỏ hơn hôm nay.");
    }

    $hotelName = 'Unknown Hotel';
    $cityName = 'Unknown City';
    $costPerDay = 0;
    $totalAmount = 0;

    // Lấy thông tin khách sạn
    if ($hotelId > 0) {
        $hotelQuery = "SELECT hotel, cost FROM hotels WHERE hotelid = ?";
        $stmt = $conn->prepare($hotelQuery);
        $stmt->bind_param("i", $hotelId);
        $stmt->execute();
        $stmt->bind_result($hotelNameDB, $baseCost);
        if ($stmt->fetch()) {
            $hotelName = $hotelNameDB;
            $baseCost = (int) $baseCost;
        }
        $stmt->close();
    }

    // Lấy tên thành phố
    if ($cityId > 0) {
        $cityQuery = "SELECT city FROM cities WHERE cityid = ?";
        $stmt = $conn->prepare($cityQuery);
        $stmt->bind_param("i", $cityId);
        $stmt->execute();
        $stmt->bind_result($cityNameDB);
        if ($stmt->fetch()) {
            $cityName = $cityNameDB;
        }
        $stmt->close();
    }

    // Phụ phí phòng
    $room_extra_cost = [
        "Standard" => 0,
        "Deluxe" => 200000,
        "Suite" => 500000
    ];
    if (!array_key_exists($room_type, $room_extra_cost)) {
        die("Loại phòng không hợp lệ.");
    }

    $costPerDay = $baseCost + $room_extra_cost[$room_type];

    // Tính số ngày ở
    $days = (strtotime($check_out_date) - strtotime($check_in_date)) / (60 * 60 * 24);
    if ($days <= 0)
        die("Ngày trả phòng phải sau ngày nhận phòng.");

    $totalAmount = $costPerDay * $days * $number_of_rooms;

    // INSERT dữ liệu vào DB
    $stmt = $conn->prepare("INSERT INTO hotel_bookings (
        userid, name, email,
        cityid, city_name,
        hotelid, hotel_name,
        tourists,
        check_in_date, check_out_date,
        room_type, contact,
        cost_per_day, total_amount, number_of_rooms
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param(
        "ississsissssddi",
        $userid,
        $name,
        $email,
        $cityId,
        $cityName,
        $hotelId,
        $hotelName,
        $tourists,
        $check_in_date,
        $check_out_date,
        $room_type,
        $contact,
        $costPerDay,
        $totalAmount,
        $number_of_rooms
    );

    if ($stmt->execute()) {
        echo "<p>✅ Đặt tour thành công!</p>";
        echo "<a href='./Login/loggedinhome.php' style='
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;'>🏠 Về trang chủ</a>";
    } else {
        echo "❌ Lỗi khi đặt tour: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>