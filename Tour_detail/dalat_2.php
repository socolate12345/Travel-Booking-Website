<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Da Lat - Datanla Waterfall Tour</title>
    <link rel="stylesheet" href="../css/tour.css">
</head>
<body>


<header>
    <div class="header-container">
        <a href="#" class="logo">
            <img src="../images/logo.png" alt="VietTransit Logo">
            <span>VietTransit</span>
        </a>
        <nav class="navbar">
            <a href="/Login/loggedinhome.php">Home</a>
            <?php
                if (isset($_SESSION['usersuid'])) {
                    echo "<a href='/Login/profile.php'>Hello, " . htmlspecialchars($_SESSION['usersuid']) . "!</a>";
                }
                echo '<a href="../home.php">Logout</a>';
            ?>
        </nav>
    </div>
</header>

<main>

    <h1>&nbsp;&nbsp;&nbsp;  DA LAT - DATANLA WATERFALL - COFFEE FARM - CLAY TUNNEL TOUR </h1>
    <p></p>
    <!-- Gallery placed above the columns -->
    <div class="gallery">

        <div class="big"><img src="image_tourdetail/dalat_2.1.jpg" alt="Big Image"></div>
        <div class="small1"><img src="image_tourdetail/dalat_2.2.jpg" alt="Small 1"></div>
        <div class="small2"><img src="image_tourdetail/dalat_2.3.jpg" alt="Small 2"></div>
        <div class="small3"><img src="image_tourdetail/dalat_2.4.jpg" alt="Small 3"></div>
        <div class="small4"><img src="image_tourdetail/dalat_2.5.jpg" alt="Small 4"></div>
    </div>
    <p></p>
    <!-- Columns start here -->
    <div class="content-columns">
        <div class="left-column">
            <div class="box">
                <h2>Why This Tour Is Attractive</h2>
                <ul>
                    <li>Discover the natural beauty of Da Lat through waterfalls, pine forests, and colorful flower gardens.</li>
                    <li>Visit Datanla Waterfall for thrilling activities like alpine coaster rides.</li>
                    <li>Experience Da Lat’s unique culture with stops at a local coffee farm and the artistic Clay Tunnel.</li>
                </ul>
            </div>

            <div class="box">
                <h2>Itinerary</h2>
                <div class="box2">
                    <h3>Day 1: Arrival in Da Lat – Datanla Waterfall – Coffee Farm</h3>
                    <p>Arrive in Da Lat, explore Datanla Waterfall with adventure options, then visit a local coffee farm for tasting and sightseeing.</p>
                </div>

                <div class="box2">
                    <h3>Day 2: Clay Tunnel – Departure</h3>
                    <p>Visit the Clay Tunnel to see creative sculptures and unique architecture before returning home.</p>
                </div>
            </div>
        </div>

        <div class="right-column">
            <div class="box3">
                <div class="button">
                <h3 style="display: inline;">Price From</h3>
                <p style="color: red; font-weight: bold; display: inline;">2,040,000 VND</p>
                <p></p>
                <a href="../booktour.php?cityid=15&tourid=13" class="booking-button">Booking now!</a>
            </div>
            </div>
            <div class="box">
                <h3>Contact Support</h3>
                <p>📞 Hotline: 1919 2025<br>✉️ Email: viettransit.support@mail.com</p>
            </div>
            <div class="box">
                <h3>Why Book Online?</h3>
                <ul>
                    <li>Safe & Secure</li>
                    <li>Convenient & Time-saving</li>
                    <li>No hidden fees</li>
                    <li>Exclusive deals</li>
                </ul>
            </div>
            <div class="box">
                <h3>Trusted Tour</h3>
                <p>Founded in 2025<br>Leading travel brand<br>Nationally recognized</p>
            </div>
        </div>
    </div>
</main>

<footer>
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
            <h3>Contact Info</h3>
            <a href="https://github.com/socolate12345/Travel-Booking-Website">GitHub</a>
            <img src="./images/payment.png" alt="">
        </div>
    </div>
    <div class="credit">©2025 VietTransit</div>
</footer>

</body>
</html>
