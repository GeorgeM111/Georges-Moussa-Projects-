<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    session_start();
    $_SESSION['checkout'] = "checkout";
    header("Location: login.php");
    session_write_close();
}else{
    header("Location: cart.php");
}