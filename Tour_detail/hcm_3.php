<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Museum and Contemporary Art Tour in Ho Chi Minh</title>
    <link rel="stylesheet" href="../css/tour.css">
    <link rel="icon" type="image/png" href="../images/favicon.png">
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

    <h1>&nbsp;&nbsp;&nbsp;  Museum and Contemporary Art Tour in Ho Chi Minh</h1>
    <div class="gallery">
        <div class="big"><img src="hcm3/1.jpg" alt="Big Image"></div>
        <div class="small1"><img src="hcm3/2.jpg" alt="Small 1"></div>
        <div class="small2"><img src="hcm3/3.jpg" alt="Small 2"></div>
        <div class="small3"><img src="hcm3/4.jpg" alt="Small 3"></div>
        <div class="small4"><img src="hcm3/5.jpg" alt="Small 4"></div>
    </div>

    <div class="content-columns">
        <div class="left-column">
            <div class="box">
                <h2>Why This Tour Is Attractive</h2>
                <ul>
                    <li>Immerse yourself in Vietnam's art and culture scene</li>
                    <li>Visit top museums and contemporary art galleries</li>
                    <li>Expert guides offer in-depth cultural insights</li>
                    <li>Comfortable bus transport and hotel accommodation</li>
                    <li>Ideal for small groups on weekday getaways</li>
                </ul>
            </div>

            <div class="box">
                <h2>Itinerary</h2>
                <div class="box2">
                    <h3>Day 1: Historical & Fine Arts Museums</h3>
                    <p>Begin the tour with visits to the Ho Chi Minh City Museum and the Fine Arts Museum, learning about Vietnam's history and classical art.</p>
                </div>
                <div class="box2">
                    <h3>Day 2: Contemporary Art Spaces</h3>
                    <p>Explore dynamic modern art galleries and creative spaces like The Factory Contemporary Arts Centre, and engage with local artists.</p>
                </div>
            </div>

        </div>

        <div class="right-column">
            <div class="box3">
                <div class="button">
                    <h3 style="display: inline;">Price From</h3>
                    <p style="color: red; font-weight: bold; display: inline;">980,000 ₫</p>
                    <p style="text-decoration: line-through; color: gray;">1,019,000 ₫</p>
                    <a href="/tour/booking?cityid=11&tourid=7" class="booking-button">Booking now!</a>
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
            <h3>Extra links</h3>
            <a href="../Login/profile.php">My account</a>
            <a href="../Payment Interface/receiptlist.php">My List</a>
            <a href="../Login/profile.php">My favorite</a>
        </div>
        <div class="box">
            <h3>Popular Travel Locations</h3>
            <a href="../Journey/viewjourney_tay_bac.php">Tay Bac</a>
            <a href="../Journey/viewjourney_ho_chi_minh.php">Ho Chi Minh</a>
            <a href="../Journey/viewjourney_phu_quoc.php">Phu Quoc</a>
            <a href="../Journey/viewjourney_hue.php">Hue</a>
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
