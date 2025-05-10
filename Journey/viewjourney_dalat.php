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
    <h1>DA LAT TRAVEL</h1>
    <p>
    Da Lat, the city of flowers and eternal spring, captivates travelers with its cool climate, poetic pine forests, and colorful flower gardens. From the peaceful Tuyen Lam Lake to the vibrant night market, Da Lat offers a perfect getaway for nature lovers and romantics alike.
    </p>
    <p>
    Register for a <strong>Da Lat</strong> tour with VietTransit and explore must-see attractions like Langbiang Mountain, Valley of Love, and more. For travel insights and tips, check out <a href="/Travel tips/traveltip_dalat.php">Da Lat Travel Guide</a>.
    </p>

    <div class="tour-container">
        <div class="tour-card">
            <div class="tour-image">
                <img src="../images/dalat_1.jpg" alt="Da Lat Flower City Tour">
                <span class="discount-badge">-20%</span>
            </div>
            <div class="tour-details">
                <h3>Da Lat - Valley of Love - Langbiang - Night Market</h3>
                <ul>
                    <li><span class="icon">⏰</span> 3 days 2 nights</li>
                    <li><span class="icon">📅</span> Friday / Saturday</li>
                    <li><span class="icon">🚌</span> Bus</li>
                    <li><span class="icon">🏨</span> Hotel</li>
                    <li><span class="icon">👥</span> 25</li>
                </ul>
                <p class="price">2,800,000 ₫ <span class="original-price">3,500,000 ₫</span></p>
                <button>See More</button>
            </div>
        </div>

        <div class="tour-card">
            <div class="tour-image">
                <img src="../images/dalat_2.jpg" alt="Da Lat Adventure Tour">
                <span class="discount-badge">-15%</span>
            </div>
            <div class="tour-details">
                <h3>Da Lat - Datanla Waterfall - Coffee Farm - Clay Tunnel</h3>
                <ul>
                    <li><span class="icon">⏰</span> 2 days 1 night</li>
                    <li><span class="icon">📅</span> Saturday / Sunday</li>
                    <li><span class="icon">🚌</span> Bus</li>
                    <li><span class="icon">🏨</span> Hotel</li>
                    <li><span class="icon">👥</span> 30</li>
                </ul>
                <p class="price">2,040,000 ₫ <span class="original-price">2,400,000 ₫</span></p>
                <button>See More</button>
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