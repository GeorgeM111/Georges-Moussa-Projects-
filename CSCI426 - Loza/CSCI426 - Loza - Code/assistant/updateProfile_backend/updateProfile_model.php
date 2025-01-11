<?php
//There is no need to check if the user exists in the database, because if they didnt exist, they couldnt access
// this page
declare(strict_types = 1);

function retrieveDatabasePassword(object $conn, string $username){
 $sql = "SELECT password FROM USERS WHERE username = ?";
 $stmt = $conn->prepare($sql);
 $stmt->bind_param("s",$username);
 $stmt->execute();
 $result = $stmt->get_result();
 $stmt->close();
 $password = $result->fetch_assoc();

 return $password;
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

function updateUsername(object $conn,$newUsername,$oldUsername){
    $sql = "UPDATE USERS SET username= ? where username = ?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("ss",$newUsername,$oldUsername);
    $stmt->execute();
    $stmt->close();
}

function updateEmail(object $conn,$newEmail,$oldUsername){
    $sql = "UPDATE USERS SET email= ? where username = ?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("ss",$newEmail,$oldUsername);
    $stmt->execute();
    $stmt->close();
}

function updatePassword(object $conn,$newPassword,$oldUsername){
    $sql = "UPDATE USERS SET password= ? where username = ?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("ss",$newPassword,$oldUsername);
    $stmt->execute();
    $stmt->close();
}

function updateDate(object $conn,$oldUsername){
    $sql = "UPDATE USERS SET last_date= NOW() where username = ?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("s",$oldUsername);
    $stmt->execute();
    $stmt->close();
}


