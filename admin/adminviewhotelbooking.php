<?php
include '../dbconnect.php'; // chứa $conn = new mysqli(...);

// Xử lý thêm hoặc cập nhật tour
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $booking_id = $_POST["booking_id"];
    $userid = $_POST["userid"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $cityid = $_POST["cityid"];
    $city_name = $_POST["city_name"];
    $hotelid = $_POST["hotelid"];
    $hotel_name = $_POST["hotel_name"];
    $tourists = $_POST["tourists"];
    $tour_date = $_POST["tour_date"];
    $contact = $_POST["contact"];
    $cost_per_day = $_POST["cost_per_day"];
    $total_amount = $_POST["total_amount"];

    if ($booking_id) {
        // Cập nhật
        $stmt = $conn->prepare("UPDATE hotel_bookings SET userid=?, name=?, email=?, cityid=?, city_name=?, hotelid=?, hotel_name=?, tourists=?, tour_date=?, contact=?, cost_per_day=?, total_amount=? WHERE booking_id=?");
        $stmt->bind_param("issisisiisiii", $userid, $name, $email, $cityid, $city_name, $hotelid, $hotel_name, $tourists, $tour_date, $contact, $cost_per_day, $total_amount, $booking_id);
        $stmt->execute();
    } else {
        // Thêm mới
        $stmt = $conn->prepare("INSERT INTO hotel_bookings (userid, name, email, cityid, city_name, hotelid, hotel_name, tourists, tour_date, contact, cost_per_day, total_amount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issisisiisii", $userid, $name, $email, $cityid, $city_name, $hotelid, $hotel_name, $tourists, $tour_date, $contact, $cost_per_day, $total_amount);
        $stmt->execute();
    }
    header("Location: adminviewhotelbooking.php");
    exit();
}

// Xử lý xóa
if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $conn->query("DELETE FROM hotel_bookings WHERE booking_id = $id");
    header("Location: adminviewhotelbooking.php");
    exit();
}

// Lấy dữ liệu hiện tại
$result = $conn->query("SELECT * FROM hotel_bookings");
?>

<h2>Manage Hotel Booking</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th><th>User</th><th>Email</th><th>City</th><th>Hotel</th><th>Ngày đi</th><th>Khách</th><th>Tổng</th><th>Hành động</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?= $row["booking_id"] ?></td>
        <td><?= $row["name"] ?></td>
        <td><?= $row["email"] ?></td>
        <td><?= $row["city_name"] ?></td>
        <td><?= $row["hotel_name"] ?></td>
        <td><?= $row["tour_date"] ?></td>
        <td><?= $row["tourists"] ?></td>
        <td><?= $row["total_amount"] ?></td>
        <td>
            <a href="?edit=<?= $row["booking_id"] ?>">Sửa</a> |
            <a href="?delete=<?= $row["booking_id"] ?>" onclick="return confirm('Xác nhận xóa?')">Xóa</a>
        </td>
    </tr>
    <?php } ?>
</table>

<?php
// Nếu có chỉnh sửa
$edit = null;
if (isset($_GET["edit"])) {
    $id = $_GET["edit"];
    $edit = $conn->query("SELECT * FROM hotel_bookings WHERE booking_id = $id")->fetch_assoc();
}
?>

<h2><?= $edit ? "Edit Hotel Booking Information #" . $edit["booking_id"] : "Add New Hotel Booking" ?></h2>
<form method="POST">
    <input type="hidden" name="booking_id" value="<?= $edit["booking_id"] ?? '' ?>">
    User ID: <input name="userid" value="<?= $edit["userid"] ?? '' ?>"><br>
    Tên: <input name="name" value="<?= $edit["name"] ?? '' ?>"><br>
    Email: <input name="email" value="<?= $edit["email"] ?? '' ?>"><br>
    City ID: <input name="cityid" value="<?= $edit["cityid"] ?? '' ?>"><br>
    City Name: <input name="city_name" value="<?= $edit["city_name"] ?? '' ?>"><br>
    Hotel ID: <input name="hotelid" value="<?= $edit["hotelid"] ?? '' ?>"><br>
    Hotel Name: <input name="hotel_name" value="<?= $edit["hotel_name"] ?? '' ?>"><br>
    Tourists: <input name="tourists" value="<?= $edit["tourists"] ?? '1' ?>"><br>
    Tour Date: <input type="date" name="tour_date" value="<?= $edit["tour_date"] ?? '' ?>"><br>
    Contact: <input name="contact" value="<?= $edit["contact"] ?? '' ?>"><br>
    Cost/Day: <input name="cost_per_day" value="<?= $edit["cost_per_day"] ?? '' ?>"><br>
    Total Amount: <input name="total_amount" value="<?= $edit["total_amount"] ?? '' ?>"><br>
    <button type="submit"><?= $edit ? "Cập nhật" : "Thêm mới" ?></button>
</form>

<button onclick="window.location.href='admindashboard.php'">
    <?= $edit ? "Back to Dashboard" : "Back to Dashboard " ?>
</button>