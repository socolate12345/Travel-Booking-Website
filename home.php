<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Travelscapes </title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="stylesheet" href="./css/style.css">
    </head>
<body>

<header>

    <input type="checkbox" name="" id="toggler">
    <label for="toggler" class="fas fa-bars"></label>

    <a href="#" class="logo"><span>Travelscapes</span></a>

    <nav class="navbar">
        <a href="#home">Home</a>
        <a href="#about">About</a>
        <a href="#products">Places</a>
        <a href="#review">Review</a>
        <a href="./Login/login.php">Login/Signup</a>
        <a href="./admin/adminlogin.php">Admin</a>
    </nav>

    <div class="icons">
        <span data-tooltip="Favourites" data-flow="top"> <a href="./Login/login.php" class="fas fa-heart"></a></span>
        <span data-tooltip="Cart" data-flow="top"> <a href="./Payment Interface/receiptlist.php" class="fas fa-shopping-cart"></a></span>
        <span data-tooltip="Profile" data-flow="top"> <a href="./Login/login.php" class="fas fa-user"></a></span>
    </div>

</header>

<section class="home" id="home">

    <div class="content">
        <span> Incredible Vietnam: </span>
        <p>Where Every Place is a Story, Every Journey an Adventure.</p>
        <a href="#products" class="btn">Travel Now</a>
    </div>

</section>


<section class="about" id="about">

    <h1 class="heading"> <span> about </span> us </h1>

    <div class="row">

        <div class="video-container">
            <video src="./images/about-vid.mp4" loop autoplay muted></video>
            <h3>Best Places</h3>
        </div>

        <div class="content">
            <h3>why choose us?</h3>
<p> What truly sets us apart is our deep understanding of travel within Vietnam and our unwavering dedication to your satisfaction. Whether you're planning a peaceful retreat to Da Lat, a beach escape in Phu Quoc, or a cultural adventure in Hanoi and Hue, our 24/7 local support team is always here to help. We offer competitive prices and exclusive deals on top Vietnamese destinations, making your journey affordable and unforgettable. When you choose our travel website, you're not just booking a trip — you're joining a community that values authentic experiences and hassle-free service. Let us take care of the details, so you can focus on discovering the beauty of Vietnam.</p>
            <a href="#review" class="btn">learn more</a>
        </div>

    </div>

</section> 

<section class="icons-container">

    <div class="icons">
        <img src="./images/icon-1.png" alt="">
        <div class="info">
            <h3>free booking</h3>
            <span>on all orders</span>
        </div>
    </div>

    <div class="icons">
        <img src="./images/icon-2.png" alt="">
        <div class="info">
            <h3>10 days returns</h3>
            <span>moneyback guarantee</span>
        </div>
    </div>

    <div class="icons">
        <img src="./images/icon-3.png" alt="">
        <div class="info">
            <h3>offer & gifts</h3>
            <span>on all orders</span>
        </div>
    </div>

    <div class="icons">
        <img src="./images/icon-4.png" alt="">
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
                <img src="./images/taybac.jpg" alt="">
                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="./Login/login.php" class="cart-btn">Visit Us</a>
                    <a href="./Login/login.php" class="fas fa-share"></a>
                </div>
            </div>
            <div class="content">
                <h3>Tay Bac</h3>
                <div class="price">8.199.000 VNĐ</div>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="./images/hcm.jpg" alt="">
                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="./Login/login.php" class="cart-btn">Visit Us</a>
                    <a href="./Login/login.php" class="fas fa-share"></a>
                </div>
            </div>
            <div class="content">
                <h3>Ho Chi Minh</h3>
                <div class="price">5.900.000 VNĐ</div>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="./images/nhatrang.jpg" alt="">
                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="./Login/login.php" class="cart-btn">Visit Us</a>
                    <a href="./Login/login.php" class="fas fa-share"></a>
                </div>
            </div>
            <div class="content">
                <h3>Nha Trang</h3>
                <div class="price">6.750.000 VNĐ </div>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="./images/hue.jpg" alt="">
                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="./Login/login.php" class="cart-btn">Visit Us</a>
                    <a href="./Login/login.php" class="fas fa-share"></a>
                </div>
            </div>
            <div class="content">
                <h3>Hue</h3>
                <div class="price">8.000.000 VNĐ </div>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="./images/phuyen.jpg" alt="">
                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="./Login/login.php" class="cart-btn">Visit Us</a>
                    <a href="./Login/login.php" class="fas fa-share"></a>
                </div>
            </div>
            <div class="content">
                <h3>Phu Yen</h3>
                <div class="price">6.520.000 VNĐ</div>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="./images/dalat.jpg" alt="">
                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="./Login/login.php" class="cart-btn">Visit Us</a>
                    <a href="./Login/login.php" class="fas fa-share"></a>
                </div>
            </div>
            <div class="content">
                <h3>Da Lat</h3>
                <div class="price">4.250.000 VNĐ</div>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="./images/phuquoc.jpg" alt="">
                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="./Login/login.php" class="cart-btn">Visit Us</a>
                    <a href="./Login/login.php" class="fas fa-share"></a>
                </div>
            </div>
            <div class="content">
                <h3>Phu Quoc</h3>
                <div class="price">7.790.000 VNĐ</div>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="./images/hoian.jpg" alt="">
                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="./Login/login.php" class="cart-btn">Visit Us</a>
                    <a href="./Login/login.php" class="fas fa-share"></a>
                </div>
            </div>
            <div class="content">
                <h3>Hoi An</h3>
                <div class="price">6.690.000 VNĐ</div>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="./images/hagiang.jpg" alt="">
                <div class="icons">
                    <a href="#" class="fas fa-heart"></a>
                    <a href="./Login/login.php" class="cart-btn">Visit Us</a>
                    <a href="./Login/login.php" class="fas fa-share"></a>
                </div>
            </div>
            <div class="content">
                <h3>Ha Giang</h3>
                <div class="price">8.990.000 VNĐ</div>
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
        <p>Booking my dream trip to the stunning landscapes of Tây Bắc with Travelscapes was a breeze – seamless and stress-free! </p>
        <div class="user">
            <img src="./images/pic-1.jpg" alt="atharva pfp">
            <div class="user-info">
                <h3>Atharva</h3>
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
            <img src="./images/pic-2.png" alt="Yash pfp">
            <div class="user-info">
                <h3>Pretty</h3>
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
            <img src="./images/pic-3.jpg" alt="Tejas pfp">
            <div class="user-info">
                <h3>Tejas</h3>
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
            <a href="Login/login.php">My account</a>
            <a href="Login/receiptlist.php">My List</a>
            <a href="Login/login.php">My favorite</a>
        </div>

        <div class="box">
            <h3>Popular Travel Locations</h3>
            <a href="Login/login.php">Tay Bac</a>
            <a href="Login/login.php">Ho Chi Minh</a>
            <a href="Login/login.php">Phu Quoc</a>
            <a href="Login/login.php">Hue</a>
        </div>

        <div class="box">
            <h3>contact info</h3>
            <a href="https://github.com/socolate12345/Travel-Booking-Website">GitHub</a>
            <img src="./images/payment.png" alt="">
        </div>
    </div>

    <div class="credit">&copy;2025 Travel Booking Website</div>

</section>

</body>
</html>
