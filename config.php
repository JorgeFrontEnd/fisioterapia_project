<?php
session_start();

$servername = "localhost";
//$username = "id20566637_fisioterapia_";
$username = "root";
$password = "";
//$password = "Sg\\R(3Qe4@tvKg{";
//$dbname = "yid20566637_fisioterapia";
$dbname = "fisioterapia";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
