<?php
session_start();
require_once 'dbh-inc.php';

if (!isset($_SESSION["usersid"])) {
    header("Location: login.php");
    exit();
}

$userid = $_SESSION["usersid"];

// Lấy thông tin người dùng
$sql = "SELECT usersId, usersEmail, usersUid FROM login WHERE usersId = ?";
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "Lỗi truy vấn cơ sở dữ liệu.";
    exit();
}

mysqli_stmt_bind_param($stmt, "i", $userid);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Lấy danh sách thành phố yêu thích
$favSql = "
    SELECT cities.city 
    FROM favorites 
    JOIN cities ON favorites.cityid = cities.cityid 
    WHERE favorites.usersid = ?
";
$favStmt = mysqli_stmt_init($conn);

$favoriteCities = [];

if (mysqli_stmt_prepare($favStmt, $favSql)) {
    mysqli_stmt_bind_param($favStmt, "i", $userid);
    mysqli_stmt_execute($favStmt);
    $favResult = mysqli_stmt_get_result($favStmt);

    while ($favRow = mysqli_fetch_assoc($favResult)) {
        $favoriteCities[] = $favRow['city'];
    }
} else {
    $favoriteCities = null;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thông tin người dùng</title>
    <style>
/* Reset and base styles */
body, html {
    margin: 0;
    padding: 0;
    font-family: 'Segoe UI', sans-serif;
    background-color: #f0f4f8;
    height: 100%;
}

/* Main wrapper for the whole layout */
.main-wrapper {
    display: flex;
    max-width: 1200px;
    margin: 40px auto;
    min-height: 80vh;
    border: 1px solid #ccc;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    border-radius: 10px;
    overflow: hidden;
    background-color: white;
}

/* Navigation Sidebar */
.nav-tab {
    width: 300px;
    background-color: #2f6ecf;
    color: white;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 40px 20px;
    text-align: center;
}

.nav-tab h2 {
    font-size: 20px;
    line-height: 1.6;
    margin-bottom: 20px;
}

.nav-buttons {
    display: flex;
    flex-direction: row; /* Change to row to align buttons horizontally */
    gap: 10px;
    justify-content: center; /* Center the buttons horizontally */
}

.nav-buttons button {
    padding: 10px;
    background-color: white;
    color: #2f6ecf;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-weight: bold;
    transition: background-color 0.3s;
    width: 100px; /* Set a fixed width to ensure buttons are the same size */
    text-align: center; /* Ensure text is centered within the button */
}

.nav-buttons button:hover {
    background-color: #d6eaf8;
}

/* Main content section (right side) */
.main-content {
    flex: 1;
    padding: 40px;
    display: flex;
    flex-direction: column;
    gap: 40px;
    background-color: #fdfdfd;
}

/* User Info & Favorite Cities Box */
.info-box {
    border: 2px solid #2f6ecf;
    border-radius: 10px;
    padding: 20px;
    background-color: #fff;
}

.info-box h3 {
    margin-top: 0;
    color: #2f6ecf;
    font-size: 24px;
    margin-bottom: 16px;
}

.info-box p,
.info-box li {
    font-size: 16px;
    line-height: 1.6;
    margin: 10px 0;
}

.info-box ul {
    padding-left: 20px;
    margin: 0;
}

.city-gallery {
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    justify-content: flex-start;
    padding-top: 10px;
}

.city-item {
    width: 120px;              /* Chiều rộng mỗi thành phố */
    text-align: center;
    flex-direction: column;
    display: flex;
    align-items: center;
    justify-content: space-between; /* Ensure consistent spacing between elements */
    gap: 6px; /* Add consistent gap between image, text, and buttons */
}

.city-item img {
    width: 100%;               /* 100% chiều rộng city-item */
    height: 80px;              /* Chiều cao vừa phải */
    object-fit: cover;         /* Đảm bảo hình ảnh không bị méo */
    border-radius: 10px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    transition: transform 0.3s;
}

.city-item img:hover {
    transform: scale(1.05);
}

.city-item p {
    margin: 0;                 /* Remove default margin for consistent spacing */
    font-size: 13px;
    font-weight: bold;
    color: #333;
    text-align: center;
    word-break: break-word;
}

.btn-book,
.btn-remove {
    display: inline-block;
    margin: 0;                 /* Remove margin to align consistently */
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: bold;
    text-align: center;
    text-decoration: none;
    cursor: pointer;
    width: 100%;               /* Ensure buttons take full width of city-item */
    box-sizing: border-box;    /* Include padding in width calculation */
}

.btn-book {
    background-color: #27ae60;
    color: white;
    border: none;
}

.btn-book:hover {
    background-color: #219150;
}

.btn-remove {
    background-color: #e74c3c;
    color: white;
    border: none;
}

.btn-remove:hover {
    background-color: #c0392b;
}



@keyframes wave {
    0% { margin-left: 0; }
    100% { margin-left: -1600px; }
}

@keyframes swell {
    0%, 100% { transform: translate3d(0,-25px,0); }
    50% { transform: translate3d(0,5px,0); }
}

    </style>
</head>

<div class="main-wrapper">
    <!-- Navigation Tab -->
    <div class="nav-tab">
        <h2>Navigation tab<br>(Functions Related)</h2>
        <div class="nav-buttons">
            <form action="loggedinhome.php" method="get">
                <button type="submit">Home</button>
            </form>
            <form action="login.php" method="post">
                <button type="submit">Logout</button>
            </form>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <!-- User Info -->
        <div class="info-box">
            <h3>User Information</h3>
            <?php
            if ($row = mysqli_fetch_assoc($result)) {
                echo "<p><strong>Name:</strong> " . htmlspecialchars($row["usersUid"]) . "</p>";
                echo "<p><strong>Email:</strong> " . htmlspecialchars($row["usersEmail"]) . "</p>";
                echo "<p><strong>Phone:</strong> Not updated</p>";
            } else {
                echo "<p>User information not found.</p>";
            }
            ?>
        </div>

        <!-- Favorite Cities -->
        <div class="info-box">
            <?php
            if ($favoriteCities !== null && count($favoriteCities) > 0) {
                echo "<div class='info-box'>";
                echo "<h3>Favorite Cities</h3>";
                echo "<div class='city-gallery'>";
            
                $favSql = "
                    SELECT cities.cityid, cities.city 
                    FROM favorites 
                    JOIN cities ON favorites.cityid = cities.cityid 
                    WHERE favorites.usersid = ?
                ";
            
                $favStmt = mysqli_stmt_init($conn);
                if (mysqli_stmt_prepare($favStmt, $favSql)) {
                    mysqli_stmt_bind_param($favStmt, "i", $userid);
                    mysqli_stmt_execute($favStmt);
                    $favResult = mysqli_stmt_get_result($favStmt);
            
                    while ($favRow = mysqli_fetch_assoc($favResult)) {
                        $cityName = htmlspecialchars($favRow['city']);
                        $cityId = intval($favRow['cityid']);
                        $imagePath = "/Places/{$cityId}.jpg";
            
                        echo "<div class='city-item'>";
                        echo "<img src='$imagePath' alt='$cityName' />";
                        echo "<p>$cityName</p>";
            
                        // Nút đặt vé
                        echo "<a href='/viewjourney.php?cityid=$cityId' class='btn-book'>Đặt vé</a>";
            
                        // Nút xóa yêu thích
                        echo "
                            <form action='remove_favorite.php' method='post' style='margin-top: 5px;'>
                                <input type='hidden' name='cityid' value='$cityId'>
                                <button type='submit' class='btn-remove'>Xóa</button>
                            </form>
                        ";
            
                        echo "</div>";
                    }
                }
            
                echo "</div></div>";
            } else {
                echo "<div class='info-box'><p>You haven't favorited any cities.</p></div>";
            }
            
            ?>
        </div>
    </div>
</div>


</div>


</body>
</html>
<?php
mysqli_stmt_close($stmt);
mysqli_stmt_close($favStmt);
mysqli_close($conn);
?>
