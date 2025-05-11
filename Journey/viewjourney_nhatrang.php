<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tay Bac Travel</title>
    <link rel="stylesheet" href="../css/viewjourney.css">
    <style>
        /* Ensure content is not overlapped by fixed header */
        .main-content {
            margin-top: 100px; /* Adjust based on header height */
            padding: 20px;
        }
    </style>
</head>
<body>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header>
    <input type="checkbox" name="" id="toggler">
    <label for="toggler" class="fas fa-bars"></label>

    <a href="#" class="logo">
        <img src="/images/logo.png" alt="VietTransit Logo">
        <span>VietTransit</span>
    </a>

    <nav class="navbar">
        <a href="/Login/loggedinhome.php">Home</a>
        <?php
            echo "<a href='../Login/profile.php'>Hello, " . $_SESSION['usersuid'] . "!</a>";
            echo '<a href="../home.php">Logout</a>';
        ?>
    </nav>

    <div class="icons">
        <span data-tooltip="Favourites" data-flow="top"> 
            <a href="profile.php" class="fas fa-heart"></a>
        </span>
        <span data-tooltip="Cart" data-flow="top"> 
            <a href="/Payment Interface/receiptlist.php" class="fas fa-shopping-cart"></a>
        </span>
        <span data-tooltip="Profile" data-flow="top">
            <a href="profile.php" class="fas fa-user"></a>
        </span>
    </div>
</header>

<div class="main-content">
    <h1>NHA TRANG TRAVEL</h1>
    <p>
        Nha Trang, a coastal gem of Vietnam, is renowned for its pristine beaches, turquoise waters, and vibrant marine life. This seaside city offers a perfect blend of natural beauty and cultural heritage, with attractions ranging from ancient Cham temples to luxury resorts and amusement parks.
    </p>
    <p>
        Register for a <strong>Nha Trang</strong> tour with Vietravel and discover highlights such as Tháp Bà Ponagar, Nhũ Tiên Beach, VinWonders, and traditional pottery villages. To learn more about Nha Trang's unique charm and travel experiences, please refer to <a href="/Travel tips/traveltip_nhatrang.php">Nha Trang Travel Tips</a>.
    </p>

    <div class="tour-container">
        <div class="tour-card">
            <div class="tour-image">
                <img src="../images/nhatrang_1.jpg" alt="Nha Trang Tour">
                <span class="discount-badge">-20%</span>
            </div>
            <div class="tour-details">
                <h3>Nha Trang - Tháp Bà Ponagar - Nhũ Tiên Beach - VinWonders - Bàu Trúc Pottery Village - Explore the New Expressway - 4-Star Hotel</h3>
                <ul>
                    <li><span class="icon">📅</span> 12/05, 19/05, 26/05</li>
                    <li><span class="icon">📍</span> Ho Chi Minh City</li>
                    <li><span class="icon">⏰</span> 3 Days 2 Nights</li>
                    <li><span class="icon">🚌</span> Bus</li>
                </ul>
                <p class="price">2,390,000 ₫ <span class="original-price">2,987,500 ₫</span></p>
                <a href="/Tour_detail/nhatrang_1.php" class="btn">See More</a>
            </div>
        </div>

        <div class="tour-card">
            <div class="tour-image">
                <img src="../images/nhatrang_2.jpg" alt="Nha Trang Tour">
                <span class="discount-badge">-18%</span>
            </div>
            <div class="tour-details">
                <h3>Nha Trang - Bàu Trúc Pottery Village - Ancient Nha Trang - Tháp Bà Ponagar - Nhũ Tiên Beach - VinWonders - Pottery & Seashell Workshop Experience - 4-Star Hotel</h3>
                <ul>
                    <li><span class="icon">📅</span> 12/05, 09/06, 16/06</li>
                    <li><span class="icon">📍</span> Da Nang</li>
                    <li><span class="icon">⏰</span> 3 Days 2 Nights</li>
                    <li><span class="icon">🚌</span> Bus</li>
                </ul>
                <p class="price">2,690,000 ₫ <span class="original-price">3,280,488 ₫</span></p>
                <a href="/Tour_detail/nhatrang_2.php" class="btn">See More</a>
            </div>
        </div>
    </div>
</div>  

<section class="footer">
    <div class="box-container">
        <div class="box">
            <h3>Quick links</h3>
            <a href="#home">Home</a>
            <a href="#about">About</a>
            <a href="#products">Places</a>
            <a href="#review">Review</a>
        </div>
        <div class="box">
            <h3>Extra links</h3>
            <a href="/Login/profile.php">My account</a>
            <a href="/Payment Interface/receiptlist.php">My List</a>
            <a href="/Login/profile.php">My favorite</a>
        </div>
        <div class="box">
            <h3>Popular Travel Locations</h3>
            <a href="viewjourney_taybac.php">Tay Bac</a>
            <a href="viewjourney_hcm.php">Ho Chi Minh</a>
            <a href="viewjourney_phuquoc.php">Phu Quoc</a>
            <a href="viewjourney_hue.php">Hue</a>
        </div>
        <div class="box">
            <h3>contact info</h3>
            <a href="https://github.com/socolate12345/Travel-Booking-Website">GitHub</a>
            <img src="./images/payment.png" alt="">
        </div>
    </div>
    <div class="credit">©2025 VietTransit</div>
</section>
</body>
</html>