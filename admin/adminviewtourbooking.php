<?php
include '../dbconnect.php';

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
    $paymentStatus = $_POST['payment_status'];

    if (isset($_POST['booking_id']) && !empty($_POST['booking_id'])) {
        // Update existing booking
        $booking_id = $_POST['booking_id'];
        // Fetch existing order_id
        $stmt = $conn->prepare("SELECT order_id FROM tour_bookings WHERE booking_id = ?");
        $stmt->bind_param("i", $booking_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $order_id = $result->fetch_assoc()['order_id'] ?? NULL;
        $stmt->close();

        $stmt = $conn->prepare("UPDATE tour_bookings SET userid=?, name=?, email=?, cityid=?, city_name=?, tourid=?, tour_name=?, tourists=?, tour_date=?, contact=?, price_per_person=?, total_amount=?, payment_status=? WHERE booking_id=?");
        $stmt->bind_param(
            "ississsissdssi",
            $userid,
            $name,
            $email,
            $cityid,
            $city_name,
            $tourid,
            $tour_name,
            $tourists,
            $tour_date,
            $contact,
            $price_per_person,
            $total_amount,
            $paymentStatus,
            $booking_id
        );
    } else {
        // Add new booking (order_id set to NULL or adjust based on schema)
        $order_id = NULL; // Adjust if schema requires a value
        $stmt = $conn->prepare("INSERT INTO tour_bookings (userid, name, email, cityid, city_name, tourid, tour_name, tourists, tour_date, contact, price_per_person, total_amount,  payment_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "ississsissds",
            $userid,
            $name,
            $email,
            $cityid,
            $city_name,
            $tourid,
            $tour_name,
            $tourists,
            $tour_date,
            $contact,
            $price_per_person,
            $total_amount,
            $paymentStatus
        );
    }

    if ($stmt->execute()) {
        $stmt->close();
        header("Location: adminviewtourbooking.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// DELETE
if (isset($_GET['delete'])) {
    $booking_id = filter_var($_GET['delete'], FILTER_VALIDATE_INT);
    if ($booking_id) {
        $stmt = $conn->prepare("DELETE FROM tour_bookings WHERE booking_id = ?");
        $stmt->bind_param("i", $booking_id);
        if ($stmt->execute()) {
            $stmt->close();
            header("Location: adminviewtourbooking.php");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Invalid booking ID.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tour Bookings Management</title>
    <link rel="stylesheet" type="text/css" href="../css/adminviewtourbooking.css">
    <link rel="icon" type="image/png" href="../images/favicon.png">
</head>
<body>
    <h2>Tour Bookings List</h2>
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
        <?php
        $result = $conn->query("SELECT * FROM tour_bookings");
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . htmlspecialchars($row['booking_id']) . "</td>
                    <td>" . htmlspecialchars($row['userid']) . "</td>
                    <td>" . htmlspecialchars($row['name']) . "</td>
                    <td>" . htmlspecialchars($row['email']) . "</td>
                    <td>" . htmlspecialchars($row['city_name']) . "</td>
                    <td>" . htmlspecialchars($row['tour_name']) . "</td>
                    <td>" . htmlspecialchars($row['tour_date']) . "</td>
                    <td>" . htmlspecialchars($row['tourists']) . "</td>
                    <td>" . htmlspecialchars($row['contact']) . "</td>
                    <td>" . htmlspecialchars($row['price_per_person']) . "</td>
                    <td>" . htmlspecialchars($row['total_amount']) . "</td>
                    <td>" . htmlspecialchars($row['order_id'] ?? '') . "</td>
                    <td>" . htmlspecialchars($row['payment_status']) . "</td>
                    <td>
                        <a href='?edit=" . htmlspecialchars($row['booking_id']) . "'>Edit</a> |
                        <a href='?delete=" . htmlspecialchars($row['booking_id']) . "' onclick='return confirm(\"Are you sure you want to delete?\")'>Delete</a>
                    </td>
                </tr>";
            }
            $result->free();
        } else {
            echo "<tr><td colspan='13'>Error: " . $conn->error . "</td></tr>";
        }
        ?>
    </table>

    <?php
    $booking = [
        "booking_id" => "",
        "userid" => "",
        "name" => "",
        "email" => "",
        "cityid" => "",
        "city_name" => "",
        "tourid" => "",
        "tour_name" => "",
        "tourists" => 1,
        "tour_date" => "",
        "contact" => "",
        "price_per_person" => "",
        "payment_status" => ""
    ];
    if (isset($_GET['edit'])) {
        $edit_id = filter_var($_GET['edit'], FILTER_VALIDATE_INT);
        if ($edit_id) {
            $stmt = $conn->prepare("SELECT * FROM tour_bookings WHERE booking_id = ?");
            $stmt->bind_param("i", $edit_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $booking = $result->fetch_assoc();
            } else {
                echo "No booking found with ID: $edit_id";
            }
            $stmt->close();
        } else {
            echo "Invalid edit ID.";
        }
    }
    ?>

    <div class="form-wrapper">
        <form method="POST">
            <h2><?= isset($_GET['edit']) ? "Edit Booking" : "Add New Booking"; ?></h2>
            <input type="hidden" name="booking_id" value="<?= htmlspecialchars($booking['booking_id']) ?>">
            <div class="form-columns">
                <div>
                    <label for="userid">User ID:</label>
                    <input type="number" id="userid" name="userid" value="<?= htmlspecialchars($booking['userid']) ?>" required>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?= htmlspecialchars($booking['name']) ?>" required>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($booking['email']) ?>" required>
                    <label for="cityid">City ID:</label>
                    <input type="number" id="cityid" name="cityid" value="<?= htmlspecialchars($booking['cityid']) ?>" required>
                    <label for="city_name">City Name:</label>
                    <input type="text" id="city_name" name="city_name" value="<?= htmlspecialchars($booking['city_name']) ?>" required>
                    <label for="tourid">Tour ID:</label>
                    <input type="number" id="tourid" name="tourid" value="<?= htmlspecialchars($booking['tourid']) ?>" required>
                </div>
                <div>
                    <label for="tour_name">Tour Name:</label>
                    <input type="text" id="tour_name" name="tour_name" value="<?= htmlspecialchars($booking['tour_name']) ?>" required>
                    <label for="tourists">Guests:</label>
                    <input type="number" id="tourists" name="tourists" value="<?= htmlspecialchars($booking['tourists']) ?>" required>
                    <label for="tour_date">Tour Date:</label>
                    <input type="date" id="tour_date" name="tour_date" value="<?= htmlspecialchars($booking['tour_date']) ?>" required>
                    <label for="contact">Contact:</label>
                    <input type="text" id="contact" name="contact" value="<?= htmlspecialchars($booking['contact']) ?>" required>
                    <label for="price_per_person">Price per Person:</label>
                    <input type="number" id="price_per_person" name="price_per_person" value="<?= htmlspecialchars($booking['price_per_person']) ?>" required>
                    <label for="payment_status">Status:</label>
                    <select id="payment_status" name="payment_status" required>
                        <option value="pending" <?= ($booking['payment_status'] == 'pending') ? 'selected' : '' ?>>Pending</option>
                        <option value="completed" <?= ($booking['payment_status'] == 'completed') ? 'selected' : '' ?>>Completed</option>
                        <option value="failed" <?= ($booking['payment_status'] == 'failed') ? 'selected' : '' ?>>Failed</option>
                    </select>
                </div>
            </div>
            <input type="submit" value="<?= isset($_GET['edit']) ? "Update Booking" : "Add Booking" ?>">
        </form>
    </div>

    <button onclick="window.location.href='admindashboard.php'">Back to Dashboard</button>
</body>
</html>
<?php $conn->close(); ?>