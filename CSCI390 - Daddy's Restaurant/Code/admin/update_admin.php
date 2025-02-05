<?php
require_once("../database/db.php");
require "../backend/config_session.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = isset($_POST['username'])  ? trim($_POST['username']) : "";
    $email = isset($_POST['email']) ? trim($_POST['email'])  : "";
    $phone = isset($_POST['phone'])  ? trim($_POST['phone'])  : "";
    $opassword = isset($_POST['opassword'])  ? trim($_POST['opassword'])  : "";
    $npassword = isset($_POST['npassword'])  ? trim($_POST['npassword'])  : "";
    $cpassword = isset($_POST['cpassword'])  ? trim($_POST['cpassword'])  : "";

    $oldUsername   = $_SESSION['adminLoginCredentials']['username'];
    $oldEmail      = $_SESSION['adminLoginCredentials']['email'];
    $oldPhone      = $_SESSION['adminLoginCredentials']['phoneNumber'];
    if (empty($username) || empty($email) || empty($phone) || empty($opassword)) {
        http_response_code(400);
        echo "Please fill in all fields. You can leave the New Password & Confirm Password empty if you don’t want to change your password.";
        exit();
    }


    if ($username !== $oldUsername) {
        $stmt = $conn->prepare("SELECT USERNAME FROM admin WHERE USERNAME = ?");
        if (!$stmt) {
            http_response_code(500);
            echo "Database error (username check): " . $conn->error;
            exit();
        }
        $stmt->bind_param("s", $username);
        if (!$stmt->execute()) {
            http_response_code(500);
            echo "Error checking username.";
            exit();
        }
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            http_response_code(400);
            echo "Username is already in use.";
            exit();
        }
        $stmt->close();
    }
    if ($email !== $oldEmail) {
        $stmt = $conn->prepare("
            SELECT EMAIL_ADDRESS FROM customer WHERE EMAIL_ADDRESS = ?
            UNION ALL
            SELECT EMAIL_ADDRESS FROM admin WHERE EMAIL_ADDRESS = ?
        ");
        if (!$stmt) {
            http_response_code(500);
            echo "Database error (email check): " . $conn->error;
            exit();
        }
        $stmt->bind_param("ss", $email, $email);
        if (!$stmt->execute()) {
            http_response_code(500);
            echo "Error checking email.";
            exit();
        }
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            http_response_code(400);
            echo "Email is already registered in the database.";
            exit();
        }
        $stmt->close();
    }
    if ($phone !== $oldPhone) {
        $stmt = $conn->prepare("
            SELECT PHONE_NUMBER FROM customer WHERE PHONE_NUMBER = ?
            UNION ALL
            SELECT PHONE_NUMBER FROM admin WHERE PHONE_NUMBER = ?
        ");
        if (!$stmt) {
            http_response_code(500);
            echo "Database error (phone check): " . $conn->error;
            exit();
        }
        $stmt->bind_param("ss", $phone, $phone);
        if (!$stmt->execute()) {
            http_response_code(500);
            echo "Error checking phone.";
            exit();
        }
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            http_response_code(400);
            echo "Phone Number is already registered in the database.";
            exit();
        }
        $stmt->close();
    }

    $stmt = $conn->prepare("SELECT PASSWORD FROM admin WHERE USERNAME = ?");
    if (!$stmt) {
        http_response_code(500);
        echo "Database error (password check): " . $conn->error;
        exit();
    }
    $stmt->bind_param("s", $oldUsername);
    if (!$stmt->execute()) {
        http_response_code(500);
        echo "Error verifying old password.";
        exit();
    }
    $result = $stmt->get_result();
    if ($result->num_rows <= 0) {
        http_response_code(400);
        echo "Admin account not found.";
        exit();
    }
    $dbPass = $result->fetch_assoc()['PASSWORD'];
    $stmt->close();

    if (!password_verify($opassword, $dbPass)) {
        http_response_code(400);
        echo "Incorrect old password.";
        exit();
    }
    if (empty($npassword) && empty($cpassword)) {
        $stmt = $conn->prepare("
            UPDATE admin
            SET USERNAME = ?, EMAIL_ADDRESS = ?, PHONE_NUMBER = ?
            WHERE USERNAME = ?
        ");
        if (!$stmt) {
            http_response_code(500);
            echo "Database error (update no-pass): " . $conn->error;
            exit();
        }
        $stmt->bind_param("ssss", $username, $email, $phone, $oldUsername);
    } else {
        if ($npassword === $cpassword) {
            $hashed_password = password_hash($npassword, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("
                UPDATE admin
                SET USERNAME = ?, EMAIL_ADDRESS = ?, PHONE_NUMBER = ?, PASSWORD = ?
                WHERE USERNAME = ?
            ");
            if (!$stmt) {
                http_response_code(500);
                echo "Database error (update with pass): " . $conn->error;
                exit();
            }
            $stmt->bind_param("sssss", $username, $email, $phone, $hashed_password, $oldUsername);
        } else {
            http_response_code(400);
            echo "Passwords do not match";
            exit();
        }
    }
    if ($stmt->execute()) {
        $_SESSION['adminLoginCredentials']['username'] = $username;
        $_SESSION['adminLoginCredentials']['email'] = $email;
        $_SESSION['adminLoginCredentials']['phoneNumber'] = $phone;

        echo "Profile updated successfully.";
    } else {
        http_response_code(500);
        echo "Error updating profile.";
    }

    $stmt->close();
    $conn->close();
} else {
    http_response_code(405);
    echo "Method not allowed.";
}
