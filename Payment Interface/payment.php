<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    header("Location: success.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
    <link rel="shortcut icon" href="download.png">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #78C7D4, #005273);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .travel-content {
            position: absolute;
            left: 0;
            width: 40%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 20px;
        }

        .card-container {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 300px;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0px -5px 15px rgba(0, 0, 0, 0.2);
            height: 100vh;
            opacity: 0;
            transform: translateY(100%);
            transition: transform 0.5s, opacity 0.5s;
        }

        .card {
            padding: 20px;
        }

        .payment-button {
            text-align: center;
        }

        .payment-button button {
            background-color: #6064b6;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .payment-button button:hover {
            background-color: #48508f;
        }
    </style>
</head>
<body>
    <div class="travel-content">
        <h3>Your adventure awaits! Complete your payment to confirm your booking.</h3>
    </div>

    <div class="card-container">
        <div class="card">
            <h2>Scan to Pay</h2>
            <img src="../images/Screenshot238.png" alt="QR Code" style="max-width: 100%;">
            <img src="../images/QR_Code.jpg" alt="QR Code" style="max-width: 100%;">

            <form method="POST">
                <div class="payment-button">
                    <button type="submit">Payment Done</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const cardContainer = document.querySelector(".card-container");
            cardContainer.style.transform = "translateY(0)";
            cardContainer.style.opacity = "1";
        });
    </script>
</body>
</html>

