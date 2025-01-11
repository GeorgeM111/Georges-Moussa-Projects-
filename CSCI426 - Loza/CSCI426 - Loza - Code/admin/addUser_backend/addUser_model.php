<?php
 declare(strict_types= 1);
 if (!defined('LOZA')) {
    header('Location: ../'); 
    exit;
}
function getUsername(object $conn, string $newUsername){
    $sql = "SELECT username FROM USERS WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$newUsername);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $username = [];
    if($result->num_rows >0){
        $username = $result->fetch_assoc();
    }
    return $username;
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

function createUser(object $conn,string $username,string $password,string $email,string $position)
{
    $sql="INSERT INTO USERS (username,password,email,position,last_date) VALUES(?,?,?,?,NOW());";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss",$username,$password,$email,$position);
    $stmt->execute();
    $stmt->close();
}