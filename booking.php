<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "travelscapes";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Kiểm tra login
if (!isset($_SESSION["usersid"])) {
    header("Location: Login/login.php");
    exit();
}

// Lấy thông tin người dùng
$userid = $_SESSION["usersid"];
$userEmail = "";
$userName = "";

$sql = "SELECT usersEmail, usersUid FROM login WHERE usersId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userid);
$stmt->execute();
$stmt->bind_result($email, $username);
if ($stmt->fetch()) {
    $userEmail = $email;
    $userName = $username;
}
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['name'] = $_POST['name'] ?? '';
    $_SESSION['email'] = $_POST['email'] ?? '';
    $_SESSION['tourists'] = (int)($_POST['tourists'] ?? 1);
    $_SESSION['dob'] = $_POST['dob'] ?? '';
    $_SESSION['contact'] = $_POST['contact'] ?? '';

    if (isset($_POST['hotel']) && is_numeric($_POST['hotel'])) {
        $hotelId = (int)$_POST['hotel'];
        $hotelQuery = "SELECT hotel, cost FROM hotels WHERE hotelid = $hotelId";
        $hotelResult = $conn->query($hotelQuery);
        
        if ($hotelResult && $hotelResult->num_rows > 0) {
            $hotelData = $hotelResult->fetch_assoc();
            $_SESSION['hotelName'] = $hotelData['hotel'];
            $costPerDay = (int)$hotelData['cost'];
            $_SESSION['amount'] = $costPerDay * $_SESSION['tourists'];
        } else {
            $_SESSION['hotelName'] = 'Unknown Hotel';
            $_SESSION['amount'] = 0;
        }
    } else {
        $_SESSION['hotelName'] = 'Unknown Hotel';
        $_SESSION['amount'] = 0;
    }

    if (isset($_POST['city']) && is_numeric($_POST['city'])) {
        $cityId = (int)$_POST['city'];
        $cityQuery = "SELECT city FROM cities WHERE cityid = $cityId";
        $cityResult = $conn->query($cityQuery);
        if ($cityResult && $cityResult->num_rows > 0) {
            $_SESSION['cityName'] = $cityResult->fetch_assoc()['city'];
        } else {
            $_SESSION['cityName'] = 'Unknown City';
        }
    }

    $conn->close();
    header("Location: Payment Interface/payment.php");
    exit;
}

// Fetch cities and hotels
$cities = [];
$citySql = "SELECT * FROM cities";
$cityResult = $conn->query($citySql);
if ($cityResult->num_rows > 0) {
    while ($row = $cityResult->fetch_assoc()) {
        $cities[] = $row;
    }
}

$hotels = [];
$hotelSql = "SELECT * FROM hotels";
$hotelResult = $conn->query($hotelSql);
if ($hotelResult->num_rows > 0) {
    while ($row = $hotelResult->fetch_assoc()) {
        $hotels[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="css/booking.css">
    <title>Booking Page</title>
</head>
<body>
<div class="card-container">
    <div class="booking-details">
        <h2>Booking Details</h2>
        <p>Select a city and hotel to proceed.</p>
    </div>

    <form method="post" action="">
        <h2>Booking Form</h2>

        <label>City:</label>
        <select name="city" id="citySelect" required>
            <option value="">Select City</option>
            <?php foreach ($cities as $city): ?>
                <option value="<?= $city['cityid'] ?>"><?= htmlspecialchars($city['city']) ?></option>
            <?php endforeach; ?>
        </select><br>

        <label>Hotel:</label>
        <select name="hotel" id="hotelSelect" required>
            <option value="">Select Hotel</option>
            <?php foreach ($hotels as $hotel): ?>
                <option value="<?= $hotel['hotelid'] ?>" data-city="<?= $hotel['cityid'] ?>" data-cost="<?= $hotel['cost'] ?>">
                    <?= htmlspecialchars($hotel['hotel']) ?> (<?= $hotel['cost'] ?> VND/day)
                </option>
            <?php endforeach; ?>
        </select><br>

        <input type="text" name="name" placeholder="Name" value="<?= htmlspecialchars($userName) ?>" readonly required><br>
        <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($userEmail) ?>" readonly required><br>
        <input type="number" name="tourists" id="touristsInput" placeholder="Number of Tourists" required min="1"><br>
        <input type="number" name="calculatedCost" id="calculatedCost" readonly><br>
        <label>Tour Date:</label>
        <input type="date" name="dob" required><br>
        <label>Contact Number:</label>
        <input type="text" name="contact" placeholder="Contact Number" required><br>

        <button type="submit">Proceed to Payment</button>
    </form>
</div>

<script>
    const citySelect = document.getElementById('citySelect');
    const hotelSelect = document.getElementById('hotelSelect');
    const touristsInput = document.getElementById('touristsInput');
    const calculatedCost = document.getElementById('calculatedCost');

    function filterHotels() {
        const selectedCity = citySelect.value;
        for (let i = 0; i < hotelSelect.options.length; i++) {
            const option = hotelSelect.options[i];
            if (option.value === "") {
                option.hidden = false;
                continue;
            }
            const cityId = option.getAttribute('data-city');
            option.hidden = (cityId !== selectedCity);
        }
        hotelSelect.value = "";
        updateCost();
    }

    function updateCost() {
        const selectedOption = hotelSelect.options[hotelSelect.selectedIndex];
        const costPerDay = parseInt(selectedOption?.getAttribute('data-cost')) || 0;
        const tourists = parseInt(touristsInput.value) || 1;
        calculatedCost.value = costPerDay * tourists;
    }

    citySelect.addEventListener('change', filterHotels);
    hotelSelect.addEventListener('change', updateCost);
    touristsInput.addEventListener('input', updateCost);

    filterHotels();
    updateCost();
</script>
</body>
</html>
