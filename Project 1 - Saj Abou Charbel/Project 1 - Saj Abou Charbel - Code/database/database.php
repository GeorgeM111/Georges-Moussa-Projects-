<?php
$serverName = "localhost";
$serverUsername = "root";
$databasePassword = "";
$databaseName = "sajaboucharbel";

$connection = new mysqli($serverName,$serverUsername,$databasePassword,$databaseName);

if(!$connection){
    echo "Connection Error";
}