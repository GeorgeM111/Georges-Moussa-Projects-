<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require "../../database/db.php";
    if (isset($_POST['token'], $_POST['password'], $_POST['cpassword'])) {
        $token = $_POST['token'];
        $pass = $_POST['password'];
        $cpass = $_POST['cpassword'];
        require "../config_session.php";
        if (strlen($pass) < 8) {
            $_SESSION['shortPass'] = "Password should have at least 8 characters";
        } else if ($pass != $cpass) {
            $_SESSION['diffPass'] = "Passwords do Not match";
        }
        session_write_close();
        $hashedPass = password_hash($pass, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE customer SET PASSWORD = ? WHERE RESET_TOKEN = ?");
        $stmt->bind_param("ss", $hashedPass, $token);
        $stmt->execute();
        header("Location: ../../customer/login.php");
    } else {
        header("Location: ../../customer/forgotPassword.php");
    }
} else {
    header("Location: ../../customer/forgotPassword.php");
}
