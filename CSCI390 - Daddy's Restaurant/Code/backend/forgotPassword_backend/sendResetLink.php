<?php
require '../../vendor/autoload.php';
require '../../database/db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function generateResetToken($email, $conn)
{
    date_default_timezone_set('Asia/Beirut');
    $token = bin2hex(random_bytes(4));
    $expiry = date("Y-m-d H:i:s", time() + 3600);

    $stmt = $conn->prepare("UPDATE customer SET RESET_TOKEN=?, TOKEN_EXPIRY=? WHERE EMAIL_ADDRESS=?");
    $stmt->bind_param("sss", $token, $expiry, $email);
    $stmt->execute();
    return $token;
}


function getFullName($email, $conn)
{
    $stmt = $conn->prepare("SELECT `FULL NAME` FROM customer WHERE EMAIL_ADDRESS=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $fullName = $result->fetch_assoc();
    return $fullName;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];
        if (getFullName($email, $conn)) {
            $token = generateResetToken($email, $conn);
            $fullName = getFullName($email, $conn);
            $fullName = $fullName['FULL NAME'];
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
                $mail->Subject = 'Password Reset Request';
                $mail->Body = "Dear $fullName,<br><br>
    
    We have received a request to reset your password. Please use the token below to proceed with resetting your password.<br><br>
    
    Password Reset Token: $token <br>
    
    If you did not request a password reset or have any concerns, please contact us immediately.<br><br>
    
    Thank you, Daddy's Restaurant.";
                $mail->AltBody = "This is your password reset token: $token";

                $mail->send();
            } catch (Exception $e) {
                error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
            }
        }
        header("Location: ../../customer/tokenVerification.php");
    } else {
        header("Location: ../../customer/forgotPassword.php");
    }
} else {
    header("Location: ../../customer/forgotPassword.php");
}
