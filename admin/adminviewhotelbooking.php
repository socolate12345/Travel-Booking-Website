<?php
include '../dbconnect.php';

// Function to validate date format (YYYY-MM-DD)
function isValidDate($date)
{
    if (preg_match("/^\d{4}-\d{2}-\d{2}$/", $date)) {
        try {
            new DateTime($date);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    return false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $booking_id = $_POST["booking_id"] ?? '';
    $userid = $_POST["userid"] ?? '';
    $name = $_POST["name"] ?? '';
    $email = $_POST["email"] ?? '';
    $cityid = $_POST["cityid"] ?? '';
    $city_name = $_POST["city_name"] ?? '';
    $hotelid = $_POST["hotelid"] ?? '';
    $hotel_name = $_POST["hotel_name"] ?? '';
    $tourists = $_POST["tourists"] ?? '';
    $contact = $_POST["contact"] ?? '';
    $cost_per_day = $_POST["cost_per_day"] ?? '';
    $total_amount = $_POST["total_amount"] ?? '';
    $number_of_rooms = $_POST["number_of_rooms"] ?? '';
    $check_in_date = $_POST["check_in_date"] ?? '';
    $check_out_date = $_POST["check_out_date"] ?? '';
    $room_type = $_POST["room_type"] ?? '';

    // Validate date inputs
    $errors = [];
    if (!isValidDate($check_in_date)) {
        $errors[] = "Invalid check-in date format. Use YYYY-MM-DD.";
    }
    if (!isValidDate($check_out_date)) {
        $errors[] = "Invalid check-out date format. Use YYYY-MM-DD.";
    }

    if (!empty($errors)) {
        echo implode("<br>", $errors);
        exit();
    }

    if ($booking_id) {
        // Prepare the UPDATE statement
        $stmt = $conn->prepare("UPDATE hotel_bookings 
            SET userid = ?, name = ?, email = ?, cityid = ?, city_name = ?, 
                hotelid = ?, hotel_name = ?, tourists = ?, contact = ?, 
                cost_per_day = ?, total_amount = ?, number_of_rooms = ?, 
                check_in_date = ?, check_out_date = ?, room_type = ? 
            WHERE booking_id = ?");

        if (!$stmt) {
            echo "Prepare failed: " . $conn->error;
            exit();
        }

        // Bind parameters (17: 16 for SET + 1 for WHERE)
        $stmt->bind_param(
            "issisisssddisssi", // Sửa lại: "s" thành "i" ở vị trí `$number_of_rooms`
            $userid,
            $name,
            $email,
            $cityid,
            $city_name,
            $hotelid,
            $hotel_name,
            $tourists,
            $contact,
            $cost_per_day,
            $total_amount,
            $number_of_rooms,
            $check_in_date,
            $check_out_date,
            $room_type,
            $booking_id
        );

        // Execute and check for errors
        if (!$stmt->execute()) {
            echo "SQL error: " . $stmt->error;
        } else {
            echo "Booking updated successfully.";
        }
    } else {
        // Prepare the INSERT statement
        $stmt = $conn->prepare("INSERT INTO hotel_bookings 
            (userid, name, email, cityid, city_name, hotelid, hotel_name, 
             tourists, contact, cost_per_day, total_amount, number_of_rooms, 
             check_in_date, check_out_date, room_type) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        if (!$stmt) {
            echo "Prepare failed: " . $conn->error;
            exit();
        }

        $stmt->bind_param(
            "issisisssddisss", //15 Param 
            $userid,
            $name,
            $email,
            $cityid,
            $city_name,
            $hotelid,
            $hotel_name,
            $tourists,
            $contact,
            $cost_per_day,
            $total_amount,
            $number_of_rooms,
            $check_in_date,
            $check_out_date,
            $room_type
        );

        // Execute and check for errors
        if (!$stmt->execute()) {
            echo "SQL error: " . $stmt->error;
        } else {
            echo "Booking inserted successfully.";
        }
    }

    // Close the statement
    $stmt->close();
    header("Location: adminviewhotelbooking.php");
    exit();
}

if (isset($_GET["delete"])) {
    $id = $_GET["delete"];
    $stmt = $conn->prepare("DELETE FROM hotel_bookings WHERE booking_id = ?");
    if (!$stmt) {
        echo "Prepare failed: " . $conn->error;
        exit();
    }
    $stmt->bind_param("i", $id);
    if (!$stmt->execute()) {
        echo "SQL error: " . $stmt->error;
    }
    $stmt->close();
    header("Location: adminviewhotelbooking.php");
    exit();
}

$result = $conn->query("SELECT * FROM hotel_bookings");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Hotel Booking Management</title>
    <link rel="stylesheet" type="text/css" href="../css/adminviewhotelbooking.css">
</head>

<body>

    <h2>Hotel Bookings List</h2>
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
                <td>
                    <a href="?edit=<?= htmlspecialchars($row["booking_id"]) ?>">Edit</a> |
                    <a href="?delete=<?= htmlspecialchars($row["booking_id"]) ?>"
                        onclick="return confirm('Are you sure you want to delete this booking?')">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <?php
    $edit = null;
    if (isset($_GET["edit"])) {
        $id = $_GET["edit"];
        $edit = $conn->query("SELECT * FROM hotel_bookings WHERE booking_id = $id")->fetch_assoc();
    }
    ?>

    <div class="form-container">
        <h2><?= $edit ? "Edit Hotel Booking #" . htmlspecialchars($edit["booking_id"]) : "Add New Hotel Booking" ?></h2>
        <form method="POST" novalidate>
            <input type="hidden" name="booking_id" value="<?= htmlspecialchars($edit["booking_id"] ?? '') ?>">
            <div class="form-columns">
                <div>
                    <label>Booking ID:</label>
                    <input name="booking_id" type="number" value="<?= htmlspecialchars($edit["booking_id"] ?? '') ?>"
                        required>


                    <label>User ID:</label>
                    <input name="userid" type="number" value="<?= htmlspecialchars($edit["userid"] ?? '') ?>" required>

                    <label>Name:</label>
                    <input name="name" type="text" value="<?= htmlspecialchars($edit["name"] ?? '') ?>" required>

                    <label>Email:</label>
                    <input name="email" type="email" value="<?= htmlspecialchars($edit["email"] ?? '') ?>" required>

                    <label>City ID:</label>
                    <input name="cityid" type="number" value="<?= htmlspecialchars($edit["cityid"] ?? '') ?>" required>

                    <label>City Name:</label>
                    <input name="city_name" type="text" value="<?= htmlspecialchars($edit["city_name"] ?? '') ?>"
                        required>

                    <label>Hotel ID:</label>
                    <input name="hotelid" type="number" value="<?= htmlspecialchars($edit["hotelid"] ?? '') ?>"
                        required>

                    <label>Hotel Name:</label>
                    <input name="hotel_name" type="text" value="<?= htmlspecialchars($edit["hotel_name"] ?? '') ?>"
                        required>
                </div>
                <div>
                    <label>Number of Rooms:</label>
                    <input name="number_of_rooms" type="number" min="1"
                        value="<?= htmlspecialchars($edit["number_of_rooms"] ?? '1') ?>" required>

                    <label>Check-in Date:</label>
                    <input name="check_in_date" type="date"
                        value="<?= htmlspecialchars($edit["check_in_date"] ?? '') ?>" required>

                    <label>Check-out Date:</label>
                    <input name="check_out_date" type="date"
                        value="<?= htmlspecialchars($edit["check_out_date"] ?? '') ?>" required>

                    <label>Room Type:</label>
                    <input name="room_type" type="text" value="<?= htmlspecialchars($edit["room_type"] ?? '') ?>"
                        required>

                    <label>Number of Tourists:</label>
                    <input name="tourists" type="number" min="1"
                        value="<?= htmlspecialchars($edit["tourists"] ?? '1') ?>" required>

                    <label>Contact Number:</label>
                    <input name="contact" type="text" value="<?= htmlspecialchars($edit["contact"] ?? '') ?>" required>

                    <label>Cost per Day:</label>
                    <input name="cost_per_day" type="number" min="0" step="0.01"
                        value="<?= htmlspecialchars($edit["cost_per_day"] ?? '') ?>" required>

                    <label>Total Amount:</label>
                    <input name="total_amount" type="number" min="0" step="0.01"
                        value="<?= htmlspecialchars($edit["total_amount"] ?? '') ?>" required>
                </div>
            </div>
            <input type="submit" value="<?= $edit ? "Update Booking" : "Add Booking" ?>">
        </form>
    </div>

    <button class="back-btn" onclick="window.location.href='admindashboard.php'">Back to Dashboard</button>

</body>

</html>