<?php

declare(strict_types=1);

function isEmailInvalid(string $email): bool
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        return true;
    else
        return false;
}

function isPhoneNumberRegistered(object $conn, string $phoneNumber): bool
{
    if (!getPhoneNumber($conn, $phoneNumber))
        return false;
    else
        return true;
}

function isEmailRegistered(object $conn, string $email): bool
{
    if (getEmail($conn, $email))
        return true;
    else
        return false;
}
function arePasswordsUnmatched(string $password, string $confirmPassword): bool
{
    if ($password !== $confirmPassword)
        return true;
    else
        return false;
}

function createOutDiner(object $conn, string $fullName, string $email, string $phoneNumber, string $password)
{
    setOutDiner($conn, $fullName, $email, $phoneNumber, $password);
}
