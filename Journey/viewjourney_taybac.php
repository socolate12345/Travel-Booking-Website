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
            echo "<a href='profile.php'>Hello, " . $_SESSION['usersuid'] . "!</a>";
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
    <h1>TAY BAC TRAVEL</h1>
    <p>
    Northwest in spring is adorned with blooming peach and plum blossoms throughout the forests, accompanied by the sounds of birds, flutes, and the warmth of wine, making the Northwest spring vibrant and colorful. In the cheerful atmosphere of spring, the Northwest is bustling with blooming flowers and plants, and vibrant traditional costumes.
    <p>
    Register for a <strong>Northwest</strong> tour with VietTransit, and you can explore the following prominent destinations: <strong>Northwest</strong>... To learn more about the Northwest, please refer to <a href="#">Northwest Travel Tips</a>.
    </p>

    <div class="tour-container">
        <div class="tour-card">
            <div class="tour-image">
                <img src="../images/taybac_1.jpg" alt="Moc Chau Tour">
                <span class="discount-badge">-37%</span>
            </div>
            <div class="tour-details">
                <h3>Moc Chau - Son La - Dien Bien</h3>
                <ul>
                    <li><span class="icon">⏰</span> 2 days</li>
                    <li><span class="icon">📅</span> Everyday</li>
                    <li><span class="icon">🚌</span> Bus</li>
                    <li><span class="icon">🏨</span> Hotel</li>
                    <li><span class="icon">👥</span> 20</li>
                </ul>
                <p class="price">4,590,000 ₫ <span class="original-price">5,590,000 ₫</span></p>
                <button>See More</button>
            </div>
        </div>

        <div class="tour-card">
            <div class="tour-image">
                <img src="../images/taybac_2.jpg" alt="Hung Temple Tour">
                <span class="discount-badge">-9%</span>
            </div>
            <div class="tour-details">
                <h3>Hung Temple - Nghia Lo - Tu Le - Mu Cang Chai - Sapa - Fansipan - Dien Bien - Moc Chau</h3>
                <ul>
                    <li><span class="icon">⏰</span> 4 days 3 nights</li>
                    <li><span class="icon">📅</span> Monday / Thursday / Saturday</li>
                    <li><span class="icon">🚌</span> Bus</li>
                    <li><span class="icon">🏨</span> Hotel</li>
                    <li><span class="icon">👥</span> 5</li>
                </ul>
                <p class="price">13,590,000 ₫ <span class="original-price">14,590,000 ₫</span></p>
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