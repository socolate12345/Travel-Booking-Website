<?php
include '../dbconnect.php';

// Xử lý thêm / cập nhật
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tourid = $_POST["tourid"];
    $cityid = $_POST["cityid"];
    $tour_name = $_POST["tour_name"];
    $description = $_POST["description"];
    $duration_days = $_POST["duration_days"];
    $price_per_person = $_POST["price_per_person"];
    $season = $_POST["season"];

    if ($tourid) {
        // Cập nhật tour
        $stmt = $conn->prepare("UPDATE tours SET cityid=?, tour_name=?, description=?, duration_days=?, price_per_person=?, season=? WHERE tourid=?");
        $stmt->bind_param("issiisi", $cityid, $tour_name, $description, $duration_days, $price_per_person, $season, $tourid);
        $stmt->execute();
    } else {
        // Thêm tour mới
        $stmt = $conn->prepare("INSERT INTO tours (cityid, tour_name, description, duration_days, price_per_person, season) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issiis", $cityid, $tour_name, $description, $duration_days, $price_per_person, $season);
        $stmt->execute();
    }

    header("Location: adminviewtour.php");
    exit();
}

// Xử lý xóa
if (isset($_GET["delete"])) {
    $id = (int)$_GET["delete"];
    $conn->query("DELETE FROM tours WHERE tourid = $id");
    header("Location: adminviewtour.php");
    exit();
}

// Lấy danh sách tours
$tours = $conn->query("SELECT * FROM tours");

// Lấy danh sách cities
$cities = $conn->query("SELECT cityid, city FROM cities");
$city_options = [];
while ($row = $cities->fetch_assoc()) {
    $city_options[$row['cityid']] = $row['city'];
}
?>

<h2>Danh sách Tour</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>ID</th><th>Thành phố</th><th>Tên tour</th><th>Mô tả</th><th>Số ngày</th><th>Giá/người</th><th>Mùa</th><th>Ngày tạo</th><th>Hành động</th>
    </tr>
    <?php while ($row = $tours->fetch_assoc()) { ?>
    <tr>
        <td><?= $row["tourid"] ?></td>
        <td><?= $row["cityid"] ?> - <?= $city_options[$row["cityid"]] ?? "Không rõ" ?></td>
        <td><?= htmlspecialchars($row["tour_name"]) ?></td>
        <td><?= nl2br(htmlspecialchars($row["description"])) ?></td>
        <td><?= $row["duration_days"] ?></td>
        <td><?= number_format($row["price_per_person"]) ?></td>
        <td><?= $row["season"] ?></td>
        <td><?= $row["created_at"] ?></td>
        <td>
            <a href="?edit=<?= $row["tourid"] ?>">Sửa</a> |
            <a href="?delete=<?= $row["tourid"] ?>" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
        </td>
    </tr>
    <?php } ?>
</table>

<?php
// Dữ liệu khi sửa
$edit = null;
if (isset($_GET["edit"])) {
    $id = (int)$_GET["edit"];
    $edit = $conn->query("SELECT * FROM tours WHERE tourid = $id")->fetch_assoc();
}
?>

<h2><?= $edit ? "Chỉnh sửa Tour #" . $edit["tourid"] : "Thêm Tour Mới" ?></h2>
<form method="POST">
    <input type="hidden" name="tourid" value="<?= $edit["tourid"] ?? '' ?>">
    Thành phố:
    <select name="cityid">
        <?php foreach ($city_options as $id => $name): ?>
            <option value="<?= $id ?>" <?= ($edit["cityid"] ?? '') == $id ? 'selected' : '' ?>>
                <?= "$id - $name" ?>
            </option>
        <?php endforeach; ?>
    </select><br>

    Tên tour: <input name="tour_name" value="<?= htmlspecialchars($edit["tour_name"] ?? '') ?>"><br>
    Mô tả: <textarea name="description"><?= htmlspecialchars($edit["description"] ?? '') ?></textarea><br>
    Số ngày: <input type="number" name="duration_days" value="<?= $edit["duration_days"] ?? '' ?>"><br>
    Giá/người: <input type="number" name="price_per_person" value="<?= $edit["price_per_person"] ?? '' ?>"><br>
    Mùa: <input name="season" value="<?= htmlspecialchars($edit["season"] ?? '') ?>"><br>

    <button type="submit"><?= $edit ? "Cập nhật" : "Thêm mới" ?></button>
    <button type="submit"><?= $edit ? "Cập nhật" : "Thêm mới" ?></button>
</form>
<button onclick="window.location.href='admindashboard.php'">
    <?= $edit ? "Back to Dashboard" : "Back to Dashboard " ?>
</button>