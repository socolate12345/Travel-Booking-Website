<?php
require_once '../dbconnect.php';

// DELETE
if (isset($_GET['delete'])) {
    $booking_id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM tour_bookings WHERE booking_id = ?");
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    header("Location: adminviewtourbooking.php");
    exit;
}

// Get distinct cities for dropdown
$city_query = "SELECT DISTINCT city_name FROM tour_bookings ORDER BY city_name";
$city_result = $conn->query($city_query);

// FILTER
$filter_city = $_GET['city'] ?? '';
$filter_status = $_GET['status'] ?? '';
$filter_price = $_GET['price'] ?? '';

$where = [];
$params = [];
$types = '';

if (!empty($filter_city)) {
    $where[] = "city_name = ?";
    $params[] = $filter_city;
    $types .= 's';
}
if (!empty($filter_status)) {
    $where[] = "payment_status = ?";
    $params[] = $filter_status;
    $types .= 's';
}
if (!empty($filter_price)) {
    if ($filter_price === '1to5') {
        $where[] = "price_per_person BETWEEN 00 AND 5000000";
    } elseif ($filter_price === '5to10') {
        $where[] = "price_per_person BETWEEN 5000000 AND 10000000";
    } elseif ($filter_price === 'over10') {
        $where[] = "price_per_person > 10000000";
    }
}

$sql = "SELECT * FROM tour_bookings";
if (!empty($where)) {
    $sql .= " WHERE " . implode(" AND ", $where);
}
$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Tour Bookings Management</title>
    <link rel="stylesheet" href="../css/adminviewtourbooking.css" />
    <style>
.filter-form {
    margin-bottom: 20px;
    display: flex;
    justify-content: center;
    gap: 15px;
    align-items: center;
    border: none; /* Remove any border */
    background: none; /* Remove any background */
    padding: 0; /* Remove any padding */
    margin-left: 375px;
}

.filter-form select {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.filter-form button {
    padding: 8px 16px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-bottom: 10px;
}

.filter-form button:hover {
    background-color: #45a049;
}

/* Optional: Reset div styling inside filter-form to avoid inherited styles */
.filter-form div {
    border: none;
    background: none;
    padding: 0;
    margin: 0;
}
    </style>
</head>
<body>
    <h2>Tour Bookings List</h2>

    <!-- Filter Form -->
    <form class="filter-form" method="GET" action="">
        <div>
            <label for="city">City:</label>
            <select name="city" id="city">
                <option value="">All Cities</option>
                <?php while ($city_row = $city_result->fetch_assoc()): ?>
                    <option value="<?= htmlspecialchars($city_row['city_name']) ?>" 
                        <?= $filter_city === $city_row['city_name'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($city_row['city_name']) ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>

        <div>
            <label for="status">Status:</label>
            <select name="status" id="status">
                <option value="">All Statuses</option>
                <option value="completed" <?= $filter_status === 'completed' ? 'selected' : '' ?>>Completed</option>
                <option value="failed" <?= $filter_status === 'failed' ? 'selected' : '' ?>>Failed</option>
                <option value="pending" <?= $filter_status === 'pending' ? 'selected' : '' ?>>Pending</option>
            </select>
        </div>

        <div>
            <label for="price">Price Range:</label>
            <select name="price" id="price">
                <option value="">All Prices</option>
                <option value="1to5" <?= $filter_price === '1to5' ? 'selected' : '' ?>>0M - 5M</option>
                <option value="5to10" <?= $filter_price === '5to10' ? 'selected' : '' ?>>5M - 10M</option>
                <option value="over10" <?= $filter_price === 'over10' ? 'selected' : '' ?>>Over 10M</option>
            </select>
        </div>

        <button type="submit">Apply Filters</button>
    </form>
</body>
</html>
    <table>
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>City</th>
            <th>Tour</th>
            <th>Date</th>
            <th>Guests</th>
            <th>Contact</th>
            <th>Price</th>
            <th>Total</th>
            <th>Order ID</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['booking_id'] ?></td>
                <td><?= $row['userid'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['city_name'] ?></td>
                <td><?= $row['tour_name'] ?></td>
                <td><?= $row['tour_date'] ?></td>
                <td><?= $row['tourists'] ?></td>
                <td><?= $row['contact'] ?></td>
                <td><?= number_format($row['price_per_person'], 0, ',', '.') ?></td>
                <td><?= number_format($row['total_amount'], 0, ',', '.') ?></td>
                <td><?= $row['order_id'] ?></td>
                <td><?= $row['payment_status'] ?></td>
                <td>
                    <a href="controllers/edittourbooking.php?edit=<?= $row['booking_id'] ?>">Edit</a> |
                    <a href="?delete=<?= $row['booking_id'] ?>" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <div class="back-btn-wrapper">
        <button class="back-btn" onclick="window.location.href='admindashboard.php'">Back to Dashboard</button>
    </div>
</body>
</html>