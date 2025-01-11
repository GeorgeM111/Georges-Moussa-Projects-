<?php

declare(strict_types=1);
if (!defined('LOZA')) {
    header('Location: ../');
    exit;
}
function getEmail(object $conn, string $newEmail)
{
    $sql = "SELECT email FROM users WHERE email = ? UNION SELECT email FROM customers WHERE email = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $newEmail, $newEmail);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $email = [];
    if ($result->num_rows > 0) {
        $email = $result->fetch_assoc();
    }
    return $email;
}

function getPhoneNumber(object $conn, string $newPhoneNumber)
{
    $sql = "SELECT Phone from customers where Phone = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $newPhoneNumber);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $phoneNumber = [];
    if ($result->num_rows > 0) {
        $phoneNumber = $result->fetch_assoc();
    }
    return $phoneNumber;
}

function createCustomer(object $conn, int $CID, string $firstName, string $middleName, string $lastName, string $email, string $phoneNumber, string $company, string $address, string $password, string $status)
{
    $sql = "INSERT INTO customers (CID,fname,lname,mname,address,Phone,email,password,company,status) VALUE(?,?,?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssssssss", $CID, $firstName, $lastName, $middleName, $address, $phoneNumber, $email, $password, $company, $status);
    $stmt->execute();
    $stmt->close();
}

function getLastID(object $conn, string $email)
{
    $sql = "SELECT CID FROM customers WHERE EMAIL = ? ORDER BY CID DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $custID = $result->fetch_assoc();

    return $custID['CID'];
}
