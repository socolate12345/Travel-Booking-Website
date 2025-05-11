<?php
session_start();

// Kiểm tra đăng nhập
if (!isset($_SESSION['usersid'])) {
    header("Location: ../Login/login.php");
    exit();
}

$userid = $_SESSION['usersid'];
$servername = "localhost";
$username = "root";
$password ="admin";
$dbname = "travelscapes";

// Kết nối DB
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Xử lý yêu cầu xóa booking
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $deleteId = (int)$_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM hotel_bookings WHERE booking_id = ? AND userid = ?");
    $stmt->bind_param("ii", $deleteId, $userid);
    $stmt->execute();
    $stmt->close();
    header("Location: receiptlist.php");
    exit();
}

// Lấy danh sách booking
$receipts = [];
$stmt = $conn->prepare("SELECT booking_id, name, email, hotel_name, city_name, tourists, total_amount, tour_date FROM hotel_bookings WHERE userid = ?");
$stmt->bind_param("i", $userid);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $receipts[] = $row;
}
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Receipt List</title>
    <style>
        body {
            background-color: #fff;
            color: #000;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #3498db;
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            width: 90%;
            margin: 0 auto 20px auto;
            background-color: #fff;
            border: 1px solid #3498db;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border-bottom: 1px solid #3498db;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #eaf6fb;
            color: #3498db;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .back-home, .delete-link {
            text-align: center;
            margin-top: 30px;
        }

        .back-home a, .delete-link a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .back-home a:hover, .delete-link a:hover {
            background-color: #2980b9;
        }

        .delete-link a {
            background-color: #e74c3c;
        }

        .delete-link a:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <h2>Receipts: All the purchased tours</h2>

    <table>
        <tr>
            <th>Booking ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Hotel's Name</th>
            <th>City</th>
            <th>Number of Tourists</th>
            <th>Price of the Tour</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        <?php if (!empty($receipts)): ?>
            <?php foreach ($receipts as $receipt): ?>
                <tr>
                    <td><?= htmlspecialchars($receipt['booking_id']) ?></td>
                    <td><?= htmlspecialchars($receipt['name']) ?></td>
                    <td><?= htmlspecialchars($receipt['email']) ?></td>
                    <td><?= htmlspecialchars($receipt['hotel_name']) ?></td>
                    <td><?= htmlspecialchars($receipt['city_name']) ?></td>
                    <td><?= htmlspecialchars($receipt['tourists']) ?></td>
                    <td><?= htmlspecialchars($receipt['total_amount']) ?> VND</td>
                    <td><?= htmlspecialchars($receipt['tour_date']) ?></td>
                    <td class="delete-link">
                        <a href="?delete=<?= $receipt['booking_id'] ?>" onclick="return confirm('Are you sure you want to delete this booking?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="8">No receipts recorded.</td></tr>
        <?php endif; ?>
    </table>

    <div class="back-home">
        <a href="../Login/loggedinhome.php">Return to the homepage.</a>
    </div>
</body>
</html>
