<?php
$servername = "localhost"; // e.g. localhost(when hosting on your local machine)
$username = "user"; // username of listed user in the database
$password = "12345"; // password of the above user in the database
$dbname="portfolio-website-builder"; //database name of your database

// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>