<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hung Temple - Nghia Lo - Tu Le - Mu Cang Chai - Sapa - Fansipan - Dien Bien - Moc Chau Tour</title>
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
    <h1>&nbsp;&nbsp;&nbsp;  HUNG TEMPLE - NGHIA LO - TU LE - MU CANG CHAI - SAPA - FANSIPAN - DIEN BIEN - MOC CHAU TOUR </h1>
    <div class="gallery">
        <div class="big"><img src="taybac2/1.jpg" alt="Big Image"></div>
        <div class="small1"><img src="taybac2/2.jpg" alt="Small 1"></div>
        <div class="small2"><img src="taybac2/3.jpg" alt="Small 2"></div>
        <div class="small3"><img src="taybac2/4.jpg" alt="Small 3"></div>
        <div class="small4"><img src="taybac2/5.jpg" alt="Small 4"></div>
    </div>

    <div class="content-columns">
        <div class="left-column">
            <div class="box">
                <h2>Why This Tour Is Attractive</h2>
                <ul>
                    <li>Visit the historic Hung Temple, a symbol of Vietnam's ancient culture and heritage.</li>
                    <li>Explore the picturesque rice terraces of Mu Cang Chai and Tu Le Valley.</li>
                    <li>Conquer Fansipan Mountain, the roof of Indochina, with a breathtaking cable car ride.</li>
                    <li>Experience the local culture in Nghia Lo, Sapa, and Moc Chau, meeting ethnic minorities like Thai, H'mong, and Dao.</li>
                </ul>
            </div>

            <div class="box">
                <h2>Itinerary</h2>
                <div class="box2">
                    <h3>Day 1: Hanoi – Hung Temple – Nghia Lo</h3>
                    <p>Visit the sacred Hung Temple and continue to the charming town of Nghia Lo.</p>
                </div>

                <div class="box2">
                    <h3>Day 2: Nghia Lo – Tu Le – Mu Cang Chai</h3>
                    <p>Explore the terraced fields of Tu Le and Mu Cang Chai, famous for its stunning landscapes.</p>
                </div>

                <div class="box2">
                    <h3>Day 3: Mu Cang Chai – Sapa – Fansipan</h3>
                    <p>Arrive in Sapa, visit local villages, and take a cable car ride to the top of Fansipan Mountain.</p>
                </div>

                <div class="box2">
                    <h3>Day 4: Sapa – Dien Bien</h3>
                    <p>Travel to Dien Bien, a historical site where the famous Battle of Dien Bien Phu took place.</p>
                </div>

                <div class="box2">
                    <h3>Day 5: Dien Bien – Moc Chau – Hanoi</h3>
                    <p>Discover the green tea hills of Moc Chau before heading back to Hanoi.</p>
                </div>
            </div>
        </div>

        <div class="right-column">
            <div class="box3">
                <div class="button">
                <h3 style="display: inline;">Price From</h3>
                <p style="color: red; font-weight: bold; display: inline;">13,590,000 VND</p>
                <p></p>
               <a href="../booktour.php?cityid=10&tourid=5" class="booking-button">Booking now!</a>
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