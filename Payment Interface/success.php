<?php
session_start();

$name = $_SESSION['name'] ?? 'Unknown';
$email = $_SESSION['email'] ?? 'Unknown';
$amount = $_SESSION['amount'] ?? 0;
$tourists = $_SESSION['tourists'] ?? 1;
$hotelName = $_SESSION['hotelName'] ?? 'Unknown Hotel';
$username = $_SESSION['username'] ?? 'guest'; // <-- Set username to the json file , else place it as guest.

$receipt = [
    'id' => uniqid(),
    'name' => $name,
    'email' => $email,
    'hotel' => $hotelName,
    'tourists' => $tourists,  
    'amount' => $amount,
    'date' => date('d-m-Y H:i:s')
];

$receiptFile = "receipts_$username.json";
$receipts = file_exists($receiptFile) ? json_decode(file_get_contents($receiptFile), true) : [];
$receipts[] = $receipt;
file_put_contents($receiptFile, json_encode($receipts, JSON_PRETTY_PRINT));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Successful</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
        .box { display: inline-block; padding: 20px 40px; background: #e0ffe0; border: 1px solid #00aa00; border-radius: 10px; }
        a { display: inline-block; margin: 15px; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px; }
        a:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <div class="box">
        <h2>Payment Successful!</h2>
        <p>Thank you, <?= htmlspecialchars($name) ?>.</p>
        <p>Amount Paid: <strong><?= htmlspecialchars($amount) ?> VND</strong></p>
        <p>Your receipt has been saved.</p>
        <a href="receiptlist.php">View Receipts</a>
        <a href="/Login/loggedinhome.php">Go to Home</a>
    </div>
</body>
</html>
