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

    <h1>&nbsp;&nbsp;&nbsp;  HA GIANG - LUNG CU - DONG VAN - TAM GIAC MACH FLOWER SEASON TOUR </h1>
    <p></p>
    <!-- Gallery placed above the columns -->
    <div class="gallery">

        <div class="big"><img src="image_tourdetail/hagiang_2.1.jpg" alt="Big Image"></div>
        <div class="small1"><img src="image_tourdetail/hagiang_2.2.jpg" alt="Small 1"></div>
        <div class="small2"><img src="image_tourdetail/hagiang_2.3.jpg" alt="Small 2"></div>
        <div class="small3"><img src="image_tourdetail/hagiang_2.4.jpg" alt="Small 3"></div>
        <div class="small4"><img src="image_tourdetail/hagiang_2.5.jpg" alt="Small 4"></div>
    </div>
    <p></p>
    <!-- Columns start here -->
    <div class="content-columns">
        <div class="left-column">
            <div class="box">
                <h2>Why This Tour Is Attractive</h2>
                <ul>
                    <li>Witness the stunning Tam Giac Mach (buckwheat flower) fields in full bloom – a signature of Ha Giang in autumn.</li>
                    <li>Visit Lung Cu Flag Tower, the northernmost point of Vietnam with breathtaking mountain views.</li>
                    <li>Discover ethnic culture and ancient beauty in Dong Van Old Quarter and majestic highland passes.</li>
                </ul>
            </div>

            <div class="box">
                <h2>Itinerary</h2>
                <div class="box2">
                    <h3>Day 1: Ha Giang – Quan Ba – Yen Minh</h3>
                    <p>Depart from Ha Giang, pass through Heaven’s Gate and Fairy Bosom Hill in Quan Ba, stay overnight in Yen Minh.</p>
                </div>

                <div class="box2">
                    <h3>Day 2: Yen Minh – Lung Cu – Dong Van</h3>
                    <p>Visit the Lung Cu Flag Tower, explore Lo Lo ethnic village, and head to Dong Van for the night.</p>
                </div>

                <div class="box2">
                    <h3>Day 3: Dong Van – Tam Giac Mach Fields – Ma Pi Leng – Meo Vac</h3>
                    <p>Walk through blooming Tam Giac Mach flower fields, cross the dramatic Ma Pi Leng Pass, then visit Meo Vac before returning to Ha Giang.</p>
                </div>

                <div class="box2">
                    <h3>Day 4: Ha Giang – Free Time – Departure</h3>
                    <p>Enjoy free time for a local breakfast or short walk before departure.</p>
                </div>
            </div>
        </div>

        <div class="right-column">
            <div class="box3">
                <div class="button">
                <h3 style="display: inline;">Price From</h3>
                <p style="color: red; font-weight: bold; display: inline;">4,500,000 VND</p>
                <p></p>
                <a href="/view_hotels.php?city_id=10" class="booking-button">Booking now!</a>
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
