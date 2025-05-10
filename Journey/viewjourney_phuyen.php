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
    <h1>PHU YEN TRAVEL</h1>
    <p>
        Phu Yen, a hidden gem on Vietnam’s south-central coast, offers pristine beaches, crystal-clear waters, and untouched natural landscapes. Known for its peaceful charm and friendly locals, Phu Yen captivates travelers with its unique rock formations, coastal plains, and stunning sunrises over the sea.
    </p>
    <p>
        Register for a <strong>Phu Yen</strong> tour with Vietravel and discover spectacular spots such as Ganh Da Dia, Bai Xep, and O Loan Lagoon. To learn more about the region’s coastal beauty and cultural attractions, please refer to <a href="/Travel tips/traveltip_phuyen.php">Phu Yen Travel Tips</a>.
    </p>


    <div class="tour-container">
        <div class="tour-card">
            <div class="tour-image">
                <img src="../images/phuyen_1.jpg" alt="Quy Nhon - Ky Co - Eo Gio - Ganh Da Dia Tour">
                <span class="discount-badge">-17%</span>
            </div>
            <div class="tour-details">
                <h3>Quy Nhon - Ky Co - Eo Gio - Ganh Da Dia</h3>
                <ul>
                    <li><span class="icon">📅</span> 13/05, 16/05, 23/05</li>
                    <li><span class="icon">📍</span> Ho Chi Minh City</li>
                    <li><span class="icon">⏰</span> 3D2N</li>
                    <li><span class="icon">🚌</span> Bus</li>
                </ul>
                <p class="price">3,990,000 ₫ <span class="original-price">4,807,229 ₫</span></p>
                <button>See More</button>
            </div>
        </div>

        <div class="tour-card">
            <div class="tour-image">
                <img src="../images/phuyen_2.jpg" alt="Phu Yen - Quy Nhon - Eo Gio Tour">
                <span class="discount-badge">-15%</span>
            </div>
            <div class="tour-details">
                <h3>Phu Yen - Quy Nhon - Eo Gio</h3>
                <ul>
                    <li><span class="icon">📅</span> 20/05, 27/05, 03/06</li>
                    <li><span class="icon">📍</span> Ho Chi Minh City</li>
                    <li><span class="icon">⏰</span> 4D3N</li>
                    <li><span class="icon">🚌</span> Bus</li>
                </ul>
                <p class="price">7,390,000 ₫ <span class="original-price">8,694,118 ₫</span></p>
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