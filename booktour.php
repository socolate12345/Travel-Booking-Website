<?php
require_once 'dbconnect.php';

session_start();

if (!isset($_SESSION['usersid'])) {
    header("Location: Login/login.php");
    exit();
}

$userid = $_SESSION['usersid'];

// Lấy cityid và tourid từ URL nếu có
$cityid = isset($_GET['cityid']) ? intval($_GET['cityid']) : 0;
$tourid = isset($_GET['tourid']) ? intval($_GET['tourid']) : 0;

// Lấy thông tin người dùng từ database
$user_name = "";
$user_email = "";

$stmt = $conn->prepare("SELECT usersuid, usersEmail FROM login WHERE usersid = ?");
$stmt->bind_param("i", $userid);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
    $user_name = $row['usersuid'];
    $user_email = $row['usersEmail'];
}

// Truy vấn thông tin city và tour
$city_name = "";
$tour_name = "";
$price_per_person = 0;

if ($cityid > 0) {
    $stmt = $conn->prepare("SELECT city FROM cities WHERE cityid = ?");
    $stmt->bind_param("i", $cityid);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $city_name = $row['city'];
    }
}

if ($tourid > 0) {
    $stmt = $conn->prepare("SELECT tour_name, price_per_person FROM tours WHERE tourid = ?");
    $stmt->bind_param("i", $tourid);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        $tour_name = $row['tour_name'];
        $price_per_person = $row['price_per_person'];
    }
}

// Xử lý đặt tour
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['usersid'])) {
        die("⚠️ Vui lòng đăng nhập trước khi đặt tour.");
    }

    $userid = $_SESSION['usersid'];
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

    $stmt = $conn->prepare("INSERT INTO tour_bookings 
        (userid, name, email, cityid, city_name, tourid, tour_name, tourists, tour_date, contact, price_per_person, total_amount) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ississsissii", $userid, $name, $email, $cityid, $city_name, $tourid, $tour_name, $tourists, $tour_date, $contact, $price_per_person, $total_amount);

    if ($stmt->execute()) {
        echo "<div class='container'><p>✅ Đặt tour thành công!</p>";
        echo "<a href='./Login/loggedinhome.php' style='
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;'>🏠 Về trang chủ</a></div>";
    } else {
        echo "<div class='container'>❌ Lỗi khi đặt tour: " . $stmt->error . "</div>";
    }
    $stmt->close();
    $conn->close();
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Tour: <?php echo htmlspecialchars($tour_name); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1200px;
            margin: 0 auto;
            margin-top: 50px;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .header-text {
            flex: 1;
            padding-right: 20px;
        }

        .header-text h2 {
            margin-left: 60px;
            color: #333;
            font-size: 36px;
            font-weight: bold;
            font-family: 'Helvetica Neue Web', Helvetica, Arial, sans-serif;
        }

        .tour-image {
            width: 300px;
            height: 200px;
            border-radius: 8px;
            margin-right: 60px;
            margin-top: 30px;
            margin-bottom: 30px;
        }

        .form-container {
            display: flex;
            justify-content: space-between;
            gap: 40px;
        }

        .form-left,
        .form-right {
            flex: 1;
        }

        .form-group {
            margin-bottom: 20px;
            margin-left: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }

        input[readonly] {
            background-color: #e9ecef;
            cursor: not-allowed;
        }

        input[type="number"] {
            max-width: 100px;
        }

        .form-right .form-group {
            padding-right: 20px;
        }

        .button-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            margin: 20px auto;
        }

        button {
            padding: 12px;
            width: 200px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        #total-amount {
            font-size: 16px;
            color: #333;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                text-align: center;
            }

            .header-text {
                padding-right: 0;
            }

            .tour-image {
                max-width: 100%;
            }

            .form-container {
                flex-direction: column;
            }

            .form-right .form-group {
                padding-right: 0;
            }

            .button-container {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-text">
                <h2>Tour: <?php echo htmlspecialchars($tour_name); ?></h2>
            </div>
            <?php if ($tourid > 0): ?>
                <img src="tourphotoID/<?php echo $tourid; ?>.jpg" alt="Tour Image" class="tour-image">
            <?php endif; ?>
        </div>
        <form method="POST">
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
                <span id="total-amount">Total: <?php echo number_format($price_per_person); ?>đ</span>
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
        calculateTotal();
    </script>
</body>
</html>