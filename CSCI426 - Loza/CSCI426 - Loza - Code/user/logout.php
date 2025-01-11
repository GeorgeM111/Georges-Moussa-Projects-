<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    session_start();
    unset($_SESSION['loginCredentials']);
    session_destroy();
    header('Location: home.php');
    die();
} else {
    header('Location: home.php');
    die();
}
