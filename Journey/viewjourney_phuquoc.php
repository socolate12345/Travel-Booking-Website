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
    <h1>PHU QUOC TRAVEL</h1>
    <p>
    Phu Quoc, known as the Pearl Island of Vietnam, boasts crystal-clear waters, white sandy beaches, and vibrant marine life. Whether you're seeking relaxation, adventure, or cultural exploration, Phu Quoc offers it all—from snorkeling in coral reefs to visiting traditional fish sauce villages.
    </p>
    <p>
    Register for a <strong>Phu Quoc</strong> tour with VietTransit to discover attractions such as Bai Sao Beach, VinWonders, Phu Quoc Prison, and more. For a complete guide, refer to <a href="/Travel tips/traveltip_phuquoc.php">Phu Quoc Travel Tips</a>.
    </p>

    <div class="tour-container">
        <div class="tour-card">
            <div class="tour-image">
                <img src="../images/phuquoc_1.jpg" alt="Phu Quoc Beach Tour">
                <span class="discount-badge">-25%</span>
            </div>
            <div class="tour-details">
                <h3>Phu Quoc - Bai Sao - Tranh Stream - Night Market</h3>
                <ul>
                    <li><span class="icon">⏰</span> 3 days 2 nights</li>
                    <li><span class="icon">📅</span> Friday / Sunday</li>
                    <li><span class="icon">🚌</span> Bus & Boat</li>
                    <li><span class="icon">🏨</span> Resort</li>
                    <li><span class="icon">👥</span> 18</li>
                </ul>
                <p class="price">5,250,000 ₫ <span class="original-price">7,000,000 ₫</span></p>
                <button>See More</button>
            </div>
        </div>

        <div class="tour-card">
            <div class="tour-image">
                <img src="../images/phuquoc_2.jpg" alt="Phu Quoc Discovery Tour">
                <span class="discount-badge">-12%</span>
            </div>
            <div class="tour-details">
                <h3>Phu Quoc - VinWonders - Safari - Hon Thom Cable Car</h3>
                <ul>
                    <li><span class="icon">⏰</span> 4 days 3 nights</li>
                    <li><span class="icon">📅</span> Tuesday / Saturday</li>
                    <li><span class="icon">🚌</span> Bus & Boat</li>
                    <li><span class="icon">🏨</span> Resort</li>
                    <li><span class="icon">👥</span> 12</li>
                </ul>
                <p class="price">8,800,000 ₫ <span class="original-price">9,990,000 ₫</span></p>
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