<?php

function userDoesNotExist(bool|array $person): bool
{
    if (!$person) {
        return true;
    } else {
        return false;
    }
}

function arePasswordsNotMatching(string $password, string $dbHashedPassword)
{
    return !password_verify($password, $dbHashedPassword);
}
