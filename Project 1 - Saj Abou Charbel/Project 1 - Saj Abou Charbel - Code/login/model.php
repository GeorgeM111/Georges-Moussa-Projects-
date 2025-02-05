<?php

declare(strict_types=1);
function getPerson(object $connection, string $username)
{
    $query = "SELECT * FROM admin WHERE username = ?";
    $statement = $connection->prepare($query);
    $statement->bind_param("s", $username);
    $statement->execute();
    $result = $statement->get_result();
    $statement->close();
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    return false;
}
