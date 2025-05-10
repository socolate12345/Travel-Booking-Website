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
    <h1>HO CHI MINH TRAVEL</h1>
    <p>
        Ho Chi Minh City, the vibrant southern metropolis of Vietnam, is a harmonious blend of dynamic modern life and historical charm. The city pulses with energy from bustling markets, lively streets, and a thriving food culture, while preserving its rich heritage in landmarks like the Reunification Palace and Notre-Dame Cathedral.
    </p>
    <p>
        Register for a <strong>Ho Chi Minh</strong> tour with Vietravel and explore famous destinations such as Ben Thanh Market, Cu Chi Tunnels, and vibrant culinary alleys. To learn more about the city's culture and attractions, please refer to <a href="/Travel tips/traveltip_hcm.php">Ho Chi Minh Travel Tips</a>.
    </p>

    <div class="tour-container">
        <div class="tour-card">
            <div class="tour-image">
                <img src="../images/hcm_1.jpg" alt="Ho Chi Minh Tour">
                <span class="discount-badge">-15%</span>
            </div>
            <div class="tour-details">
                <h3>City Tour - 4-Hour Double-Decker Bus Saigon - Cholon & Culinary Experience</h3>
                <ul>
                    <li><span class="icon">📅</span> 17/05, 24/05, 31/05</li>
                    <li><span class="icon">📍</span> TP. Hồ Chí Minh</li>
                    <li><span class="icon">⏰</span> 1 Day</li>
                    <li><span class="icon">🚌</span> Bus</li>
                </ul>
                <p class="price">599,000 ₫ <span class="original-price">705,000 ₫</span></p>
                <button>See More</button>
            </div>
        </div>

        <div class="tour-card">
            <div class="tour-image">
                <img src="../images/hcm_2.jpg" alt="Ho Chi Minh Tour">
                <span class="discount-badge">-15%</span>
            </div>
            <div class="tour-details">
                <h3>City Tour - 4-Hour Double-Decker Bus Saigon - Cholon & Culinary Experience</h3>
                <ul>
                    <li><span class="icon">📅</span> 17/05, 24/05, 31/05</li>
                    <li><span class="icon">📍</span> TP. Hồ Chí Minh</li>
                    <li><span class="icon">⏰</span> 1 Day</li>
                    <li><span class="icon">🚌</span> Bus</li>
                </ul>
                <p class="price">599,000 ₫ <span class="original-price">705,000 ₫</span></p>
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