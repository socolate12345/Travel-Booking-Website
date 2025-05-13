<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nha Trang - 3 Days - Pottery & Seashell Workshop, Ancient Nha Trang & More</title>
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
    <h1>&nbsp;&nbsp;&nbsp; NHA TRANG - 3 DAYS - POTTERY & SEASHELL WORKSHOP, ANCIENT NHA TRANG & MORE</h1>
    <div class="gallery">
        <div class="big"><img src="nhatrang2/1.jpg" alt="Big Image"></div>
        <div class="small1"><img src="nhatrang2/2.jpg" alt="Small 1"></div>
        <div class="small2"><img src="nhatrang2/3.jpg" alt="Small 2"></div>
        <div class="small3"><img src="nhatrang2/4.jpg" alt="Small 3"></div>
        <div class="small4"><img src="nhatrang2/5.jpg" alt="Small 4"></div>
    </div>

    <div class="content-columns">
        <div class="left-column">
            <div class="box">
                <h2>Why This Tour Is Attractive</h2>
                <ul>
                    <li>Immerse in the artistic heritage of Bàu Trúc Pottery Village.</li>
                    <li>Discover ancient Nha Trang and its historic sites.</li>
                    <li>Relax at Nhũ Tiên Beach and enjoy thrilling attractions at VinWonders.</li>
                    <li>Create unique crafts at the Pottery & Seashell Workshop Experience.</li>
                </ul>
            </div>

            <div class="box">
                <h2>Itinerary</h2>
                <div class="box2">
                    <h3>Day 1: Arrival & Pottery Village</h3>
                    <p>Check-in at the 4-star hotel and visit Bàu Trúc Pottery Village for a hands-on pottery session.</p>
                </div>
                <div class="box2">
                    <h3>Day 2: Ancient Nha Trang & Workshop</h3>
                    <p>Explore the historic Tháp Bà Ponagar and join the Pottery & Seashell Workshop to craft personalized souvenirs.</p>
                </div>
                <div class="box2">
                    <h3>Day 3: Nhũ Tiên Beach & VinWonders</h3>
                    <p>Spend the day at Nhũ Tiên Beach before a thrilling afternoon at VinWonders theme park.</p>
                </div>
            </div>
        </div>

        <div class="right-column">
            <div class="box3">
                <div class="button">
                <h3 style="display: inline;">Price From</h3>
                <p style="color: red; font-weight: bold; display: inline;">2,690,000 VND</p>
                <p></p>
                <a href="../booktour.php?cityid=12&tourid=7" class="booking-button">Booking now!</a>
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
            <a href="/journey/viewjourney_taybac.php">Tay Bac</a>
            <a href="/journey/viewjourney_hcm.php">Ho Chi Minh</a>
            <a href="/journey/viewjourney_phuquoc.php">Phu Quoc</a>
            <a href="/journey/viewjourney_hue.php">Hue</a>
        </div>
        <div class="box">
            <h3>contact info</h3>
            <a href="https://github.com/socolate12345/Travel-Booking-Website">GitHub</a>
            <img src="./images/payment.png" alt="">
        </div>
    </div>
    <div class="credit">©2025 VietTransit</div>
</section>
</footer>
</html>