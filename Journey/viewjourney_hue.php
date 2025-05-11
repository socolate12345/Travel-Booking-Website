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
    <h1>HUE TRAVEL</h1>
    <p>
        Hue, the ancient imperial capital of Vietnam, is a peaceful city rich in history, culture, and architectural beauty. Nestled along the banks of the Perfume River, Hue enchants visitors with its centuries-old citadels, royal tombs, and serene pagodas, all echoing the grandeur of the Nguyen Dynasty.
    </p>
    <p>
        Register for a <strong>Hue</strong> tour with Vietravel and immerse yourself in the city's heritage with visits to the Imperial City, Thien Mu Pagoda, and traditional garden houses. To learn more about Hue’s royal legacy and tranquil charm, please refer to <a href="/Travel tips/traveltip_hue.php">Hue Travel Tips</a>.
    </p>

    <div class="tour-container">
        <div class="tour-card">
            <div class="tour-image">
                <img src="../images/hue_1.jpg" alt="Central Vietnam Tour">
                <span class="discount-badge">-12%</span>
            </div>
            <div class="tour-details">
                <h3>Da Nang - Phong Nha Cave - La Vang - Hue - Ba Na Hills - Hoi An</h3>
                <ul>
                    <li><span class="icon">📅</span> 21/05, 23/05, 26/05</li>
                    <li><span class="icon">📍</span> Ho Chi Minh City</li>
                    <li><span class="icon">⏰</span> 5D4N</li>
                    <li><span class="icon">🚌</span> Bus</li>
                </ul>
                <p class="price">6,990,000 ₫ <span class="original-price">7,943,182 ₫</span></p>
              <a href="/Tour_detail/hue_1.php" class="btn">See More</a>
            </div>
        </div>

        <div class="tour-card">
            <div class="tour-image">
                <img src="../images/hue_2.jpg" alt="North-Central Vietnam Grand Tour">
                <span class="discount-badge">-10%</span>
            </div>
            <div class="tour-details">
                <h3>North-Central Tour: Hanoi - Sapa - Fansipan - Ha Long - Ninh Binh - Da Nang - Son Tra - Ba Na Hills - Golden Bridge - Hoi An - La Vang - Hue - Phong Nha</h3>
                <ul>
                    <li><span class="icon">📅</span> 17/05, 24/05, 31/05</li>
                    <li><span class="icon">📍</span> Ho Chi Minh City</li>
                    <li><span class="icon">⏰</span> 10D9N</li>
                    <li><span class="icon">🚌</span> Bus</li>
                </ul>
                <p class="price">23,590,000 ₫ <span class="original-price">26,211,111 ₫</span></p>
                <a href="/Tour_detail/hue_2.php" class="btn">See More</a>
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