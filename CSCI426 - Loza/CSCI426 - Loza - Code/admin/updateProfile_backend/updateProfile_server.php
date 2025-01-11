<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['oPswd']) && isset($_POST['nPswd']) && isset($_POST['cPswd'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $oPswd = $_POST['oPswd'];
        $nPswd = $_POST['nPswd'];
        $cPswd = $_POST['cPswd'];
        session_start();
        if (empty($username)) { //if the user emptied the username and just wanted to change their passwords
            $username = $_SESSION['adminLoginCredentials']['Username'];
        }
        if (empty($email)) { //if the user emptied the email and just wanted to change their passwords
            $email = $_SESSION['adminLoginCredentials']['Email'];
        }
        define('LOZA', true);
        require_once("../../Database/db.php");
        require_once("updateProfile_model.php");
        require_once("updateProfile_controler.php");

        $errors = [];
        $databasePassword = retrieveDatabasePassword($conn, $_SESSION['adminLoginCredentials']['Username'])['password'];
        if (areOldPasswordsNotMatching($oPswd, $databasePassword)) {
            $errors['badOldPass'] = "* Incorrect Password";
        }
        if (isUsernameInvalid($username)) {
            $errors['invalidUsername'] = "* Username doesn't meet the listed criteria";
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

        if ($username != $_SESSION['adminLoginCredentials']['Username']) { //If the user changed the username
            $dbUsername = getUsername($conn, $username);
            if (isUsernameTaken($dbUsername)) {
                $errors['takenUsername'] = "* This Username is already registered";
            }
        }

        if ($email != $_SESSION['adminLoginCredentials']['Email']) { //If the user changed the email
            $dbEmail = getEmail($conn, $email);
            if (isEmailTaken($dbEmail)) {
                $errors['takenEmail'] = "* This Email is already registered";
            }
        }

        if (!$errors) {
            if (($username != $_SESSION['adminLoginCredentials']['Username'] || $email != $_SESSION['adminLoginCredentials']['Email'])) {
                if (!(empty($cPswd) && empty($nPswd))) {
                    updateDate($conn, $_SESSION['adminLoginCredentials']['Username']);
                    updatePassword($conn, $nPswd, $_SESSION['adminLoginCredentials']['Username']);
                }
                updateDate($conn, $_SESSION['adminLoginCredentials']['Username']);
                updateEmail($conn, $email, $_SESSION['adminLoginCredentials']['Username']);
                updateUsername($conn, $username, $_SESSION['adminLoginCredentials']['Username']);
            }
            else if (($username == $_SESSION['adminLoginCredentials']['Username'] && $email == $_SESSION['adminLoginCredentials']['Email'])) {
                if (!(empty($cPswd) && empty($nPswd))) {
                    updatePassword($conn, $nPswd, $_SESSION['adminLoginCredentials']['Username']);
                    $_SESSION['success'] = "Profile Updated Successfully";
                    header("Location: ../Profile.php");
                }
            }
            $_SESSION['adminLoginCredentials']['Email'] = $email;
            $_SESSION['adminLoginCredentials']['Username'] = $username;
            $_SESSION['success'] = "Profile Updated Successfully";
            header("Location: ../Profile.php");
            
        } else if ($errors) {
            $_SESSION['updateProfileErrors'] = $errors;
            header("Location:../Profile.php");
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
