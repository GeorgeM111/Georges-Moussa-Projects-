<?php
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include "../database/db.php";
require_once "../backend/config_session.php";
if (isset($_POST['email']) && isset($_POST['emailPassword'])) {
    $email = $_POST['email'];
    $id = $_SESSION['loginCredentials']['id'];
    $emailPassword = $_POST['emailPassword'];

    $sql = "SELECT PASSWORD FROM customer WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    $sql2 = "SELECT EMAIL_ADDRESS FROM customer WHERE EMAIL_ADDRESS = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("s", $email);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    $stmt2->close();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $dbPass = $row['PASSWORD'];

        if (password_verify($emailPassword, $dbPass)) {
            if ($email === $_SESSION['loginCredentials']['email']) {
                echo json_encode(['success' => false, 'error' => 'You can\'t use your current email']);
            } else if ($result2->num_rows > 0) {
                echo json_encode(['success' => false, 'error' => 'Email is already registered']);
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode(['success' => false, 'error' => 'Enter a valid email']);
            } else {
                $emailSQL = "UPDATE customer SET EMAIL_ADDRESS = ? WHERE ID = ?";
                $emailSTMT = $conn->prepare($emailSQL);
                $emailSTMT->bind_param("si", $email, $id);
                $emailSTMT->execute();
                $emailSTMT->close();
                $_SESSION['loginCredentials']['email'] = $email;
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
                    $mail->addAddress($email);

                    $mail->isHTML(true);
                    $mail->Subject = 'Email Modification';
                    $mail->Body = "Hello,<br><br>
                            We hope you're doing well!<br>
                            We wanted to inform you that an account's email has been updated to this address.<br>
                            If you believe this was a mistake, please contact us immediately.<br><br>
                            Best regards,<br>
                            Daddy's Restaurant";
                    $mail->Body = "Hello,<br><br>
                            We hope you're doing well!<br>
                            We wanted to inform you that an account's email has been updated to this address.<br>
                            If you believe this was a mistake, please contact us immediately.<br><br>
                            Best regards,<br>
                            Daddy's Restaurant";

                    $mail->send();
                } catch (Exception $e) {
                    error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
                }
                echo json_encode(['success' => true]);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Incorrect Password']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'User not found']);
    }
} else if (isset($_POST['phone']) && isset($_POST['phonePassword'])) {
    $phone = $_POST['phone'];
    $id = $_SESSION['loginCredentials']['id'];
    $phonePassword = $_POST['phonePassword'];

    $sql = "SELECT PASSWORD FROM customer WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    $sql2 = "SELECT PHONE_NUMBER FROM customer WHERE PHONE_NUMBER = ?";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("s", $phone);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    $stmt2->close();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $dbPass = $row['PASSWORD'];

        if (password_verify($phonePassword, $dbPass)) {
            if ($phone === $_SESSION['loginCredentials']['phoneNumber']) {
                echo json_encode(['success' => false, 'error' => 'You can\'t use your current phone number']);
            } else if ($result2->num_rows > 0) {
                echo json_encode(['success' => false, 'error' => 'Phone number is already registered']);
            } else {
                $phoneSQL = "UPDATE customer SET PHONE_NUMBER = ? WHERE ID = ?";
                $phoneSTMT = $conn->prepare($phoneSQL);
                $phoneSTMT->bind_param("si", $phone, $id);
                $phoneSTMT->execute();
                $phoneSTMT->close();
                $_SESSION['loginCredentials']['phoneNumber'] = $phone;
                echo json_encode(['success' => true]);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Incorrect Password']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'User not found']);
    }
} else if (isset($_POST['address']) && isset($_POST['addressPassword'])) {
    $address = $_POST['address'];
    $id = $_SESSION['loginCredentials']['id'];
    $addressPassword = $_POST['addressPassword'];

    $sql = "SELECT PASSWORD FROM customer WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $dbPass = $row['PASSWORD'];

        if (password_verify($addressPassword, $dbPass)) {
            if (isset($_SESSION['loginCredentials']['address']) && $address === $_SESSION['loginCredentials']['address']) {
                echo json_encode(['success' => false, 'error' => 'You can\'t use your current address']);
            } else {
                $addressSQL = "UPDATE customer SET ADDRESS = ? WHERE ID = ?";
                $addressSTMT = $conn->prepare($addressSQL);
                $addressSTMT->bind_param("si", $address, $id);
                $addressSTMT->execute();
                $addressSTMT->close();
                $_SESSION['loginCredentials']['address'] = $address;
                echo json_encode(['success' => true]);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Incorrect Password']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'User not found']);
    }
} else if (isset($_POST['oldPassword']) && isset($_POST['newPassword']) && isset($_POST['confirmPassword'])) {
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];
    $id = $_SESSION['loginCredentials']['id'];

    $sql = "SELECT PASSWORD FROM customer WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $dbPass = $row['PASSWORD'];

        if (password_verify($oldPassword, $dbPass)) {
            if (strlen($newPassword) >= 8) {
                if ($newPassword === $confirmPassword) {
                    if (!password_verify($newPassword, $dbPass)) {
                        $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);
                        $passwordSQL = "UPDATE customer SET PASSWORD = ? WHERE ID = ?";
                        $passwordSTMT = $conn->prepare($passwordSQL);
                        $passwordSTMT->bind_param("si", $hashed_password, $id);
                        $passwordSTMT->execute();
                        $passwordSTMT->close();
                        echo json_encode(['success' => true]);
                    } else {
                        echo json_encode(['success' => false, 'error' => 'You can\'t Use Your Old Password !']);
                    }
                } else {
                    echo json_encode(['success' => false, 'error' => 'New Passwords Don\'t Match']);
                }
            } else {
                echo json_encode(['success' => false, 'error' => 'Password Should Have At Least 8 Characters']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Incorrect Password']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'User not found']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid input']);
}

session_write_close();
