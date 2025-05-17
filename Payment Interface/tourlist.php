<?php
session_start();

// Kiểm tra đăng nhập
if (!isset($_SESSION['usersid'])) {
    header("Location: ../Login/login.php");
    exit();
}

include '../dbconnect.php';

// Xử lý xóa booking
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $booking_id = (int)$_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM tour_bookings WHERE booking_id = ? AND userid = ?");
    $stmt->bind_param("ii", $booking_id, $_SESSION['usersid']);
    $stmt->execute();
    $stmt->close();
    header("Location: tourlist.php");
    exit();
}

// Lấy danh sách bookings của người dùng hiện tại
$bookings = [];
$stmt = $conn->prepare("SELECT tb.booking_id, tb.userid, tb.name, tb.email, tb.city_name, tb.tour_name, 
                               tb.tourists, tb.tour_date, tb.contact, tb.price_per_person, tb.total_amount, 
                               tb.booking_date
                        FROM tour_bookings tb
                        WHERE tb.userid = ?");
$stmt->bind_param("i", $_SESSION['usersid']);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $bookings[] = $row;
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tour Reserve</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #fff;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
        }

        table {
            width: 95%;
            margin: auto;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ccc;
            text-align: center;
        }

        th {
            background-color: #3498db;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .delete-link a {
            background-color: #e74c3c;
            color: white;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
        }

        .delete-link a:hover {
            background-color: #c0392b;
        }

        .back-home {
            text-align: center;
            margin-top: 30px;
        }

        .back-home a {
            padding: 10px 20px;
            background-color: #2ecc71;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .back-home a:hover {
            background-color: #27ae60;
        }
    </style>
</head>
<body>
    <h2>My Bookings</h2>

    <table>
        <tr>
            <th>Booking ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>City</th>
            <th>Tour Name</th>
            <th>Tourists</th>
            <th>Tour Date</th>
            <th>Contact</th>
            <th>Price/Person (VND)</th>
            <th>Total Amount (VND)</th>
            <th>Booking Date</th>
            <th>Action</th>
        </tr>
        <?php if (!empty($bookings)): ?>
            <?php foreach ($bookings as $booking): ?>
                <tr>
                    <td><?= htmlspecialchars($booking['booking_id']) ?></td>
                    <td><?= htmlspecialchars($booking['name']) ?></td>
                    <td><?= htmlspecialchars($booking['email']) ?></td>
                    <td><?= htmlspecialchars($booking['city_name']) ?></td>
                    <td><?= htmlspecialchars($booking['tour_name']) ?></td>
                    <td><?= htmlspecialchars($booking['tourists']) ?></td>
                    <td><?= htmlspecialchars($booking['tour_date']) ?></td>
                    <td><?= htmlspecialchars($booking['contact']) ?></td>
                    <td><?= number_format($booking['price_per_person']) ?></td>
                    <td><?= number_format($booking['total_amount']) ?></td>
                    <td><?= htmlspecialchars($booking['booking_date']) ?></td>
                    <td class="delete-link">
                        <a href="?delete=<?= $booking['booking_id'] ?>" onclick="return confirm('Are you sure you want to delete this booking?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="12">No bookings available.</td></tr>
        <?php endif; ?>
    </table>

    <div class="back-home">
        <a href="../Login/profile.php">Return to Profile</a>
    </div>
</body>
</html>