<?php
require_once '../dbconnect.php'; // đường dẫn tới file kết nối CSDL

// THÊM hoặc CHỈNH SỬA
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = $_POST['userid'];
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

    if (isset($_POST['booking_id']) && $_POST['booking_id'] != "") {
        // Cập nhật
        $booking_id = $_POST['booking_id'];
        $stmt = $conn->prepare("UPDATE tour_bookings SET userid=?, name=?, email=?, cityid=?, city_name=?, tourid=?, tour_name=?, tourists=?, tour_date=?, contact=?, price_per_person=?, total_amount=? WHERE booking_id=?");
        $stmt->bind_param("ississsissiidi", $userid, $name, $email, $cityid, $city_name, $tourid, $tour_name, $tourists, $tour_date, $contact, $price_per_person, $total_amount, $booking_id);
        $stmt->execute();
    } else {
        // Thêm mới
        $stmt = $conn->prepare("INSERT INTO tour_bookings (userid, name, email, cityid, city_name, tourid, tour_name, tourists, tour_date, contact, price_per_person, total_amount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ississsissii", $userid, $name, $email, $cityid, $city_name, $tourid, $tour_name, $tourists, $tour_date, $contact, $price_per_person, $total_amount);
        $stmt->execute();
    }
    header("Location: adminviewtourbooking.php");
    exit;
}

// XÓA
if (isset($_GET['delete'])) {
    $booking_id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM tour_bookings WHERE booking_id = ?");
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    header("Location: adminviewtourbooking.php");
    exit;
}
?>

<h2>Danh sách tour đã đặt</h2>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th><th>UserID</th><th>Tên</th><th>Email</th><th>Thành phố</th><th>Tour</th><th>Ngày đi</th><th>Khách</th><th>Liên hệ</th><th>Giá</th><th>Tổng</th><th>Hành động</th>
    </tr>
    <?php
    $result = $conn->query("SELECT * FROM tour_bookings");
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['booking_id']}</td>
            <td>{$row['userid']}</td>
            <td>{$row['name']}</td>
            <td>{$row['email']}</td>
            <td>{$row['city_name']}</td>
            <td>{$row['tour_name']}</td>
            <td>{$row['tour_date']}</td>
            <td>{$row['tourists']}</td>
            <td>{$row['contact']}</td>
            <td>{$row['price_per_person']}</td>
            <td>{$row['total_amount']}</td>
            <td>
                <a href='?edit={$row['booking_id']}'>Sửa</a> |
                <a href='?delete={$row['booking_id']}' onclick='return confirm(\"Xóa thật không?\")'>Xóa</a>
            </td>
        </tr>";
    }
    ?>
</table>

<br><h3><?php echo isset($_GET['edit']) ? "Sửa booking" : "Thêm booking mới"; ?></h3>
<?php
// Nếu sửa, lấy dữ liệu cũ
$booking = [
    "booking_id" => "",
    "userid" => "", "name" => "", "email" => "", "cityid" => "", "city_name" => "",
    "tourid" => "", "tour_name" => "", "tourists" => 1, "tour_date" => "", "contact" => "",
    "price_per_person" => ""
];
if (isset($_GET['edit'])) {
    $stmt = $conn->prepare("SELECT * FROM tour_bookings WHERE booking_id = ?");
    $stmt->bind_param("i", $_GET['edit']);
    $stmt->execute();
    $result = $stmt->get_result();
    $booking = $result->fetch_assoc();
}
?>
<form method="POST">
    <input type="hidden" name="booking_id" value="<?= $booking['booking_id'] ?>">
    UserID: <input type="number" name="userid" value="<?= $booking['userid'] ?>" required><br>
    Tên: <input type="text" name="name" value="<?= $booking['name'] ?>" required><br>
    Email: <input type="email" name="email" value="<?= $booking['email'] ?>" required><br>
    CityID: <input type="number" name="cityid" value="<?= $booking['cityid'] ?>" required><br>
    City Name: <input type="text" name="city_name" value="<?= $booking['city_name'] ?>" required><br>
    TourID: <input type="number" name="tourid" value="<?= $booking['tourid'] ?>" required><br>
    Tour Name: <input type="text" name="tour_name" value="<?= $booking['tour_name'] ?>" required><br>
    Tourists: <input type="number" name="tourists" value="<?= $booking['tourists'] ?>" required><br>
    Ngày tour: <input type="date" name="tour_date" value="<?= $booking['tour_date'] ?>" required><br>
    Liên hệ: <input type="text" name="contact" value="<?= $booking['contact'] ?>" required><br>
    Giá / Người: <input type="number" name="price_per_person" value="<?= $booking['price_per_person'] ?>" required><br>
    <input type="submit" value="<?= isset($_GET['edit']) ? "Cập nhật" : "Thêm" ?>">
</form>
<button onclick="window.location.href='admindashboard.php'">
    <?= "Back to Dashboard " ?>
</button>