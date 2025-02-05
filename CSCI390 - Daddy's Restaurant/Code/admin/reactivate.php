<?php
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['id'])) {
        include "../database/db.php";
        $custID = $_POST['id'];
        $sql = "UPDATE customer set STATUS = 'Unblocked' WHERE ID = ? ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $custID);
        $stmt->execute();
        $stmt->close();

        $userSQL = "SELECT `FULL NAME`,EMAIL_ADDRESS from customer WHERE ID = ? ";
        $userSTMT = $conn->prepare($userSQL);
        $userSTMT->bind_param("i", $custID);
        $userSTMT->execute();
        $userResult = $userSTMT->get_result();
        $userSTMT->close();
        $row = $userResult->fetch_assoc();
        $fullName = $row['FULL NAME'];
        $email = $row['EMAIL_ADDRESS'];
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
            $mail->Subject = 'Your Account Has Been Successfully Reactivated';
            $mail->Body    = "Dear {$fullName},<br><br> Your account has been successfully reactivated. You can now log into our website and use it normally.<br> If you have any further questions or require assistance, please contact us.<br><br>Best Regards,<br>Daddy's Restaurant.";
            $mail->AltBody    = "Dear {$fullName},<br><br> We have reviewed your account and reinstated access. You can now log into our website and use it normally.<br> If you have any further questions or require assistance, please contact us.<br><br>Best Regards,<br>Daddy's Restaurant.";

            $mail->send();
        } catch (Exception $e) {
            error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Internal server error occured. Please try again.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Internal server error occured. Please try again.']);
}
