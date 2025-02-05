<?php
    require_once "../backend/config_session.php";
    unset($_SESSION['loginCredentials']);
    session_destroy();
    header('Location: home.php');
    die();

