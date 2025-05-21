<?php
session_start();
require_once 'dbconnect.php'; // Your database connection file

// MoMo response parameters
$resultCode = $_GET['resultCode'] ?? null;
$orderId = $_GET['orderId'] ?? null;
$message = $_GET['message'] ?? 'Unknown error';
$amount = $_GET['amount'] ?? 0;

// Verify the payment result
if ($resultCode == '0') {
    // Payment successful
    $bookingId = explode('_', $orderId)[1] ?? 0;
    $stmt = $conn->prepare("UPDATE hotel_bookings SET payment_status = 'completed' WHERE booking_id = ?");
    $stmt->bind_param("i", $bookingId);
    $stmt->execute();
    $stmt->close();

    $message = "Thanh toán thành công cho đơn hàng $orderId!";
} else {
    // Payment failed
    $message = "Thanh toán thất bại: $message";
}

// Display result to user
?>
<!DOCTYPE html>
<html lang="vi">
     <link rel="icon" type="image/png" href="/images/favicon.png">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả thanh toán</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding: 50px; }
        .success { color: green; }
        .error { color: red; }
        a { display: inline-block; margin-top: 20px; padding: 10px 20px; background: #4CAF50; color: white; text-decoration: none; border-radius: 5px; }
    </style>
</head>
<body>
    <h2>Kết quả thanh toán</h2>
    <p class="<?php echo $resultCode == '0' ? 'success' : 'error'; ?>">
        <?php echo htmlspecialchars($message); ?>
    </p>
    <p>Số tiền: <?php echo number_format($amount); ?>đ</p>
    <a href="./Login/loggedinhome.php">🏠 Về trang chủ</a>
</body>
</html>