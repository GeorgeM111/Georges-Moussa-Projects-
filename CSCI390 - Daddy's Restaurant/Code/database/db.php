<?php
define('servername', 'localhost');
define('username', 'root');
define('dbName', 'droms');
define('serverPassword', '');

$conn = new mysqli(servername, username, serverPassword, dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
