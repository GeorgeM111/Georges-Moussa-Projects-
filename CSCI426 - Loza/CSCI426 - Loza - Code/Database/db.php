<?php
$servername = "localhost";
$serverUsername = "root";
$dbpassword = "";
$dbname = "loza";

// Create connection
$conn = new mysqli($servername, $serverUsername, $dbpassword, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>