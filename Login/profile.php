<?php
session_start();
require_once '../dbconnect.php';

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
    SELECT cities.cityid, cities.city 
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
        $favoriteCities[] = $favRow;
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
        body,
        html {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f4f8;
            height: 100%;
        }

        /* Main wrapper for the whole layout */
        .main-wrapper {
            width: 100%;
            min-height: 100vh;
            background-color: white;
        }

        /* Header */
        .header {
            background-color: #003580;
            color: white;
            padding: 25px 15px 15px;
            text-align: center;
        }

        .header h1 {
            max-width: 1125px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 30px;
            text-align: left;
            font-size: 48px;
            font-weight: bold;
        }

        /* Main content section */
        .main-content {
            padding: 40px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            background-color: #fdfdfd;
            width: 100%;
            box-sizing: border-box;
        }

        /* Navigation buttons */
        .nav-buttons {
            display: flex;
            flex-direction: row;
            gap: 10px;
            justify-content: flex-end;
            padding: 0 40px;
        }

        .nav-buttons button {
            padding: 10px;
            background-color: #2f6ecf;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
            width: 100px;
            text-align: center;
        }

        .nav-buttons button:hover {
            background-color: #1e4a9f;
        }

        /* Tab navigation */
        .tab-nav {
            display: flex;
            padding: 0 40px;
            width: 100%;
            box-sizing: border-box;
            background-color: #fdfdfd;
        }

        .tab-nav button {
            padding: 12px 20px;
            border: none;
            background-color: #f0f4f8;
            color: #2f6ecf;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
            border-radius: 5px 5px 5px 5px;
            margin-right: 5px;
        }

        .tab-nav button.active {
            background-color: #2f6ecf;
            color: white;
        }

        .tab-nav button:hover {
            background-color: #d6eaf8;
        }

        /* Tab content */
        .tab-content {
            display: none;
            padding: 0 40px;
        }

        .tab-content.active {
            display: block;
        }

        /* Info Box */
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

        /* City Gallery */
        .city-gallery {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            justify-content: flex-start;
            padding-top: 10px;
        }

        .city-item {
            width: 120px;
            text-align: center;
            flex-direction: column;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 6px;
        }

        .city-item img {
            width: 100%;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s;
        }

        .city-item img:hover {
            transform: scale(1.05);
        }

        .city-item p {
            margin: 0;
            font-size: 13px;
            font-weight: bold;
            color: #333;
            text-align: center;
            word-break: break-word;
        }

        .btn-book,
        .btn-remove {
            display: inline-block;
            margin: 0;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            width: 100%;
            box-sizing: border-box;
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
    </style>
</head>

<body>
    <div class="main-wrapper">
        <!-- Header -->
        <div class="header">
            <h1>User Profile</h1>
        </div>


        <!-- Main Content Area -->
        <div class="main-content">
            <!-- Navigation Buttons -->
            <div class="nav-buttons">
                <form action="loggedinhome.php" method="get">
                    <button type="submit">Home</button>
                </form>
                <form action="login.php" method="post">
                    <button type="submit">Logout</button>
                </form>
            </div>

            <!-- User Info -->
            <div class="info-box">
                <h3>User Information</h3>
                <?php
                if ($row = mysqli_fetch_assoc($result)) {
                    echo "<p><strong>Name:</strong> " . htmlspecialchars($row["usersUid"]) . "</p>";
                    echo "<p><strong>Email:</strong> " . htmlspecialchars($row["usersEmail"]) . "</p>";
                } else {
                    echo "<p>User information not found.</p>";
                }
                ?>
            </div>

            <!-- Tab Navigation -->
            <div class="tab-nav">
                <button class="tab-button active" onclick="openTab('favorite-cities')">Favorite Cities</button>
                <button class="tab-button" onclick="openTab('manage-tour')">Manage Tour</button>
                <button class="tab-button" onclick="openTab('manage-hotel')">Manage Hotel</button>
            </div>

            <!-- Tab Content -->
            <div id="favorite-cities" class="tab-content active">
                <div class="info-box">
                    <?php
                    if ($favoriteCities !== null && count($favoriteCities) > 0) {
                        echo "<h3>Favorite Cities</h3>";
                        echo "<div class='city-gallery'>";

                        $citySlugMap = [
                            10 => 'tay_bac',
                            11 => 'ho_chi_minh',
                            12 => 'nha_trang',
                            13 => 'hue',
                            14 => 'phu_yen',
                            15 => 'da_lat',
                            16 => 'phu_quoc',
                            17 => 'hoi_an',
                            18 => 'ha_giang',
                        ];

                        foreach ($favoriteCities as $favRow) {
                            $cityName = htmlspecialchars($favRow['city']);
                            $cityId = intval($favRow['cityid']);
                            $imagePath = "/Places/{$cityId}.jpg";
                            $citySlug = isset($citySlugMap[$cityId]) ? $citySlugMap[$cityId] : 'default';
                            $tourPage = "../Journey/viewjourney_$citySlug.php";

                            echo "<div class='city-item'>";
                            echo "<img src='$imagePath' alt='$cityName' />";
                            echo "<p>$cityName</p>";
                            echo "<a href='/view_hotels.php?city_id=$cityId' class='btn-book'>Book Hotel</a>";
                            echo "<a href='/$tourPage' class='btn-book'>Book Tour</a>";
                            echo "<form action='remove_favorite.php' method='post' style='margin-top: 5px;'>";
                            echo "<input type='hidden' name='cityid' value='$cityId'>";
                            echo "<button type='submit' class='btn-remove'>Xóa</button>";
                            echo "</form>";
                            echo "</div>";
                        }

                        echo "</div>";
                    } else {
                        echo "<p>You haven't favorited any cities.</p>";
                    }
                    ?>
                </div>
            </div>

            <div id="manage-tour" class="tab-content">
                <div class="info-box">
                    <h3>Manage Tours</h3>
                    <p>Here you can view and manage your booked tours.</p>
                    <form action="../Payment Interface/tourlist.php" method="get">
                        <button type="submit" class="btn-book">View Booked Tours</button>
                    </form>
                </div>
            </div>

            <div id="manage-hotel" class="tab-content">
                <div class="info-box">
                    <h3>Manage Hotels</h3>
                    <p>Here you can view and manage your hotel bookings.</p>
                    <form action="../Payment Interface/receiptlist.php" method="get">
                        <button type="submit" class="btn-book">View Booked Hotels</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openTab(tabName) {
            // Hide all tab contents
            var tabContents = document.getElementsByClassName('tab-content');
            for (var i = 0; i < tabContents.length; i++) {
                tabContents[i].classList.remove('active');
            }

            // Remove active class from all tab buttons
            var tabButtons = document.getElementsByClassName('tab-button');
            for (var i = 0; i < tabButtons.length; i++) {
                tabButtons[i].classList.remove('active');
            }

            // Show selected tab content and add active class to clicked button
            document.getElementById(tabName).classList.add('active');
            event.currentTarget.classList.add('active');
        }
    </script>

    <?php
    mysqli_stmt_close($stmt);
    mysqli_stmt_close($favStmt);
    mysqli_close($conn);
    ?>
</body>

</html>