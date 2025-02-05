<?php
declare(strict_types=1);

function getPhoneNumber(object $conn, string $phoneNumber)
{
    $query = "SELECT PHONE_NUMBER FROM customer WHERE PHONE_NUMBER= ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $phoneNumber);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $phone = [];
    if($result->num_rows >0){
        $phone =$result->fetch_assoc();
    }else{
        $query = "SELECT PHONE_NUMBER FROM admin WHERE PHONE_NUMBER= ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $phoneNumber);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if($result->num_rows >0){
            $phone =$result->fetch_assoc();
        }
    }
    return $phone;
}

function getEmail(object $conn, string $email)
{
    $query = "SELECT EMAIL_ADDRESS FROM customer WHERE EMAIL_ADDRESS= ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $dbemail = [];
    if($result->num_rows >0){
        $dbemail =$result->fetch_assoc();
    }
    return $dbemail;
}

function setOutDiner(object $conn,string $fullName,string $email,string $phoneNumber,string $password){
    $query="INSERT INTO customer (`FULL NAME`,EMAIL_ADDRESS,PHONE_NUMBER,PASSWORD) VALUES(?,?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $fullName,$email,$phoneNumber,$password);
    $stmt->execute();
    $stmt->close();
}

function getLastID(object $conn,string $email){
    $sql = "SELECT ID FROM customer WHERE EMAIL_ADDRESS = ? ORDER BY ID DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    $custID=$result->fetch_assoc();

    return $custID['ID'];
}
?>
?>

