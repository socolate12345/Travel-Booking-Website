<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hoi An Nature & Culture</title>
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
    <h1>Hoi An Nature & Culture: Cam Thanh Village - Thu Bon River Cruise - Marble Mountains - Local Handicraft Workshops</h1>
    <div class="gallery" id="lightgallery">
        <a href="hoian4/1.jpg" class="big"><img src="hoian4/1.jpg" alt="Bay Mau Coconut Forest"></a>
        <a href="hoian4/2.jpg" class="small1"><img src="hoian4/2.jpg" alt="Hoi An Boat"></a>
        <a href="hoian4/3.jpg" class="small2"><img src="hoian4/3.jpg" alt="Ngu Hanh Son"></a>
        <a href="hoian4/4.jpg" class="small3"><img src="hoian4/4.jpg" alt="Lantern Crafting Village"></a>
        <a href="hoian4/5.jpg" class="small4"><img src="hoian4/5.jpg" alt="Ngu Hanh Son"></a>
    </div>
    <div class="content-columns">
        <div class="left-column">
            <div class="box">
                <h2>Why This Tour Is Attractive</h2>
                <ul>
                    <li>Explore the peaceful Cam Thanh Village and enjoy a unique basket boat ride through nipa palm forests.</li>
                    <li>Cruise along the Thu Bon River and admire the scenic countryside and daily river life of the locals.</li>
                    <li>Discover the spiritual Marble Mountains with its ancient caves, temples, and panoramic coastal views.</li>
                    <li>Engage in local handicraft workshops to learn traditional skills like lantern-making and wood carving.</li>
                    <li>Depart conveniently from Da Nang by bus and stay in well-appointed hotel accommodations for a balanced nature and cultural retreat.</li>
                </ul>
            </div>

            <div class="box">
                <h2>Itinerary</h2>
                <div class="box2">
                    <h3>Day 1: Da Nang – Hoi An</h3>
                    <p>Depart from Da Nang by bus and arrive in Hoi An. Check in to your hotel and enjoy a welcome dinner. Take a relaxing evening walk through the illuminated Ancient Town.</p>
                </div>
                <div class="box2">
                    <h3>Day 2: Cam Thanh Village – Handicraft Workshops</h3>
                    <p>Visit Cam Thanh Village in the morning, take a basket boat ride through the palm forest, and interact with local fishermen. In the afternoon, participate in handicraft workshops to create your own lantern or wooden souvenir.</p>
                </div>
                <div class="box2">
                    <h3>Day 3: Thu Bon River Cruise – Marble Mountains</h3>
                    <p>Enjoy a scenic cruise along the Thu Bon River and visit nearby craft villages. In the afternoon, explore the Marble Mountains, visit pagodas and caves, and take in breathtaking views of the sea.</p>
                </div>
                <div class="box2">
                    <h3>Day 4: Leisure Morning – Return to Da Nang</h3>
                    <p>Spend your morning at leisure for shopping or relaxing. After checking out, return to Da Nang by bus, ending your immersive nature and culture experience in Hoi An.</p>
                </div>
            </div>
        </div>

        <div class="right-column">
            <div class="box3">
                <div class="button">
                    <h3 style="display: inline;">Price From</h3>
                    <p style="color: red; font-weight: bold; display: inline;">6,150,000  VND</p>
                    <p style="text-decoration: line-through; color: gray;">7,230,000 VND</p>
                    <a href="/tour/booking?cityid=17&tourid=32" class="booking-button">Booking now!</a>
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