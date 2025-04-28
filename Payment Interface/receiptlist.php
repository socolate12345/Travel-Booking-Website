<?php
// receiptlist.php
session_start();
// Read json receipts.
$username = $_SESSION['username'] ?? 'guest';

$receiptFile = "receipts_$username.json";
$receipts = [];

if (file_exists($receiptFile)) {
    $receipts = json_decode(file_get_contents($receiptFile), true);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Receipt List</title>
    <style>
/* Global Styles */
body {
    background-color: #fff;
    color:rgb(0, 0, 0); 
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
}

/* Heading */
h2 {
    color: #3498db; 
    text-align: center;
    margin-bottom: 20px;
}

/* Table Styles */
table {
    border-collapse: collapse;
    width: 90%;
    margin: 0 auto 20px auto;
    background-color: #fff;
    border: 1px solid #3498db; /* Blue border */
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

/* Link back home */
.back-home {
    text-align: center;
    margin-top: 30px;
}

.back-home a {
    display: inline-block;
    padding: 10px 20px;
    background-color: #3498db; 
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
}

.back-home a:hover {
    background-color: #2980b9; 
}
</style>
</head>
<body>
    <h2> Receipts: All the purchased tours.</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Hotel's Name</th>
            <th>Number of tourists</th>
            <th>Price of the tour</th>
            <th>Date</th>
        </tr>
        <?php if (!empty($receipts)): ?>
            <?php foreach ($receipts as $receipt): ?>
                <tr>
    <td><?= htmlspecialchars($receipt['id'] ?? '') ?></td>
    <td><?= htmlspecialchars($receipt['name'] ?? '') ?></td>
    <td><?= htmlspecialchars($receipt['email'] ?? '') ?></td>
    <td><?= htmlspecialchars($receipt['hotel'] ?? 'N/A') ?></td>
    <td><?= htmlspecialchars($receipt['tourists'] ?? '') ?></td>
    <td><?= htmlspecialchars($receipt['amount'] ?? '') ?> VND</td>
    <td><?= htmlspecialchars($receipt['date'] ?? '') ?></td>
                </tr>

            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="7">No receipts recorded.</td></tr>
        <?php endif; ?>
    </table>
    
    <div class="back-home">
        <a href="../Login/loggedinhome.php">Return to the homepage.</a>
    </div>
</body>
</html>
