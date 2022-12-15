<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

date_default_timezone_set('Asia/Manila');
$datetime = date('Y-m-d h:i:s', time());
$date = date('Y-m-d');
$time = date('H:i', time());

$host = "localhost";
$username = "root";
$password = "";
$database = "mccp_db";

// For web hosting
//  $host = "localhost";
//  $username = "admin";
//  $password = "Swks7OsM6IbW";
//  $database = "mccp_db";   


define('home', 'http://localhost:8080/mccp');

//  define('home', 'https://motherchildcareportal.com');  //Web


$con = mysqli_connect($host, $username, $password, $database);

if (!$con) {
    die("Database Connection failed: " . mysqli_connect_error());
}
?>