<?php 
if($_SERVER['REQUEST_METHOD'] == "POST"){
session_start();
unset($_SESSION['adminLoginCredentials']);
session_destroy();
header('Location: ../');
die();
}else{
header('Location: ../');
die();
}