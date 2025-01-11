<?php
//There is no need to check if the user exists in the database, because if they didnt exist, they couldnt access
// this page

declare(strict_types = 1);
if (!defined('LOZA')) {
    header('Location: ../'); 
    exit;
}
function retrieveDatabasePassword(object $conn, string $email){
 $sql = "SELECT password FROM CUSTOMERS WHERE EMAIL = ?";
 $stmt = $conn->prepare($sql);
 $stmt->bind_param("s",$email);
 $stmt->execute();
 $result = $stmt->get_result();
 $stmt->close();
 $password = $result->fetch_assoc();

 return $password;
}

function getPhoneNumber(object $conn, string $newPhoneNumber){
    $sql = "SELECT Phone from customers where Phone = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$newPhoneNumber);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $phoneNumber = [];
    if($result->num_rows > 0){
        $phoneNumber = $result->fetch_assoc();
    }
    return $phoneNumber;
    }

function getEmail(object $conn, string $newEmail){
    $sql="SELECT email FROM users  WHERE email = ? UNION SELECT email FROM customers WHERE email = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss",$newEmail,$newEmail);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $email = [];
    if($result->num_rows > 0){
        $email = $result->fetch_assoc();
    }
    return $email;
}

function updatePhoneNumber(object $conn,$newPhnb,$oldPhnb){
    $sql = "UPDATE CUSTOMERS SET Phone= ? where Phone = ?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("ss",$newPhnb,$oldPhnb);
    $stmt->execute();
    $stmt->close();
}

function updateEmail(object $conn,$newEmail,$oldEmail){
    $sql = "UPDATE CUSTOMERS SET email= ? where email = ?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("ss",$newEmail,$oldEmail);
    $stmt->execute();
    $stmt->close();
}

function updatePassword(object $conn,$newPassword,$email){
    $sql = "UPDATE CUSTOMERS SET password= ? where email = ?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("ss",$newPassword,$email);
    $stmt->execute();
    $stmt->close();
}

function updateCompany(object $conn,$newCompany,$email){
    $sql = "UPDATE CUSTOMERS SET company= ? where email = ?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("ss",$newCompany,$email);
    $stmt->execute();
    $stmt->close();
}

function updateAddress(object $conn,$newAddress,$email){
    $sql = "UPDATE CUSTOMERS SET address= ? where email = ?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("ss",$newAddress,$email);
    $stmt->execute();
    $stmt->close();
}


