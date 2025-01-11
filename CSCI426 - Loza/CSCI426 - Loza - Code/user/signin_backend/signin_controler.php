<?php

declare(strict_types=1);
if (!defined('LOZA')) {
    header('Location: ../');
    exit;
}


function isEmailRegistered(bool|array $email): bool
{
    if ($email) {
        return true;
    } else {
        return false;
    }
}

function isPhoneNumberRegistered(bool|array $phoneNumber): bool
{
    if ($phoneNumber) {
        return true;
    } else {
        return false;
    }
}

function isPassWordInvalid($password)
{
    $length = strlen($password);
    if ($length < 8) {
        return true;
    } else {
        return false;
    }
}

function isEmailInvalid(string $email): bool
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        return true;
    else
        return false;
}

function arePasswordsNotMatching(string $pswd, string $cpswd): bool
{
    if ($pswd != $cpswd) {
        return true;
    } else {
        return false;
    }
}
