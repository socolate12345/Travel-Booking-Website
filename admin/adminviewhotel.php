<?php
include '../dbconnect.php';

// Xử lý thêm hoặc cập nhật
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hotelid = $_POST["hotelid"];
    $hotel = $_POST["hotel"];
    $cityid = $_POST["cityid"];
    $cost = $_POST["cost"];
    $amenities = $_POST["amenities"];
    $ratings = $_POST["ratings"];

    if ($hotelid) {
        // Cập nhật
        $stmt = $conn->prepare("UPDATE hotels SET hotel=?, cityid=?, cost=?, amenities=?, ratings=? WHERE hotelid=?");
        $stmt->bind_param("siisii", $hotel, $cityid, $cost, $amenities, $ratings, $hotelid);
        $stmt->execute();
    } else {
        // Thêm mới
        $stmt = $conn->prepare("INSERT INTO hotels (hotel, cityid, cost, amenities, ratings) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("siisi", $hotel, $cityid, $cost, $amenities, $ratings);
        $stmt->execute();
    }

    header("Location: adminviewhotel.php");
    exit();
}

// Xóa khách sạn
if (isset($_GET["delete"])) {
    $id = (int)$_GET["delete"];
    $conn->query("DELETE FROM hotels WHERE hotelid = $id");
    header("Location: adminviewhotel.php");
    exit();
}

// Lấy danh sách khách sạn
$result = $conn->query("SELECT * FROM hotels");

// Lấy danh sách cities để chọn cityid
$cities_result = $conn->query("SELECT cityid, city FROM cities");
$city_options = [];
while ($city = $cities_result->fetch_assoc()) {
    $city_options[$city['cityid']] = $city['city'];
}
?>

<h2>Danh sách Khách Sạn</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th><th>Tên KS</th><th>City ID</th><th>Chi phí</th><th>Tiện nghi</th><th>Đánh giá</th><th>Hành động</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
    <tr>
        <td><?= $row["hotelid"] ?></td>
        <td><?= htmlspecialchars($row["hotel"]) ?></td>
        <td><?= $row["cityid"] ?> - <?= $city_options[$row["cityid"]] ?? "Không rõ" ?></td>
        <td><?= number_format($row["cost"]) ?></td>
        <td><?= nl2br(htmlspecialchars($row["amenities"])) ?></td>
        <td><?= $row["ratings"] ?></td>
        <td>
            <a href="?edit=<?= $row["hotelid"] ?>">Sửa</a> |
            <a href="?delete=<?= $row["hotelid"] ?>" onclick="return confirm('Xóa khách sạn này?')">Xóa</a>
        </td>
    </tr>
    <?php } ?>
</table>

<?php
// Lấy thông tin để sửa
$edit = null;
if (isset($_GET["edit"])) {
    $id = (int)$_GET["edit"];
    $edit = $conn->query("SELECT * FROM hotels WHERE hotelid = $id")->fetch_assoc();
}
?>

<h2><?= $edit ? "Chỉnh sửa Khách Sạn #" . $edit["hotelid"] : "Thêm Khách Sạn Mới" ?></h2>
<form method="POST">
    <input type="hidden" name="hotelid" value="<?= $edit["hotelid"] ?? '' ?>">
    Tên khách sạn: <input name="hotel" value="<?= $edit["hotel"] ?? '' ?>"><br>
    City:
    <select name="cityid">
        <?php foreach ($city_options as $id => $name) { ?>
            <option value="<?= $id ?>" <?= ($edit["cityid"] ?? '') == $id ? "selected" : "" ?>>
                <?= "$id - $name" ?>
            </option>
        <?php } ?>
    </select><br>
    Chi phí: <input name="cost" type="number" value="<?= $edit["cost"] ?? '' ?>"><br>
    Tiện nghi: <textarea name="amenities"><?= $edit["amenities"] ?? '' ?></textarea><br>
    Đánh giá: <input name="ratings" type="number" min="1" max="5" value="<?= $edit["ratings"] ?? '' ?>"><br>
    <button type="submit"><?= $edit ? "Cập nhật" : "Thêm mới" ?></button>
</form>
<button onclick="window.location.href='admindashboard.php'">
    <?= $edit ? "Back to Dashboard" : "Back to Dashboard " ?>
</button>