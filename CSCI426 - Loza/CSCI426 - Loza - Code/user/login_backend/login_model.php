<?php
// This php file will query the database
declare(strict_types=1); //allows us to declare data types : string $name = ...;
if (!defined('LOZA')) {
    header('Location: ../'); 
    exit;
}
function getPerson(object $conn, string $nameEmail) //this function returns the person
{
    $person = [];
    if (!filter_var($nameEmail, FILTER_VALIDATE_EMAIL)) { //if this is not an email == the person is a user (admin)
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $nameEmail);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            $person = $result->fetch_assoc();
        }
            return $person;
    } else {
        // If it is an email, then they may be a user (admin) OR  a custpmtr :
        //Admin :
        $sql = "SELECT * FROM  users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $nameEmail);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $person = $result->fetch_assoc();
        } else {
            $person = [];
        }
        $stmt->close();
        //Now we check if the person returned is false , then they may be a customer
        if (!$person) {
            $sql = "SELECT * FROM customers WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $nameEmail);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                $person = $result->fetch_assoc();
            } else {
                $person = []; // Set to an empty array
            }
        }
        //Now if the person is still false, then they doesn't exist in the database
        return $person;
    }
}

function getRole(object $conn, string $nameEmail) //this function returns if the person is a user or an admin
{
    if (!filter_var($nameEmail, FILTER_VALIDATE_EMAIL)) { //if this is not an email == the person is a user (admin)
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $nameEmail);
        $stmt->execute();
        $result = $stmt->get_result();
        $person = $result->fetch_assoc();
        $stmt->close();
        if ($person) {
            return "User";
        }
    } else {
        // If it is an email, then they may be a user (admin) OR  a customer :
        //Admin :
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $nameEmail);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        if ($result->num_rows > 0) {
            return "User";
        } else {
            return "Customer";
        }
    }
}

function getAdminPosition(array $admin)
{
return $admin['position'];
}
