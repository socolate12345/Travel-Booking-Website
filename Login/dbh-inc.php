<?php

$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "123456";
$dbName = "travelscapes";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

if(!$conn){
    die("Connection falied: ". mysqli_connect_error());
}