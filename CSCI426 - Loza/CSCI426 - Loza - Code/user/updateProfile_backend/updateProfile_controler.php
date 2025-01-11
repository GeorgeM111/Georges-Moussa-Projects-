<?php
declare(strict_types = 1);
if (!defined('LOZA')) {
    header('Location: ../'); 
    exit;
}
function areOldPasswordsNotMatching(string $oldPassword,string $dbPassword):bool
{
    if($oldPassword != $dbPassword){
        return true;
    }else{
        return false;
    }
}

function areNewPasswordsNotMatching(string $newPassword,string $confirmPassword):bool
{
    if($newPassword != $confirmPassword){
        return true;
    }else{
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

function isNewPasswordUnchanged($newPassword,$dbPassword):bool //Check if the new Password is the same as the old password
{
    if($newPassword == $dbPassword){
        return true;
    }else{
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

