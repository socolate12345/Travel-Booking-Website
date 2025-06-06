<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sapa - Fansipan - Y Ty - Bat Xat Rice Terraces Tour</title>
    <link rel="stylesheet" href="../css/tour.css">
    <link rel="icon" type="image/png" href="../images/favicon.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/lightgallery@2.7.0/css/lightgallery.css">
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
    <h1>&nbsp;&nbsp;&nbsp; Sapa - Fansipan - Y Tý - Bát Xát Rice Terraces</h1>
    <p></p>

    <!-- Gallery -->
    <div class="gallery" id="lightgallery">
        <a href="Taybac3/1.jpg" class="big"><img src="Taybac3/1.jpg" alt="Best View Cafe"></a>
        <a href="Taybac3/2.jpg" class="small1"><img src="Taybac3/2.jpg" alt="Phansipang Cable Car"></a>
        <a href="Taybac3/3.jpg" class="small2"><img src="Taybac3/3.jpg" alt="Hoang Su Phi Rice field></a>
        <a href="Taybac3/4.jpg" class="small3"><img src="Taybac3/4.jpg" alt="Bat Xat Rice filed></a>
        <a href="Taybac3/5.jpg" class="small4"><img src="Taybac3/5.jpg" alt="Sewing Tradition"></a>
    </div>

    <div class="content-columns">
        <div class="left-column">
            <div class="box">
                <h2>Why This Tour Is Attractive</h2>
                <ul>
                    <li>Admire the magnificent terraced fields of Y Ty and Bat Xat, one of the most beautiful highland regions in Vietnam.</li>
                    <li>Conquer the Roof of Indochina – Fansipan – by cable car with stunning panoramic views.</li>
                    <li>Immerse yourself in the unique culture and lifestyle of the H'Mong and Ha Nhi ethnic groups.</li>
                </ul>
            </div>

            <div class="box">
                <h2>Itinerary</h2>
                <div class="box2">
                    <h3>Day 1: Hanoi – Sa Pa – Fansipan</h3>
                    <p>Depart from Hanoi, arrive in Sa Pa. Take the Fansipan cable car and enjoy the incredible views from Vietnam’s highest peak.</p>
                </div>

                <div class="box2">
                    <h3>Day 2: Sa Pa – Y Ty – Bat Xat</h3>
                    <p>Journey to Y Ty, a remote highland commune with amazing rice terraces. Continue to Bat Xat for scenic photo stops and cultural experiences.</p>
                </div>

                <div class="box2">
                    <h3>Day 3: Bat Xat – Lao Cai – Hanoi</h3>
                    <p>Relax and explore local markets, then return to Hanoi with unforgettable memories of the Northwest region.</p>
                </div>
            </div>
        </div>

        <div class="right-column">
            <div class="box3">
                <div class="button">
                    <h3 style="display: inline;">Price From</h3>
                    <p style="color: red; font-weight: bold; display: inline;">9,405,000 VND</p>
                    <p style="text-decoration: line-through; color: gray;">9,900,000 VND</p>
                    <a href="/tour/booking?cityid=10&tourid=3" class="booking-button">Booking now!</a>
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
<script src="https://cdn.jsdelivr.net/npm/lightgallery@2.7.0/lightgallery.min.js"></script>
<script>
    lightGallery(document.getElementById('lightgallery'), {
        thumbnail: true,
        animateThumb: true,
        showThumbByDefault: true,
        mode: 'lg-slide',
        download: false,
        share: false
    });
</script>
</footer>
</html>
