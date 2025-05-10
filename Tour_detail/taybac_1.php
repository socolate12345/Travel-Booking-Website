<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tay Bac Travel</title>
    <link rel="stylesheet" href="../css/viewjourney.css">
    <style>
        /* Ensure content is not overlapped by fixed header */
        .main-content {
            margin-top: 100px; /* Adjust based on header height */
            padding: 20px;
        }
    </style>
</head>
<body>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<header>
    <input type="checkbox" name="" id="toggler">
    <label for="toggler" class="fas fa-bars"></label>

    <a href="#" class="logo">
        <img src="/images/logo.png" alt="VietTransit Logo">
        <span>VietTransit</span>
    </a>

    <nav class="navbar">
        <a href="/Login/loggedinhome.php">Home</a>
        <?php
            echo "<a href='profile.php'>Hello, " . $_SESSION['usersuid'] . "!</a>";
            echo '<a href="../home.php">Logout</a>';
        ?>
    </nav>

    <div class="icons">
        <span data-tooltip="Favourites" data-flow="top"> 
            <a href="profile.php" class="fas fa-heart"></a>
        </span>
        <span data-tooltip="Cart" data-flow="top"> 
            <a href="/Payment Interface/receiptlist.php" class="fas fa-shopping-cart"></a>
        </span>
        <span data-tooltip="Profile" data-flow="top">
            <a href="profile.php" class="fas fa-user"></a>
        </span>
    </div>
</header>
<div class="main-content">

    <div class="overview">
        <p>
            Embark on a scenic journey to explore the Northwest region of Vietnam during the rice harvest season. This tour takes you through picturesque landscapes, from the lush green rice terraces in Nghia Lo to the majestic heights of Fansipan, the "Roof of Indochina."
        </p>
    </div>

    <!-- Image Gallery Section -->
    <div class="image-gallery">
        <div class="gallery-item">
            <img src="/image_tourdetail/taybac_1.1.jpg" alt="Nghia Lo Rice Fields" class="img-responsive">
            <div class="caption">Nghia Lo Rice Fields</div>
        </div>
        <div class="gallery-item">
            <img src="/image_tourdetail/taybac_1.2.jpg" alt="Mu Cang Chai" class="img-responsive">
            <div class="caption">Mu Cang Chai</div>
        </div>
        <div class="gallery-item">
            <img src="/image_tourdetail/taybac_1.3.jpg" alt="Fansipan Peak" class="img-responsive">
            <div class="caption">Fansipan Peak</div>
        </div>
        <div class="gallery-item">
            <img src="/image_tourdetail/taybac_1.4.jpg" alt="Sapa Terrace" class="img-responsive">
            <div class="caption">Sapa Terrace</div>
        </div>
    </div>

    <!-- Itinerary Section -->
    <div class="itinerary">
        <h2 class="text-bold">Itinerary</h2>
        <ul>
            <li><strong>Day 1:</strong> Departure from Hanoi to Nghia Lo. Enjoy the scenic landscapes along the way.</li>
            <li><strong>Day 2:</strong> Explore Nghia Lo's rice terraces and discover the culture of the local ethnic groups.</li>
            <li><strong>Day 3:</strong> Mu Cang Chai exploration, witnessing the stunning rice terraces.</li>
            <li><strong>Day 4:</strong> Visit Sapa, hike to the highest point of Fansipan, and explore the local markets.</li>
            <li><strong>Day 5:</strong> Visit Lai Chau, Dien Bien, and Moc Chau, learning about the region's history and culture.</li>
            <li><strong>Day 6:</strong> Return to Hanoi.</li>
        </ul>
    </div>

    <!-- Pricing Section -->
    <div class="pricing">
        <h2 class="text-bold">Pricing</h2>
        <p class="price">VND 5,500,000 per person</p>
        <p>Includes accommodation, transportation, meals, and tour guide services.</p>
    </div>

    <!-- Booking Section -->
    <div class="booking">
        <h2 class="text-bold">Book Now</h2>
        <form action="/book-tour" method="POST">
            <label for="tour-date">Select Tour Date:</label>
            <input type="date" id="tour-date" name="tour_date" required>
            <br>
            <label for="num-guests">Number of Guests:</label>
            <input type="number" id="num-guests" name="num_guests" min="1" required>
            <br>
            <button type="submit" class="btn-book">Book Now</button>
        </form>
    </div>

    <!-- Testimonials Section -->
    <div class="testimonials">
        <h2 class="text-bold">What Our Travelers Say</h2>
        <div class="testimonial">
            <p>"An unforgettable experience! The landscapes are breathtaking, and the local guides are very knowledgeable."</p>
            <p><strong>- Minh Anh</strong></p>
        </div>
        <div class="testimonial">
            <p>"The rice terraces during harvest season were a sight to behold. Highly recommend this tour for nature lovers!"</p>
            <p><strong>- Bao Ngoc</strong></p>
        </div>
    </div>

    <!-- Footer Section -->
    <footer>
        <div class="footer-info">
            <p>&copy; 2025 Tay Bac Travel. All rights reserved.</p>
        </div>
        <div class="social-links">
            <a href="#" class="fab fa-facebook"></a>
            <a href="#" class="fab fa-twitter"></a>
            <a href="#" class="fab fa-instagram"></a>
        </div>
    </footer>
</div>

</body>
</html>


   