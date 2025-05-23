<?php
session_start();
require_once './dbconnect.php';

// Check if user is logged in
if (!isset($_SESSION['usersid'])) {
    header("Location: Login/login.php");
    exit();
}



function showBookingForm() {
    global $userid, $user_name, $user_email; // Make variables available inside the function

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Validate input parameters
    $cityid = isset($_GET['cityid']) ? (int)$_GET['cityid'] : 0;
    $tourid = isset($_GET['tourid']) ? (int)$_GET['tourid'] : 0;

    if ($cityid <= 0 || $tourid <= 0) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Invalid city or tour ID'], JSON_PRETTY_PRINT);
        http_response_code(400);
        exit;
    }

    // Database connection
    $conn = Flight::db();
    if (!$conn) {
        die("Database connection failed: " . $conn->error);
    }

    // Fetch tour and city information
    $stmt = $conn->prepare("
        SELECT t.tour_name, t.price_per_person, c.city 
        FROM tours t 
        JOIN cities c ON t.cityid = c.cityid 
        WHERE t.tourid = ? AND c.cityid = ?
    ");
    if ($stmt === false) {
        die("Error preparing tour query: " . $conn->error);
    }
    $stmt->bind_param("ii", $tourid, $cityid);
    if (!$stmt->execute()) {
        die("Error executing tour query: " . $stmt->error);
    }
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();

    if (!$data) {
        echo "<h2>Tour not found or city mismatch.</h2>";
        exit;
    }

    $userid = (int)$_SESSION['usersid'];

// Fetch username and email from session
$user_name = $_SESSION['usersuid'] ?? '';
$user_email = $_SESSION['usersEmail'] ?? '';

if (empty($user_name) || empty($user_email)) {
    // fallback từ CSDL nếu có usersid
    $userid = $_SESSION['usersid'];
    $stmt = $conn->prepare("SELECT usersuid, usersEmail FROM login WHERE usersid = ?");
    $stmt->bind_param("i", $userid);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $user_name = $row['usersuid'];
        $user_email = $row['usersEmail'];
        // cập nhật lại session nếu muốn
        $_SESSION['usersuid'] = $user_name;
        $_SESSION['usersEmail'] = $user_email;
    } else {
        die("User data could not be retrieved from database.");
    }
}


    $tour_name = $data['tour_name'];
    $price_per_person = (float)$data['price_per_person'];
    $city_name = $data['city'];

    // Tour image path
    $tour_image = $tourid > 0 ? "../tourphotoID/{$tourid}.jpg" : '';

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Reserve: <?php echo htmlspecialchars($tour_name); ?></title>
    <link rel="stylesheet" href="../css/booktour.css">
    <link rel="icon" type="image/png" href="../images/favicon.png">
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-text">
                <h2>Tour: <?php echo htmlspecialchars($tour_name); ?></h2>
            </div>
            <?php if ($tour_image): ?>
                <img src="<?php echo htmlspecialchars($tour_image); ?>" alt="Tour Image" class="tour-image">
            <?php endif; ?>
        </div>
        <form action="/tour/booking/submit" method="POST">
            <input type="hidden" name="cityid" value="<?php echo htmlspecialchars($cityid); ?>">
            <input type="hidden" name="city_name" value="<?php echo htmlspecialchars($city_name); ?>">
            <input type="hidden" name="tourid" value="<?php echo htmlspecialchars($tourid); ?>">
            <input type="hidden" name="tour_name" value="<?php echo htmlspecialchars($tour_name); ?>">
            <input type="hidden" name="price_per_person" value="<?php echo htmlspecialchars($price_per_person); ?>">
            <input type="hidden" name="name" value="<?php echo htmlspecialchars($user_name); ?>">
            <input type="hidden" name="email" value="<?php echo htmlspecialchars($user_email); ?>">

            <div class="form-container">
                <div class="form-left">
                    <div class="form-group">
                        <label for="name">Full Name:</label>
                        <input type="text" id="name" value="<?php echo htmlspecialchars($user_name); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" value="<?php echo htmlspecialchars($user_email); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="tourists">Guests:</label>
                        <input type="number" id="tourists" name="tourists" value="1" min="1" required>
                    </div>
                </div>
                <div class="form-right">
                    <div class="form-group">
                        <label for="tour_date">Departure Date:</label>
                        <input type="date" id="tour_date" name="tour_date" value="<?php echo date('Y-m-d'); ?>" 
                               min="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="contact">Contact:</label>
                        <input type="text" id="contact" name="contact" required>
                    </div>
                </div>
            </div>
            <div class="button-container">
                <span id="total-amount">Total: <?php echo number_format($price_per_person, 0, ',', '.'); ?>đ</span>
                <button type="submit">Reserve</button>
            </div>
        </form>
    </div>
    <script>
        function calculateTotal() {
            const tourists = parseInt(document.getElementById('tourists').value) || 1;
            const pricePerPerson = <?php echo $price_per_person; ?>;
            const total = tourists * pricePerPerson;
            document.getElementById('total-amount').textContent = 
                `Total: ${total.toLocaleString('vi-VN')}đ`;
        }

        document.getElementById('tourists').addEventListener('change', calculateTotal);
        document.getElementById('tourists').addEventListener('input', calculateTotal);
        calculateTotal();
    </script>
</body>
</html>
<?php
}

showBookingForm();
?>