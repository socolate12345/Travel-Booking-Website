<?php
require_once 'dbconnect.php';

// Lấy cityid và tourid từ URL nếu có
$cityid = isset($_GET['cityid']) ? intval($_GET['cityid']) : 0;
$tourid = isset($_GET['tourid']) ? intval($_GET['tourid']) : 0;

session_start();

if (!isset($_SESSION['usersid'])) {
    die("⚠️ Vui lòng đăng nhập trước khi đặt tour.");
}

$userid = $_SESSION['usersid'];

// Truy vấn thông tin city và tour
$city_name = "";
$tour_name = "";
$price_per_person = 0;

if ($cityid > 0) {
    $stmt = $conn->prepare("SELECT city FROM cities WHERE cityid = ?");
    $stmt->bind_param("i", $cityid);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $city_name = $row['city'];
    }
}

if ($tourid > 0) {
    $stmt = $conn->prepare("SELECT tour_name, price_per_person FROM tours WHERE tourid = ?");
    $stmt->bind_param("i", $tourid);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $tour_name = $row['tour_name'];
        $price_per_person = $row['price_per_person'];
    }
}

// Xử lý đặt tour
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['usersid'])) {
        die("⚠️ Vui lòng đăng nhập trước khi đặt tour.");
    }

    $userid = $_SESSION['usersid'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $cityid = $_POST['cityid'];
    $city_name = $_POST['city_name'];
    $tourid = $_POST['tourid'];
    $tour_name = $_POST['tour_name'];
    $tourists = $_POST['tourists'];
    $tour_date = $_POST['tour_date'];
    $contact = $_POST['contact'];
    $price_per_person = $_POST['price_per_person'];
    $total_amount = $price_per_person * $tourists;

    $stmt = $conn->prepare("INSERT INTO tour_bookings 
        (userid, name, email, cityid, city_name, tourid, tour_name, tourists, tour_date, contact, price_per_person, total_amount) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ississsissii", $userid, $name, $email, $cityid, $city_name, $tourid, $tour_name, $tourists, $tour_date, $contact, $price_per_person, $total_amount);

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
}

?>

<h2>Form Đặt Tour</h2>
<form method="POST">
    <input type="hidden" name="cityid" value="<?= htmlspecialchars($cityid) ?>">
    <input type="hidden" name="city_name" value="<?= htmlspecialchars($city_name) ?>">
    <input type="hidden" name="tourid" value="<?= htmlspecialchars($tourid) ?>">
    <input type="hidden" name="tour_name" value="<?= htmlspecialchars($tour_name) ?>">
    <input type="hidden" name="price_per_person" value="<?= htmlspecialchars($price_per_person) ?>">

    Tên: <input type="text" name="name" required><br>
    Email: <input type="email" name="email" required><br>
    Số khách: <input type="number" name="tourists" min="1" value="1" required><br>
    Ngày đi: <input type="date" name="tour_date" id="tour_date" required><br>
    Liên hệ: <input type="text" name="contact" required><br>
<script>
  // Lấy ngày hiện tại
  const today = new Date().toISOString().split('T')[0];
  const tourDateInput = document.getElementById('tour_date');

  // Thiết lập ngày mặc định và ngày tối thiểu là hôm nay
  tourDateInput.value = today;
  tourDateInput.min = today;
</script>

    
    <p><strong>Tour:</strong> <?= htmlspecialchars($tour_name) ?> (<?= number_format($price_per_person) ?> VND / người)</p>
    <p><strong>Thành phố:</strong> <?= htmlspecialchars($city_name) ?></p>

    <input type="submit" value="Đặt Tour">
</form>
