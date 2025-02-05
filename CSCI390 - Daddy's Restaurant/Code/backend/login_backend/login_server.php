<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['phoneNumber']) && isset($_POST['password'])) {
        $phoneNumber = trim($_POST['phoneNumber']);
        $password = $_POST['password'];

        require_once('../../database/db.php');
        require_once('login_model.php');
        require_once('login_controler.php');
        $errors = [];
        $person;

        $person = getPerson($conn, $phoneNumber);
        $role = getRole($conn, $phoneNumber);
        if (userDoesNotExist($person) || arePasswordsNotMatching($password, $person['PASSWORD'])) {
            $errors['wrongCredentials'] = "* Incorrect Username Or Password";
        } else if ($role == "User") {
            if (isPersonBlocked($person['STATUS'])) {
                $errors['blockedPerson'] = "* This account is blocked, contact the administrators if you think this is a mistake.";
            }
        }
    }
    require "../config_session.php";
    if (!$errors) {
        $role = getRole($conn, $phoneNumber);
        if ($role == "User") {
            $_SESSION["loginCredentials"] = [
                "id" => $person["ID"],
                "name" => $person["FULL NAME"],
                "email" => $person["EMAIL_ADDRESS"],
                "phoneNumber" => $person['PHONE_NUMBER'],
            ];
            if (!empty($person['ADDRESS'])) {
                $_SESSION['loginCredentials']['address'] = $person['ADDRESS'];
            }
            header("Location: ../../customer/cart.php");
        }
        if ($role == "Admin") {
            $loginCredentials = [
                "username" => $person["USERNAME"],
                "email" => $person["EMAIL_ADDRESS"],
                "phoneNumber" => $person['PHONE_NUMBER'],
            ];
            $_SESSION['adminLoginCredentials'] = $loginCredentials;
            header("Location: ../../admin/index.php");
        }
    } else {
        $_SESSION['logInErrors'] = $errors;
        header('Location: ../../customer/login.php');
    }
    session_write_close();
    $conn = null;
} else {
    header("Location: ../../customer/login.php");
    die();
}
