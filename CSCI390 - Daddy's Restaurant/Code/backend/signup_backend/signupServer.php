<?php
require '../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["fullName"], $_POST["email"], $_POST["phoneNumber"], $_POST["Cpassword"], $_POST["password"])) {
        $fullName   = $_POST["fullName"];
        $email      = $_POST["email"];
        $phoneNumber = $_POST["phoneNumber"];
        $Cpassword  = $_POST["Cpassword"];
        $pass       = $_POST["password"];

        define('Daddys', true);
        try {
            require_once('../../database/db.php');
            require_once('signup_model.php');
            require_once('signup_controler.php');

            $errors = [];

            if (empty($fullName)) {
                $errors['emptyName'] = "* Please Enter Your Name";
            }

            if (empty($phoneNumber)) {
                $errors['emptyPhone'] = "* Please Enter Your Phone Number";
            }
            if (empty($pass)) {
                $errors['emptyPassword'] = "* Please Enter Your Password";
            } else if (strlen($pass) < 8) {
                $errors['shortPassword'] = "* Password should have at least 8 characters";
            }

            if (isEmailInvalid($email)) {
                $errors["invalidEmail"] = "* Please Enter A Valid Email";
            }

            if (isPhoneNumberRegistered($conn, $phoneNumber)) {
                $errors["registeredPhone"] = "* The Phone Number Is Already Registered !";
            }

            if (isEmailRegistered($conn, $email)) {
                $errors["registeredEmail"] = "* The Email Address Is Already Registered !";
            }

            if (arePasswordsUnmatched($pass, $Cpassword)) {
                $errors["unmatchedPasswords"] = "* The Passwords Don't Match !";
            }

            require "../config_session.php";
            if ($errors) {
                $_SESSION["signUpErrors"] = $errors;
                $signupData = [
                    "fullName"    => $fullName,
                    "phoneNumber" => $phoneNumber,
                    "email"       => $email
                ];
                $_SESSION["signUpData"] = $signupData;
                header("Location: ../../customer/signup.php");
                die();
            } else {
                createOutDiner($conn, $fullName, $email, $phoneNumber, password_hash($pass, PASSWORD_DEFAULT));
                $newCID = getLastID($conn, $email);
                $_SESSION["loginCredentials"] = [
                    "id"          => $newCID,
                    "name"        => $fullName,
                    "email"       => $email,
                    "phoneNumber" => $phoneNumber,
                ];
                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'restaurantdaddys@gmail.com';
                    $mail->Password = 'limq bojb fudv iznw';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                    $mail->Port = 587;

                    $mail->setFrom('restaurantdaddys@gmail.com', 'Daddy\'s Restaurant');
                    $mail->addAddress($email, $fullName);

                    $mail->isHTML(true);
                    $mail->Subject = 'Signup Successful!';
                    $mail->Body    = "Hello {$fullName},<br><br>Thank you for signing up with us. Your account has been successfully created!<br><br>Best regards,<br>Daddy's Restaurant";
                    $mail->AltBody = "Hello {$fullName},\n\nThank you for signing up with us. Your account has been successfully created!\n\nBest regards,\nDaddy's Restaurant";

                    $mail->send();
                } catch (Exception $e) {
                    error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
                }

                header("Location: ../../customer/cart.php");
                die();
            }
            $conn = null;
            $stmt = null;
            die();
        } catch (PDOException $e) {
            die("Query Failed: " . $e->getMessage());
        }
    } else {
        header("Location: ../../customer/signup.php");
        die();
    }
} else {
    header("Location: ../../customer/signup.php");
    die();
}
