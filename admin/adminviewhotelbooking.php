<?php
include '../dbconnect.php';

// Fetch cities for dropdown
$city_result = $conn->query("SELECT DISTINCT cityid, city_name FROM hotel_bookings ORDER BY city_name");

// Handle filters
$city_filter = $_GET['city'] ?? '';
$price_filter = $_GET['price'] ?? '';
$status_filter = $_GET['status'] ?? '';

$where = [];
$params = [];
$types = '';

if ($city_filter) {
    $where[] = "cityid = ?";
    $params[] = $city_filter;
    $types .= 'i';
}

if ($price_filter) {
    if ($price_filter == 'under_1m') {
        $where[] = "total_amount < 1000000";
    } elseif ($price_filter == '1m_2m') {
        $where[] = "total_amount BETWEEN 1000000 AND 2000000";
    } elseif ($price_filter == 'above_2m') {
        $where[] = "total_amount > 2000000";
    }
}

if ($status_filter) {
    $where[] = "payment_status = ?";
    $params[] = $status_filter;
    $types .= 's';
}

$query = "SELECT * FROM hotel_bookings";
if ($where) {
    $query .= " WHERE " . implode(" AND ", $where);
}

$stmt = $conn->prepare($query);
if ($params) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hotel Bookings List</title>
    <link rel="stylesheet" type="text/css" href="../css/adminviewhotelbooking.css">
    <link rel="icon" type="image/png" href="../images/favicon.png">
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
    margin-left: 300px;
}

.filter-form select {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-right: 30px;
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
    <h2>Hotel Bookings List</h2>
    
    <!-- Filter Form -->
    <form method="GET" class="filter-form">
    <div>
        <label for="city">City:</label>
        <select id="city" name="city">
            <option value="">All Cities</option>
            <?php while ($city = $city_result->fetch_assoc()) { ?>
                <option value="<?= htmlspecialchars($city['cityid']) ?>" 
                    <?= $city_filter == $city['cityid'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($city['city_name']) ?>
                </option>
            <?php } ?>
        </select>
    </div>

    <div>
        <label for="price">Price Range:</label>
        <select id="price" name="price">
            <option value="">All Prices</option>
            <option value="under_1m" <?= $price_filter == 'under_1m' ? 'selected' : '' ?>>Under 1M</option>
            <option value="1m_2m" <?= $price_filter == '1m_2m' ? 'selected' : '' ?>>1M - 2M</option>
            <option value="above_2m" <?= $price_filter == 'above_2m' ? 'selected' : '' ?>>Above 2M</option>
        </select>
    </div>

    <div>
        <label for="status">Status:</label>
        <select id="status" name="status">
            <option value="">All Statuses</option>
            <option value="pending" <?= $status_filter == 'pending' ? 'selected' : '' ?>>Pending</option>
            <option value="failed" <?= $status_filter == 'failed' ? 'selected' : '' ?>>Failed</option>
            <option value="completed" <?= $status_filter == 'completed' ? 'selected' : '' ?>>Completed</option>
        </select>
    </div>

    <div>
        <button type="submit">Filter</button>
    </div>
</form>

    <table>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Email</th>
            <th>City</th>
            <th>Hotel</th>
            <th>Booking Date</th>
            <th>Check-in</th>
            <th>Check-out</th>
            <th>Rooms</th>
            <th>Room Type</th>
            <th>Guests</th>
            <th>Total</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= htmlspecialchars($row["booking_id"]) ?></td>
                <td><?= htmlspecialchars($row["name"]) ?></td>
                <td><?= htmlspecialchars($row["email"]) ?></td>
                <td><?= htmlspecialchars($row["city_name"]) ?></td>
                <td><?= htmlspecialchars($row["hotel_name"]) ?></td>
                <td><?= htmlspecialchars($row["booking_date"]) ?></td>
                <td><?= htmlspecialchars($row["check_in_date"]) ?></td>
                <td><?= htmlspecialchars($row["check_out_date"]) ?></td>
                <td><?= htmlspecialchars($row["number_of_rooms"]) ?></td>
                <td><?= htmlspecialchars($row["room_type"]) ?></td>
                <td><?= htmlspecialchars($row["tourists"]) ?></td>
                <td><?= htmlspecialchars($row["total_amount"]) ?></td>
                <td><?= htmlspecialchars($row["payment_status"]) ?></td>
                <td>
                    <a href="controllers/edithotelbooking.php?edit=<?= htmlspecialchars($row["booking_id"]) ?>">Edit</a> |
                    <a href="?delete=<?= htmlspecialchars($row["booking_id"]) ?>" 
                        onclick="return confirm('Are you sure you want to delete this booking?')">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <div class="back-btn-wrapper">
        <button class="back-btn" onclick="window.location.href='admindashboard.php'">Back to Dashboard</button>
    </div>
</body>
</html>
<?php $stmt->close(); ?>