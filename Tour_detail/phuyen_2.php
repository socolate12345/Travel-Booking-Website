<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Phu Yen - Quy Nhon Tour</title>
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

    <h1>&nbsp;&nbsp;&nbsp;  PHU YEN - QUY NHON - EO GIO TOUR </h1>
    <p></p>
    <!-- Gallery placed above the columns -->
    <div class="gallery">

        <div class="big"><img src="image_tourdetail/phuyen_2.1.jpg" alt="Big Image"></div>
        <div class="small1"><img src="image_tourdetail/phuyen_2.2.jpg" alt="Small 1"></div>
        <div class="small2"><img src="image_tourdetail/phuyen_2.3.jpg" alt="Small 2"></div>
        <div class="small3"><img src="image_tourdetail/phuyen_2.4.jpg" alt="Small 3"></div>
        <div class="small4"><img src="image_tourdetail/phuyen_2.5.jpg" alt="Small 4"></div>
    </div>
    <p></p>
    <!-- Columns start here -->
    <div class="content-columns">
        <div class="left-column">
            <div class="box">
                <h2>Why This Tour Is Attractive</h2>
                <ul>
                    <li>Discover the unspoiled beauty of Phu Yen with its stunning coastline, rocky landscapes, and peaceful countryside.</li>
                    <li>Enjoy the vibrant seaside city of Quy Nhon, known for its clean beaches, friendly locals, and rich Cham culture.</li>
                    <li>Explore Eo Gio and Ky Co – two of the most picturesque coastal spots in Vietnam with turquoise water and dramatic cliffs.</li>
                </ul>
            </div>

            <div class="box">
                <h2>Itinerary</h2>
                <div class="box2">
                    <h3>Day 1: Arrival in Phu Yen – Tuy Hoa Exploration</h3>
                    <p>Arrive in Tuy Hoa, visit Ganh Da Dia and O Loan Lagoon, and enjoy a peaceful evening on the beach.</p>
                </div>

                <div class="box2">
                    <h3>Day 2: Phu Yen – Quy Nhon</h3>
                    <p>Explore Bai Xep Beach and Mang Lang Church before heading to Quy Nhon for a relaxing evening.</p>
                </div>

                <div class="box2">
                    <h3>Day 3: Quy Nhon – Eo Gio – Ky Co</h3>
                    <p>Visit Eo Gio and Ky Co Beach, explore Nhon Ly fishing village and enjoy fresh seafood by the sea.</p>
                </div>

                <div class="box2">
                    <h3>Day 4: Quy Nhon – Departure</h3>
                    <p>Free time in the morning, visit local markets or Twin Towers before departing from Phu Cat Airport.</p>
                </div>
            </div>
        </div>

        <div class="right-column">
            <div class="box3">
                <div class="button">
                <h3 style="display: inline;">Price From</h3>
                <p style="color: red; font-weight: bold; display: inline;">7,390,000 VND</p>
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
