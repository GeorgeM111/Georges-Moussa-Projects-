<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['phNb']) && isset($_POST['address']) && isset($_POST['company']) && isset($_POST['email']) && isset($_POST['opassword']) && isset($_POST['password']) && isset($_POST['cpassword'])) {
        $phNb = $_POST['phNb'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $company = $_POST['company'];
        $oPswd = $_POST['opassword'];
        $nPswd = $_POST['password'];
        $cPswd = $_POST['cpassword'];
        session_start();
        if (empty($phNb)) { //if the user emptied the username and just wanted to change their passwords
            $phNb = $_SESSION['loginCredentials']['Phone'];
        }
        if (empty($email)) { //if the user emptied the email and just wanted to change their passwords
            $email = $_SESSION['loginCredentials']['Email'];
        }
        if (empty($company)) { //if the user emptied the company and just wanted to change their passwords
            $email = $_SESSION['loginCredentials']['Company'];
        }
        if (empty($address)) { //if the user emptied the address and just wanted to change their passwords
            $email = $_SESSION['loginCredentials']['Address'];
        }
        define('LOZA', true);
        require_once("../../Database/db.php");
        require_once("updateProfile_model.php");
        require_once("updateProfile_controler.php");

        $errors = [];
        $databasePassword = retrieveDatabasePassword($conn, $_SESSION['loginCredentials']['Email'])['password'];
        if (areOldPasswordsNotMatching($oPswd, $databasePassword)) {
            $errors['badOldPass'] = "* Incorrect Password";
        }

        if ($phNb != $_SESSION['loginCredentials']['Phone']) { //If the user changed the $phoneNumber
            $dbPhnb = getPhoneNumber($conn, $phNb);
            if (isEmailRegistered($dbPhnb)) {
                $errors['takenPhnb'] = "* This phone number is already registered";
            }
        }

        if (!empty($nPswd)) {
            if (areNewPasswordsNotMatching($nPswd, $cPswd)) {
                $errors['badNewPass'] = "* The New Passwords do not match";
            }
            if (isNewPasswordUnchanged($nPswd, $databasePassword)) {
                $errors['unchangedPass'] = "* You can not use your current password";
            }
            if (isPassWordInvalid($nPswd)) {
                $errors['invalidPassword'] = "* Password doesn't meet the listed criteria";
            }
        }
        if ($email != $_SESSION['loginCredentials']['Email']) { //If the user changed the email
            $dbEmail = getEmail($conn, $email);
            if (isEmailRegistered($dbEmail)) {
                $errors['takenEmail'] = "* This Email is already registered";
            }
        }
        if (isEmailInvalid($email)) {
            $errors['invalidEmail'] = "* Please Enter a valid email";
        }

        if (!$errors) {
            if (!(empty($cPswd) && empty($nPswd))) {
                updatePassword($conn, $nPswd, $_SESSION['loginCredentials']['Email']);
            }
            if (($phNb != $_SESSION['loginCredentials']['Phone'] || $email != $_SESSION['loginCredentials']['Email'] || $company != $_SESSION['loginCredentials']['Company'] || $address != $_SESSION['loginCredentials']['Address'])) {
                updateCompany($conn, $company, $_SESSION['loginCredentials']['Email']);
                updateAddress($conn, $address, $_SESSION['loginCredentials']['Email']);
                updateEmail($conn, $email, $_SESSION['loginCredentials']['Email']);
                updatePhoneNumber($conn, $phNb, $_SESSION['loginCredentials']['Phone']);
            }
            $_SESSION['loginCredentials']['Email'] = $email;
            $_SESSION['loginCredentials']['Phone'] = $phNb;
            $_SESSION['loginCredentials']['Company'] = $company;
            $_SESSION['loginCredentials']['Address'] = $address;
            $_SESSION['success'] = "Profile Updated Successfully";
            header("Location: ../Profile.php");
        } else if ($errors) {
            $_SESSION['updateProfileErrors'] = $errors;
            header("Location: ../Profile.php");
        }
        session_write_close();
        $conn = null;
        die();
    } else {
        header("Location: ../Profile.php");
        die();
    }
} else {
    header("Location: ../"); //Deny URL access
    die();
}
