<?php
require_once '../dbconnect.php'; // Path to your database connection

// ADD or EDIT
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = $_POST['userid'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $cityid = $_POST['cityid'];
    $city_name = $_POST['city_name'];
    $tourid = $_POST['tourid'];
    $tour_name = $_POST['tour_name'];
    $tourists = $_POST['tourists'];
    $tour_date = $_POST['tour_date'];
    $contact = $_POST['contact'];
    $price_per_person = $_POST['price_per_person'];
    $total_amount = $price_per_person * $tourists;

    if (isset($_POST['booking_id']) && $_POST['booking_id'] != "") {
        // Update existing booking
        $booking_id = $_POST['booking_id'];
       $stmt = $conn->prepare("UPDATE tour_bookings SET userid=?, name=?, email=?, cityid=?, city_name=?, tourid=?, tour_name=?, tourists=?, tour_date=?, contact=?, price_per_person=?, total_amount=? WHERE booking_id=?");

$stmt->bind_param("ississsissddi",
    $userid, $name, $email, $cityid, $city_name,
    $tourid, $tour_name, $tourists, $tour_date,
    $contact, $price_per_person, $total_amount, $booking_id);

    } else {
        // Add new booking 
        $stmt = $conn->prepare("INSERT INTO tour_bookings (userid, name, email, cityid, city_name, tourid, tour_name, tourists, tour_date, contact, price_per_person, total_amount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("ississsissdd",
    $userid, $name, $email, $cityid, $city_name,
    $tourid, $tour_name, $tourists, $tour_date,
    $contact, $price_per_person, $total_amount);

    }
    header("Location: adminviewtourbooking.php");
    exit;
}

// DELETE
if (isset($_GET['delete'])) {
    $booking_id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM tour_bookings WHERE booking_id = ?");
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    header("Location: adminviewtourbooking.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Tour Bookings Management</title>
<link rel="stylesheet" type="text/css" href="../css/adminviewtourbooking.css">
</head>
<body>

<h2>Tour Bookings List</h2>
<table>
    <tr>
        <th>ID</th><th>User ID</th><th>Name</th><th>Email</th><th>City</th><th>Tour</th><th>Date</th><th>Guests</th><th>Contact</th><th>Price</th><th>Total</th><th>Actions</th>
    </tr>
    <?php
    $result = $conn->query("SELECT * FROM tour_bookings");
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['booking_id']}</td>
            <td>{$row['userid']}</td>
            <td>{$row['name']}</td>
            <td>{$row['email']}</td>
            <td>{$row['city_name']}</td>
            <td>{$row['tour_name']}</td>
            <td>{$row['tour_date']}</td>
            <td>{$row['tourists']}</td>
            <td>{$row['contact']}</td>
            <td>{$row['price_per_person']}</td>
            <td>{$row['total_amount']}</td>
            <td>
                <a href='?edit={$row['booking_id']}'>Edit</a> |
                <a href='?delete={$row['booking_id']}' onclick='return confirm(\"Are you sure you want to delete?\")'>Delete</a>
            </td>
        </tr>";
    }
    ?>
</table>

<?php
// Fetch booking data for editing
$booking = [
    "booking_id" => "",
    "userid" => "", "name" => "", "email" => "", "cityid" => "", "city_name" => "",
    "tourid" => "", "tour_name" => "", "tourists" => 1, "tour_date" => "", "contact" => "",
    "price_per_person" => ""
];
if (isset($_GET['edit'])) {
    $stmt = $conn->prepare("SELECT * FROM tour_bookings WHERE booking_id = ?");
    $stmt->bind_param("i", $_GET['edit']);
    $stmt->execute();
    $result = $stmt->get_result();
    $booking = $result->fetch_assoc();
}
?>

<div class="form-wrapper">
    <form method="POST">
        <h3 style="margin-bottom: 20px; color: #004080;">
            <?php echo isset($_GET['edit']) ? "Edit Booking" : "Add New Booking"; ?>
        </h3>
        <input type="hidden" name="booking_id" value="<?= htmlspecialchars($booking['booking_id']) ?>">

        <div class="form-columns">
            <div>
                <label>User ID:</label>
                <input type="number" name="userid" value="<?= htmlspecialchars($booking['userid']) ?>" required>

                <label>Name:</label>
                <input type="text" name="name" value="<?= htmlspecialchars($booking['name']) ?>" required>

                <label>Email:</label>
                <input type="email" name="email" value="<?= htmlspecialchars($booking['email']) ?>" required>

                <label>City ID:</label>
                <input type="number" name="cityid" value="<?= htmlspecialchars($booking['cityid']) ?>" required>

                <label>City Name:</label>
                <input type="text" name="city_name" value="<?= htmlspecialchars($booking['city_name']) ?>" required>

                <label>Tour ID:</label>
                <input type="number" name="tourid" value="<?= htmlspecialchars($booking['tourid']) ?>" required>
            </div>

            <div>
                <label>Tour Name:</label>
                <input type="text" name="tour_name" value="<?= htmlspecialchars($booking['tour_name']) ?>" required>

                <label>Guests:</label>
                <input type="number" name="tourists" value="<?= htmlspecialchars($booking['tourists']) ?>" required>

                <label>Tour Date:</label>
                <input type="date" name="tour_date" value="<?= htmlspecialchars($booking['tour_date']) ?>" required>

                <label>Contact:</label>
                <input type="text" name="contact" value="<?= htmlspecialchars($booking['contact']) ?>" required>

                <label>Price per Person:</label>
                <input type="number" name="price_per_person" value="<?= htmlspecialchars($booking['price_per_person']) ?>" required>
            </div>
        </div>

        <input type="submit" value="<?= isset($_GET['edit']) ? "Update" : "Add" ?>">
    </form>
</div>

<button onclick="window.location.href='admindashboard.php'">Back to Dashboard</button>

</body>
</html>
