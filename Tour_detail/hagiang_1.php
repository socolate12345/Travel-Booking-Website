<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ha Giang Tour</title>
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

    <h1>&nbsp;&nbsp;&nbsp;  HA GIANG - DONG VAN - MA PI LENG - MEO VAC TOUR </h1>
    <p></p>
    <!-- Gallery placed above the columns -->
    <div class="gallery">

        <div class="big"><img src="image_tourdetail/hagiang_1.1.jpg" alt="Big Image"></div>
        <div class="small1"><img src="image_tourdetail/hagiang_1.2.jpg" alt="Small 1"></div>
        <div class="small2"><img src="image_tourdetail/hagiang_1.3.jpg" alt="Small 2"></div>
        <div class="small3"><img src="image_tourdetail/hagiang_1.4.jpg" alt="Small 3"></div>
        <div class="small4"><img src="image_tourdetail/hagiang_1.5.jpg" alt="Small 4"></div>
    </div>
    <p></p>
    <!-- Columns start here -->
    <div class="content-columns">
        <div class="left-column">
            <div class="box">
                <h2>Why This Tour Is Attractive</h2>
                <ul>
                    <li>Conquer the legendary Ha Giang Loop, one of Vietnam’s most scenic mountain routes.</li>
                    <li>Admire breathtaking landscapes at Ma Pi Leng Pass, often called the “king of all mountain passes.”</li>
                    <li>Explore the unique culture of ethnic minorities in Dong Van and Meo Vac.</li>
                </ul>
            </div>

            <div class="box">
                <h2>Itinerary</h2>
                <div class="box2">
                    <h3>Day 1: Ha Giang – Quan Ba – Yen Minh – Dong Van</h3>
                    <p>Depart from Ha Giang, stop at Heaven’s Gate and Twin Mountains in Quan Ba, pass through scenic valleys to reach Dong Van.</p>
                </div>

                <div class="box2">
                    <h3>Day 2: Dong Van – Ma Pi Leng – Meo Vac – Ha Giang</h3>
                    <p>Visit Dong Van Old Quarter, travel along the spectacular Ma Pi Leng Pass, then head to Meo Vac and return to Ha Giang.</p>
                </div>

                <div class="box2">
                    <h3>Day 3: Ha Giang – Free Time – Departure</h3>
                    <p>Relax in Ha Giang town, visit local markets or villages before heading back or transferring to Hanoi.</p>
                </div>
            </div>
        </div>

        <div class="right-column">
            <div class="box3">
                <div class="button">
                <h3 style="display: inline;">Price From</h3>
                <p style="color: red; font-weight: bold; display: inline;">3,750,000 VND</p>
                <p></p>
                <a href="../booktour.php?cityid=18&tourid=18" class="booking-button">Booking now!</a>
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
