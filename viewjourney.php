<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password =  "admin";
$dbname = "travelscapes";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$cityId = isset($_GET['cityid']) ? (int)$_GET['cityid'] : 0;

if ($cityId <= 0) {
    echo "Invalid city ID.";
    exit();
}

// Fetch city details from the database
$sql = "SELECT * FROM cities WHERE cityid = $cityId";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $city = $row['city'];
    $region = $row['region'];
    $season = $row['season'];
    $days = $row['days'];
    $cost = $row['cost'];
} else {
    echo "City not found.";
    exit();
}

// Xác định đường dẫn ảnh dựa vào cityId
$folderPath = './Places/';
$allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');

// Kiểm tra ảnh theo định dạng cityid.ext
$imagePath = "";
foreach ($allowedExtensions as $ext) {
    $possiblePath = $folderPath . $cityId . '.' . $ext;
    if (file_exists($possiblePath)) {
        $imagePath = $possiblePath;
        break;
    }
}

// Nếu không tìm thấy ảnh phù hợp, dùng ảnh mặc định
if (empty($imagePath)) {
    $imagePath = './Places/default.jpg'; // Bạn cần có ảnh default.jpg nếu ảnh cityid không tồn tại
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="./css/viewjourney.css">
    <title><?php echo $city; ?> Details</title>
</head>
<body> 
    <div class="navbar">
        <span class="logo">Travelscapes</span>
    </div>

    <div class="content-container">
        <h1>>> <?php echo $city; ?> << </h1>

        <div class="city-card">
            <div class="city-images">
                <img src="<?php echo $imagePath; ?>" alt="City Image" style="width:400px;">
            </div>

            <div class="city-details">
                <p><strong>City:</strong> <?php echo $city; ?></p>
                <p><strong>Region:</strong> <?php echo $region; ?></p>
                <p><strong>Season:</strong> <?php echo $season; ?></p>
                <p><strong>Days:</strong> <?php echo $days; ?></p>
                <p><strong>Cost:</strong> <?php echo number_format($cost, 0, ',', '.'); ?> ₫</p>
                </div>

            <div class="view-hotels-button">
                <a href="view_hotels.php?city_id=<?php echo $cityId; ?>" class="view-button">View Hotels</a>
            </div>
        </div>
    </div>

    <?php $conn->close(); ?>

    <footer>
        <p>&copy; 2025 Travelscapes. All rights reserved.</p>
    </footer>
</body>
</html>
