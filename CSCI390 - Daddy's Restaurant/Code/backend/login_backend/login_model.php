<?php

declare(strict_types=1);
function getPerson(object $connection, string $phoneNumber)
{
    $query = "SELECT * FROM customer WHERE PHONE_NUMBER = ?  AND STATUS != 'Deleted'";
    $statement = $connection->prepare($query);
    $statement->bind_param("s", $phoneNumber);
    $statement->execute();
    $result = $statement->get_result();
    $statement->close();
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        $query = "SELECT * FROM admin WHERE PHONE_NUMBER = ?";
        $statement = $connection->prepare($query);
        $statement->bind_param("s", $phoneNumber);
        $statement->execute();
        $result = $statement->get_result();
        $statement->close();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
    }
    return false;
}


function getRole(object $connection, string $phoneNumber)
{
    $query = "SELECT * FROM customer WHERE PHONE_NUMBER = ? AND  STATUS != 'Deleted'";
    $statement = $connection->prepare($query);
    $statement->bind_param("s", $phoneNumber);
    $statement->execute();
    $result = $statement->get_result();
    $statement->close();
    $person = $result->fetch_assoc();
    if ($person) {
        return "User";
    } else {
        return "Admin";
    }
}
