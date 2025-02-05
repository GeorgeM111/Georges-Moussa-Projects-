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

function isUsernameEmpty(string $username): bool
{
    return empty($username);
}

function isPasswordEmpty(string $password): bool
{
    return empty($password);
}

function isPersonBlocked(string $status): bool
{
    if ($status === "Blocked") {
        return true;
    } else {
        return false;
    }
}
