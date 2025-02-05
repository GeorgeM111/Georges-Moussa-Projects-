<?php
require "../../database/db.php";
function verifyToken($token, $conn)
{
    $stmt = $conn->prepare("SELECT ID FROM customer WHERE RESET_TOKEN=?");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    if ($result->num_rows > 0) {
        $stmt2 = $conn->prepare("SELECT ID FROM customer WHERE TOKEN_EXPIRY > NOW()");
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        $stmt2->close();
        if ($result2->num_rows > 0) {
            return "True";
        } else {
            return "The token has expired. Please request another one.";
        }
    } else {
        return "Incorrect token. Please check your email again or request another token.";
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['token'])) {
        require "../config_session.php";
        $token = $_POST['token'];
        $tokenStatus = verifyToken($token, $conn);
        if ($tokenStatus == "True") {
            header("Location: ../../customer/resetPassword.php?token=$token");
        } else if ($tokenStatus == "The token has expired. Please request another one.") {
            $_SESSION['tokenExpired'] = $tokenStatus;
            header("Location: ../../customer/tokenVerification.php");
        } else {
            $_SESSION['tokenIncorrect'] = $tokenStatus;
            header("Location: ../../customer/tokenVerification.php");
        }
    }
}
