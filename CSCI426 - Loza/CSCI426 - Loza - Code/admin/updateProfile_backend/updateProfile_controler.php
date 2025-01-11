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

function isUsernameTaken(bool|array $dbUsername):bool
{
    if(!$dbUsername){
        return false;
    }else{
        return true;
    }
}

function isEmailTaken(bool|array $dbEmail):bool
{
    if(!$dbEmail){
        return false;
    }else{
        return true;
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

function isPassWordInvalid($password) {
    $length = strlen($password);
    if ($length < 8 || $length > 16) {
        return true;
    }
    if (!preg_match('/[A-Z]/', $password)) {
        return true;
    }
    if (!preg_match('/[a-z]/', $password)) {
        return true;
    }
    if (!preg_match('/\d/', $password)) {
        return true;
    }
    if (!preg_match('/[^A-Za-z0-9]/', $password)) {
        return true; 
    }
    if (strpos($password, ' ') !== false) {
        return true;
    }
    return false;
}

function isUsernameInvalid($username) {
    $length = strlen($username);
    if ($length < 8 || $length > 12) {
        return true;
    }
    if (!preg_match('/[A-Z]/', $username)) {
        return true;
    }
    if (!preg_match('/[a-z]/', $username)) {
        return true;
    }
    if (!preg_match('/\d/', $username)) {
        return true;
    }
    if (preg_match('/[^A-Za-z0-9]/', $username)) {
        return true; 
    }
    if (strpos($username, ' ') !== false) {
        return true;
    }
    return false;
}
