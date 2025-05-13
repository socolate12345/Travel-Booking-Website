<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> VietTransit</title>
    <link rel="icon" type="image/png" href="../images/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="stylesheet" href="../css/style.css">
    </head>
<body>

<header>

    <input type="checkbox" name="" id="toggler">
    <label for="toggler" class="fas fa-bars"></label>

    <a href="#" class="logo">
    <img src="/images/logo.png" alt="VietTransit Logo">
    <span>VietTransit</span>
</a>

    <nav class="navbar">
        <a href="#home">Home</a>
        <a href="#about">About</a>
        <a href="#products">Places</a>
        <a href="#review">Review</a>
        <a href="../booking/find_tour.php">Tour</a>
        <a href="../booking/find_hotels.php">Hotel</a>
        <?php
            echo "<a href='profile.php'>Hello, " . $_SESSION['usersuid'] . "!</a>";
            echo '<a href="../home.php">Logout</a>';
        ?>
    </nav>

    <div class="icons">
        <span data-tooltip="Favourites" data-flow="top"> 
             <a href="profile.php" class="fas fa-heart"></a>
            </span>
        <span data-tooltip="Profile" data-flow="top">
             <a href="profile.php" class="fas fa-user"></a>
        </span>
    </div>

</header>

<section class="home" id="home">
    <!-- Video background -->
    <div class="video-container">
        <video id="bgVideo" autoplay muted loop playsinline>
            <source id="videoSource" src="" type="video/mp4">
        </video>
    </div>

    <!-- Nội dung chính -->
    <div class="content">
        <span><strong>Incredible Vietnam:</strong></span>
        <p>Where Every Place is a Story, Every Journey an Adventure.</p>
        <a href="#products" class="btn">Travel Now</a>
    </div>
</section>

<script>
    function changeVideoBackground() {
        const hour = new Date().getHours();
        const videoSrc = (hour >= 6 && hour < 18)
            ? "/images/daytime.mp4"      // ban ngày
            : "/images/nighttime.mp4";   // ban đêm

        document.getElementById("videoSource").src = videoSrc;
        document.getElementById("bgVideo").load();
    }

    changeVideoBackground();
</script>


<section class="about" id="about">

    <h1 class="heading"> <span> about </span> us </h1>

    <div class="row">

        <div class="video-container">
            <video src="../images/about-vid.mp4" loop autoplay muted></video>
            <h3>Best Places</h3>
        </div>

        <div class="content">
            <h3>why choose us?</h3>
<p> What truly sets us apart is our deep understanding of travel within Vietnam and our unwavering dedication to your satisfaction. Whether you're planning a peaceful retreat to Da Lat, a beach escape in Phu Quoc, or a cultural adventure in Hanoi and Hue, our 24/7 local support team is always here to help. We offer competitive prices and exclusive deals on top Vietnamese destinations, making your journey affordable and unforgettable. When you choose our travel website, you're not just booking a trip — you're joining a community that values authentic experiences and hassle-free service. Let us take care of the details, so you can focus on discovering the beauty of Vietnam.</p>
            <a href="#review" class="btn">learn more</a>
        </div>

    </div>

    </div>

</section> 

<section class="icons-container">

    <div class="icons">
        <img src="../images/icon-1.png" alt="">
        <div class="info">
            <h3>free booking</h3>
            <span>on all orders</span>
        </div>
    </div>

    <div class="icons">
        <img src="../images/icon-2.png" alt="">
        <div class="info">
            <h3>10 days returns</h3>
            <span>moneyback guarantee</span>
        </div>
    </div>

    <div class="icons">
        <img src="../images/icon-3.png" alt="">
        <div class="info">
            <h3>offer & gifts</h3>
            <span>on all orders</span>
        </div>
    </div>

    <div class="icons">
        <img src="../images/icon-4.png" alt="">
        <div class="info">
            <h3>secure paymens</h3>
            <span>protected by Razorpay</span>
        </div>
    </div>

</section>



<section class="products" id="products">

    <h1 class="heading"> Popular <span>Places</span> </h1>

    <div class="box-container">

        <div class="box">
            <div class="image">
                <img src="../images/taybac.jpg" alt="">
                <div class="icons">
                    <a href="add_favorite.php?cityid=10" class="fas fa-heart"></a>
                    <a href="..//Journey/viewjourney_tay_bac.php" class="cart-btn">Visit Us</a>
                    <a href="../view_hotels.php?city_id=10" class="fas fa-share"></a>
                </div>
            </div>
            <div class="content">
                <h3>Tay Bac</h3>
                <div class="price">The land of mountains and cultural identity</div>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="../images/hcm.jpg" alt="">
                <div class="icons">
                    <a href="add_favorite.php?cityid=11" class="fas fa-heart"></a>
                    <a href="..//Journey/viewjourney_ho_chi_minh.php" class="cart-btn">Visit Us</a>
                    <a href="../view_hotels.php?city_id=11" class="fas fa-share"></a>
                </div>
            </div>
            <div class="content">
                <h3>Ho Chi Minh</h3>
                <div class="price">The city that never sleeps</div>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="../images/nhatrang.jpg" alt="">
                <div class="icons">
                    <a href="add_favorite.php?cityid=12" class="fas fa-heart"></a>
                    <a href="..//Journey/viewjourney_nha_trang.php" class="cart-btn">Visit Us</a>
                    <a href="../view_hotels.php?city_id=12" class="fas fa-share"></a>
                </div>
            </div>
            <div class="content">
                <h3>Nha Trang</h3>
                <div class="price">The blue gem of Central Vietnam</div>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="../images/hue.jpg" alt="">
                <div class="icons">
                    <a href="add_favorite.php?cityid=13" class="fas fa-heart"></a>
                    <a href="..//Journey/viewjourney_hue.php" class="cart-btn">Visit Us</a>
                    <a href="../view_hotels.php?city_id=13" class="fas fa-share"></a>
                </div>
            </div>
            <div class="content">
                <h3>Hue</h3>
                <div class="price">Where nostalgia lives in every corner </div>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="../images/phuyen.jpg" alt="">
                <div class="icons">
                    <a href="add_favorite.php?cityid=14" class="fas fa-heart"></a>
                    <a href="..//Journey/viewjourney_phu_yen.php" class="cart-btn">Visit Us</a>
                    <a href="../view_hotels.php?city_id=14" class="fas fa-share"></a>
                </div>
            </div>
            <div class="content">
                <h3>Phu Yen</h3>
                <div class="price">The land of unspoiled beauty</div>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="../images/dalat.jpg" alt="">
                <div class="icons">
                    <a href="add_favorite.php?cityid=15" class="fas fa-heart"></a>
                    <a href="..//Journey/viewjourney_da_lat.php" class="cart-btn">Visit Us</a>
                    <a href="../view_hotels.php?city_id=15" class="fas fa-share"></a>
                </div>
            </div>
            <div class="content">
                <h3>Da Lat</h3>
                <div class="price">Where flowers bloom all year round</div>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="../images/phuquoc.jpg" alt="">
                <div class="icons">
                    <a href="add_favorite.php?cityid=16" class="fas fa-heart"></a>
                    <a href="..//Journey/viewjourney_phu_quoc.php" class="cart-btn">Visit Us</a>
                    <a href="../view_hotels.php?city_id=16" class="fas fa-share"></a>
                </div>
            </div>
            <div class="content">
                <h3>Phu Quoc</h3>
                <div class="price">Pristine beauty between sky and sea</div>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="../images/hoian.jpg" alt="">
                <div class="icons">
                    <a href="add_favorite.php?cityid=17" class="fas fa-heart"></a>
                    <a href="..//Journey/viewjourney_hoi_an.php" class="cart-btn">Visit Us</a>
                    <a href="../view_hotels.php?city_id=17" class="fas fa-share"></a>
                </div>
            </div>
            <div class="content">
                <h3>Hoi An</h3>
                <div class="price">Where the past and present walk together</div>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="../images/hagiang.jpg" alt="">
                <div class="icons">
                    <a href="add_favorite.php?cityid=18" class="fas fa-heart"></a>
                    <a href="..//Journey/viewjourney_ha_giang.php" class="cart-btn">Visit Us</a>
                    <a href="../view_hotels.php?city_id=18" class="fas fa-share"></a>
                </div>
            </div>
            <div class="content">
                <h3>Ha Giang</h3>
                <div class="price">Where misty mountains rise between earth and sky</div>
            </div>
        </div>

    </div>

</section>



<section class="review" id="review">

<h1 class="heading"> customer's <span>review</span> </h1>

<div class="box-container">

    <div class="box">
        <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
        </div>
        <p>Booking my dream trip to the stunning landscapes of Tây Bắc with VietTransit was a breeze – seamless and stress-free! </p>
        <div class="user">
            <img src="../images/pic-1.jpg" alt="atharva pfp">
            <div class="user-info">
                <h3>Thanh Trung</h3>
                <span>Ho Chi Minh</span>
            </div>
        </div>
        <span class="fas fa-quote-right"></span>
    </div>

    <div class="box">
        <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
        </div>
        <p>Thanks to Travelscapes, I explored the breathtaking beauty of Phu Yen with ease, and the deals were unbeatable!</p>
        <div class="user">
            <img src="../images/pic-2.png" alt="Yash pfp">
            <div class="user-info">
                <h3>Thuong Vo</h3>
                <span>Ha Noi</span>
            </div>
        </div>
        <span class="fas fa-quote-right"></span>
    </div>

    <div class="box">
        <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
        </div>
        <p>Made my adventure to the charming Da Lat unforgettable, with expert guidance and fantastic itineraries.</p>
        <div class="user">
            <img src="../images/pic-3.jpg" alt="Tejas pfp">
            <div class="user-info">
                <h3>Thinh Le</h3>
                <span>Binh Phuoc</span>
            </div>
        </div>
        <span class="fas fa-quote-right"></span>
    </div>

</div>

</section>



<section class="footer">

    <div class="box-container">

        <div class="box">
            <h3>quick links</h3>
            <a href="#home">Home</a>
            <a href="#about">About </a>
            <a href="#products">Places</a>
            <a href="#review">Review</a>
        </div>

        <div class="box">
            <h3>extra links</h3>
            <a href="profile.php">My account</a>
            <a href="profile.php">My List</a>
            <a href="profile.php">My favorite</a>
        </div>

        <div class="box">
            <h3>Popular Travel Locations</h3>
            <a href="../viewjourney.php?cityid=10">Tay Bac</a>
            <a href="../viewjourney.php?cityid=11">Ho Chi Minh</a>
            <a href="../viewjourney.php?cityid=16">Phu Quoc</a>
            <a href="../viewjourney.php?cityid=13">Hue</a>
        </div>

        <div class="box">
            <h3>contact info</h3>
            <a href="https://github.com/socolate12345/Travel-Booking-Website">GitHub</a>
            <img src="../images/payment.png" alt="">
        </div>


    </div>

    <div class="credit">&copy;2025 VietTransit</div>

</section>

</body>
</html>