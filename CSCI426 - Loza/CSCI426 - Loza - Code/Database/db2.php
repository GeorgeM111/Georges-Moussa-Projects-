<?php
$servername = "sql101.infinityfree.com";
$username = "if0_36126210";
$password = "rcEYBAT6gi";
$dbname = "if0_36126210_loza";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>