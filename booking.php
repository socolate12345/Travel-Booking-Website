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

    // Hiển thị form
    ?>
    <h2>Đặt phòng tại <?php echo htmlspecialchars($hotelName); ?></h2>
    <form method="post">
        <input type="hidden" name="hotel" value="<?php echo $hotelId; ?>">
        <input type="hidden" name="city" value="<?php echo $cityId; ?>">

        Họ tên: <input type="text" name="name" value="<?php echo htmlspecialchars($userName); ?>"><br>
        Email: <input type="email" name="email" value="<?php echo htmlspecialchars($userEmail); ?>"><br>
        Số người: <input type="number" name="tourists" value="1" min="1"><br>
        Số phòng: <input type="number" name="number_of_rooms" value="1" min="1"><br>
        Ngày nhận phòng: <input type="date" name="check_in_date" value="<?php echo date('Y-m-d'); ?>"
            min="<?php echo date('Y-m-d'); ?>"><br>
        Ngày trả phòng: <input type="date" name="check_out_date" value="<?php echo date('Y-m-d', strtotime('+1 day')); ?>"
            min="<?php echo date('Y-m-d'); ?>"><br>
        Liên hệ: <input type="text" name="contact" required><br>

        Loại phòng:
        <select name="room_type">
            <option value="Standard">Standard (<?php echo number_format($baseCost); ?>đ)</option>
            <option value="Deluxe">Deluxe (<?php echo number_format($baseCost + 200000); ?>đ)</option>
            <option value="Suite">Suite (<?php echo number_format($baseCost + 500000); ?>đ)</option>
        </select><br><br>

        <img src="hotelphotoID/<?php echo $hotelId; ?>.jpg" alt="Hotel Image" width="300"><br><br>

        <button type="submit">Đặt phòng</button>
    </form>
    <?php
}

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