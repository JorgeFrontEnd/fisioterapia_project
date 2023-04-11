<?php
session_start();

$servername = "localhost";
$username = "id20566637_fisioterapia_";
$password = "2142001jR!!!";
$dbname = "id20566637_fisioterapia";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}