<?php
// This php file will handle data using functions
declare(strict_types=1); //allows us to declare data types : string $name = ...;
if (!defined('LOZA')) {
    header('Location: ../');
    exit;
}
function userDoesNotExist(bool|array $person): bool
{
    if (!$person) { //if the person is false => it doesnt exist
        return true;
    } else {
        return false; //if the person is not false, then the function returned an array =>the person exists
    }
}

function arePasswordsNotMatching(string $password, string $dbPassword)
{
    if ($password != $dbPassword) {
        return true;
    } else {
        return false;
    }
}

function isNameEmailEmpty(string $nameEmail): bool
{
    return empty($nameEmail);
}

function isPasswordEmpty(string $password): bool
{
    return empty($password);
}
