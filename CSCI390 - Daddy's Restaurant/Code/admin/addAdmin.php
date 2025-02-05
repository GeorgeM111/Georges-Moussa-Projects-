<?php
include "../database/db.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $phone_number = trim($_POST['phone_number']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($username) || empty($phone_number) || empty($email) || empty($password) || empty($confirm_password)) {
        header("Location: adminManagement.php?error=Please+fill+in+all+fields");
        exit();
    }

    $pattern = '/^\d{2} \d{3} \d{3}$/';
    if (!preg_match($pattern, $phone_number)) {
        header("Location: adminManagement.php?error=Wrong+phone+number+format.+It+should+be+00+000+000");
        exit();
    }

    $stmt = $conn->prepare("SELECT * FROM ADMIN WHERE PHONE_NUMBER = ?");
    $stmt->bind_param("s", $phone_number);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        header("Location: adminManagement.php?error=Phone+number+already+registered");
        exit();
    }
    $stmt->close();

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: adminManagement.php?error=Please+enter+a+valid+email");
        exit();
    }

    $stmt = $conn->prepare("SELECT * FROM ADMIN WHERE EMAIL_ADDRESS = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        header("Location: adminManagement.php?error=Email+already+registered");
        exit();
    }
    $stmt->close();

    if ($password !== $confirm_password) {
        header("Location: adminManagement.php?error=Passwords+do+not+match");
        exit();
    }

    if (strlen($password) < 8) {
        header("Location: adminManagement.php?error=Password+should+be+at+least+8+characters");
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO ADMIN (USERNAME, EMAIL_ADDRESS, PHONE_NUMBER, PASSWORD) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        header("Location: adminManagement.php?error=Database+error");
        exit();
    }
    $stmt->bind_param("ssss", $username, $email, $phone_number, $hashed_password);

    if ($stmt->execute()) {
        header("Location: adminManagement.php?success=1");
        exit();
    } else {
        header("Location: adminManagement.php?error=Failed+to+add+admin");
        exit();
    }
} else {
    header("Location: adminManagement.php");
    exit();
}
