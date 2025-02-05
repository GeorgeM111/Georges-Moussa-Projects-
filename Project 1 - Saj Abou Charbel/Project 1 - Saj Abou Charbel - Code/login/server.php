<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = trim($_POST['username']);
        $password = $_POST['password'];

        require_once('../database/database.php');
        require_once('model.php');
        require_once('controler.php');
        $errors = [];
        $person;
        if (empty($username)) {
            $errors['usernameEmpty'] = "* Please Enter your Username";
        }
        if (empty($password)) {
            $errors['passwordEmpty'] = "* Please Enter your Password";
        } else {
            $person = getPerson($connection, $username);
            if (userDoesNotExist($person) || arePasswordsNotMatching($password, $person['password'])) {
                $errors['wrongCredentials'] = "* Incorrect Username Or Password";
            }
        }

        session_start();
        if (!$errors) {
            $loginCredentials = [
                "id" => $person["id"],
                "username" => $person["username"],
            ];
            if (isset($_POST['remember']) && $_POST['remember'] === 'on') {
                $credentialsJson = json_encode($loginCredentials);
                setcookie("loginCredentials", $credentialsJson, time() + 30 * 24 * 60 * 60, "/");
            }else{
                $credentialsJson = json_encode($loginCredentials);
                setcookie("loginCredentials", $credentialsJson, time() + 7200, "/");   
            }
            header("Location: ../admin/index.php");
        } else {
            $_SESSION['logInErrors'] = $errors;
            session_write_close();
            header('Location: ../login');
        }
        $conn = null;
    } else {
        header("Location: ../");
        die();
    }
} else {
    header("Location: ../");
    die();
}
?>
