<?php
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['deletePassword']) && isset($_POST['cDeletePassword'])) {
        if (isset($_POST['understand']) && $_POST['understand'] === "on") {
            $deletePassword = $_POST['deletePassword'];
            $cDeletePassword = $_POST['cDeletePassword'];
            if ($deletePassword !== $cDeletePassword) {
                echo json_encode(['success' => false, 'error' => 'Passwords Don\'t Match, Try Again']);
            } else {
                require_once "../backend/config_session.php";
                $id = $_SESSION['loginCredentials']['id'];
                $fullName = $_SESSION['loginCredentials']['name'];
                $email = $_SESSION['loginCredentials']['email'];
                include "../database/db.php";

                $sql = "SELECT PASSWORD FROM customer WHERE ID = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                $stmt->close();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $dbPass = $row['PASSWORD'];

                    if (password_verify($deletePassword, $dbPass)) {
                        $sql2 = "UPDATE customer SET STATUS='Deleted' WHERE ID = ?";
                        $stmt2 = $conn->prepare($sql2);
                        $stmt2->bind_param("i", $id);
                        $stmt2->execute();
                        $stmt2->close();

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
                            $mail->Subject = 'Account Deletion';
                            $mail->Body = "Hello {$fullName},<br><br> We hope that you enjoyed your experience on our website!<br> We wanted to inform you that your account has been deleted!<br> Please contact us if you think this is a mistake!<br><br>Best regards,<br>Daddy's Restaurant";
                            $mail->AltBody = "Hello {$fullName},<br><br> We hope that you enjoyed your experience on our website!<br> We wanted to inform you that your account has been deleted!<br> Please contact us if you think this is a mistake!<br><br>Best regards,<br>Daddy's Restaurant";

                            $mail->send();
                        } catch (Exception $e) {
                            error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
                        }
                        echo json_encode(['success' => true]);
                        exit;
                    } else {
                        echo json_encode(['success' => false, 'error' => 'Incorrect Passwords, Try Again']);
                    }
                } else {
                    echo json_encode(['success' => false, 'error' => 'User not found, Try Again']);
                }
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Please agree to continue.']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid Inputs, Try again']);
    }
} else {
    echo json_encode(['success' => false]);
}
