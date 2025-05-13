<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ninh Binh - Moc Chau Tour</title>
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

    <h1>&nbsp;&nbsp;&nbsp;  NORTHWEST IN RICE HARVEST SEASON - NGHIA LO - MU CANG CHAI - SAPA - FANSIPAN - LAI CHAU - DIEN BIEN </h1>
    <p></p>
    <!-- Gallery placed above the columns -->
    <div class="gallery">

        <div class="big"><img src="taybac/1.jpg" alt="Big Image"></div>
        <div class="small1"><img src="taybac/2.jpg" alt="Small 1"></div>
        <div class="small2"><img src="taybac/3.jpg" alt="Small 2"></div>
        <div class="small3"><img src="taybac/4.jpg" alt="Small 3"></div>
        <div class="small4"><img src="taybac/5.jpg" alt="Small 4"></div>
    </div>
    <p></p>
    <!-- Columns start here -->
    <div class="content-columns">
        <div class="left-column">
            <div class="box">
                <h2>Why This Tour Is Attractive</h2>
                <ul>
                    <li>Explore the stunning landscapes of Sa Pa, with terraced fields and the highest mountain in Vietnam – Fansipan.</li>
                    <li>Discover the unique culture of ethnic minorities in the northern provinces like H'mong, Tay, and Dao.</li>
                    <li>Experience the serene beauty of Pu Luong Nature Reserve, Moc Chau Plateau, and Mai Chau Valley.</li>
                </ul>
            </div>

            <div class="box">
                <h2>Itinerary</h2>
                <div class="box2">
                    <h3>Day 1: Hanoi – Sa Pa</h3>
                    <p>Arrive in Sa Pa, visit the terraced fields, and enjoy the breathtaking views of the Fansipan Mountain.</p>
                </div>

                <div class="box2">
                    <h3>Day 2: Sa Pa – Lai Chau – Moc Chau</h3>
                    <p>Explore the ethnic villages in Sa Pa, continue your journey to Lai Chau, and visit Moc Chau Plateau.</p>
                </div>

                <div class="box2">
                    <h3>Day 3: Moc Chau – Mai Chau – Hanoi</h3>
                    <p>Discover the lush valleys of Mai Chau and interact with the local Thai people before returning to Hanoi.</p>
                </div>
            </div>
        </div>

        <div class="right-column">
            <div class="box3">
                <div class="button">
                <h3 style="display: inline;">Price From</h3>
                <p style="color: red; font-weight: bold; display: inline;">4,590,000 VND</p>
                <p></p>
                <a href="../booktour.php?cityid=10&tourid=4" class="booking-button">Booking now!</a>
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