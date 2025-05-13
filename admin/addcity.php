<?php
include '../dbconnect.php';

// Initialize variables for journey data
$city = $region = $season = $days = $cost = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve journey data from the form if available
    $city = isset($_POST["city"]) ? $_POST["city"] : "";
    $region = isset($_POST["region"]) ? $_POST["region"] : "";
    $season = isset($_POST["season"]) ? $_POST["season"] : "";
    $days = isset($_POST["days"]) ? $_POST["days"] : "";
    $cost = isset($_POST["cost"]) ? $_POST["cost"] : "";

    // Prepare a SQL statement to insert the journey
    $sql = "INSERT INTO cities (city, region, season, days, cost) VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sssid", $city, $region, $season, $days, $cost);

        if ($stmt->execute()) {
            // Insertion was successful
            echo "Journey added successfully. <a href='adminviewcity.php'>Back to journeys</a>";
            header("location: adminviewcity.php");
        } else {
            // Error occurred during insertion
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error in the prepared statement: " . $conn->error;
    }
} 

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/addjourney.css">
    <title>Admin - Add Journey</title>
    <style>
        body {
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed; /* Ensures the image doesn't scroll with the content */
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>
    <form method="post" action="addjourney.php">
        <h2>Add Journey </h2><hr weight="4px">
        <label for="city">City:</label>
        <input type="text" id="city" name="city" placeholder="City"><br><br>

        <label for="region">Region:</label>
        <input type="text" id="region" name="region" placeholder="Region"><br><br>

        <label for="season">Season:</label>
        <input type="text" id="season" name="season" placeholder="Season"><br><br>

        <label for="days">Days:</label>
        <input type="number" id="days" name="days" placeholder="Days"><br><br>

        <label for="cost">Cost:</label>
        <input type="number" id="cost" name="cost" placeholder="Cost"><br><br>

        <input type="submit" value="Add Journey">
        <a href="adminviewcity.php" style="margin-left: 15px;">Cancel</a>
    </form>
</body>
</html>
