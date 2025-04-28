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
        html, body {
            width: 100%;
            height: 100%;
        }

        body {
            background: radial-gradient(ellipse at center, rgba(255,254,234,1) 0%, rgba(255,254,234,1) 35%, #B7E8EB 100%);
            overflow: hidden;
            font-family: 'Montserrat', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding-top: 40px;
        }

        .container {
            background: #3498db;
            border-radius: 30px;
            box-shadow: 30px 14px 28px rgba(0, 0, 5, .2), 0 10px 10px rgba(0, 0, 0, .2);
            width: 500px;
            max-width: 90%;
            padding: 40px;
            text-align: center;
            color: #fff;
            opacity: 0.9;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #fff;
        }

        .info-item {
            background: #fff;
            color: #333;
            padding: 12px 20px;
            margin: 10px 0;
            border-radius: 50px;
            font-weight: bold;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }

        .back-button {
            margin-top: 30px;
        }

        button {
            border-radius: 50px;
            border: 1px solid #fff;
            background: #fff;
            color: #3498db;
            font-size: 14px;
            font-weight: bold;
            padding: 12px 30px;
            text-transform: uppercase;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #d6eaf8;
        }

        .ocean {
            height: 5%;
            width: 100%;
            position: absolute;
            bottom: 0;
            left: 0;
            background: #3498db;
        }

        .wave {
            background: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/85486/wave.svg) repeat-x;
            position: absolute;
            top: -198px;
            width: 6400px;
            height: 198px;
            animation: wave 5s cubic-bezier(0.36, 0.45, 0.63, 0.53) infinite;
            transform: translate3d(0, 0, 0);
        }

        .wave:nth-of-type(2) {
            top: -175px;
            animation: wave 7s cubic-bezier(0.36, 0.45, 0.63, 0.53) -.125s infinite, swell 7s ease -1.25s infinite;
            opacity: 1;
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
<body>

<div class="container">
    <h2>Thông tin người dùng</h2>
    <?php
    if ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='info-item'>ID: " . htmlspecialchars($row["usersId"]) . "</div>";
        echo "<div class='info-item'>Email: " . htmlspecialchars($row["usersEmail"]) . "</div>";
        echo "<div class='info-item'>Username: " . htmlspecialchars($row["usersUid"]) . "</div>";
    } else {
        echo "<div class='info-item'>Không tìm thấy thông tin người dùng.</div>";
    }

    // Hiển thị thành phố yêu thích
    if ($favoriteCities !== null && count($favoriteCities) > 0) {
        echo "<div class='info-item'>Các thành phố yêu thích:</div>";
        foreach ($favoriteCities as $cityName) {
            echo "<div class='info-item'>" . htmlspecialchars($cityName) . "</div>";
        }
    } else {
        echo "<div class='info-item'>Bạn chưa yêu thích thành phố nào.</div>";
    }
    ?>
    <div class="back-button">
        <form action="loggedinhome.php" method="get">
            <button type="submit">Return to Homepage</button>
        </form>
    </div>
</div>

<div class="ocean">
    <div class="wave"></div>
    <div class="wave"></div>
</div>

</body>
</html>
<?php
mysqli_stmt_close($stmt);
mysqli_stmt_close($favStmt);
mysqli_close($conn);
?>
