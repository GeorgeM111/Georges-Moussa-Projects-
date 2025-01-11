<?php
// This php file will handle the overall login process
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['nameEmail']) && isset($_POST['pass'])) {
        $nameEmail = trim($_POST['nameEmail']);
        $pass = $_POST['pass'];
        define('LOZA', true);
        require_once('../../Database/db.php');
        require_once('login_model.php');
        require_once('login_controler.php');
        $errors = [];
        $person;
        if (isNameEmailEmpty($nameEmail)) {
            $errors['nameEmailEmpty'] = "Please Enter your Username / Email";
        }
        if (isPasswordEmpty($pass)) {
            $errors['passwordEmpty'] = "Please Enter your Password";
        } else {
            $person = getPerson($conn, $nameEmail);
            if (userDoesNotExist($person)) {
                $errors['noUser'] = "This User Does Not Exist";
            } else {
                if (arePasswordsNotMatching($pass, $person['password'])) {
                    $errors['badPass'] = "Incorrect Password";
                } else {
                    $role = getRole($conn, $nameEmail);
                    if ($role == "Customer" && $person["Status"] == "Blocked") {
                        $errors['blockedCustomer'] = "This user is blocked, contact the Administration if you think this is a mistake.";
                    }
                }
            }
            if (!userDoesNotExist($person) && $role == "User") { //To prevent login with no capitalLetters
                if ($nameEmail != $person['username']) {
                    $errors['noUser'] = "This User Does Not Exist";
                }
            }
        }
        session_start();
        if (!$errors) {
            $role = getRole($conn, $nameEmail);
            if ($role == "Customer") {
                $loginCredentials = [
                    "id" => $person["CID"],
                    "Name" => ucwords($person['fname'] . " " . $person['mname'] . " " . $person['lname']),
                    "fName" => $person['fname'],
                    "mName" => $person['mname'],
                    "lName" => $person['lname'],
                    "Email" => $person["email"],
                    "Address" => $person['address'],
                    "Phone" => $person['Phone'],
                    "Company" => $person['company'],
                ];
                $_SESSION['loginCredentials'] = $loginCredentials;
                header("Location: ../cart.php");
            }
            if ($role == "User") {
                $position = getAdminPosition($person);
                if ($position == "Admin") {
                    $adminLoginCredentials = [
                        "Username" => $person["username"],
                        "Email" => $person["email"],
                        "ID" => $person['id'],
                    ];
                    $_SESSION['adminLoginCredentials'] = $adminLoginCredentials;
                    header("Location: ../../admin/");
                }
                if ($position == "Assistant") {
                    $assistantLoginCredentials = [
                        "Username" => $person["username"],
                        "Email" => $person["email"],
                    ];
                    $_SESSION['assistantLoginCredentials'] = $assistantLoginCredentials;
                    header("Location: ../../assistant/");
                }
            }
        } else {
            $_SESSION['logInErrors'] = $errors;
            $_SESSION['loginErrData'] = $nameEmail;
            header('Location: ../login.php');
        }
        $conn = null;
    } else {
        header("Location: ../login.php");
        die();
    }
} else {
    header("Location: ../login.php");
    die();
}
