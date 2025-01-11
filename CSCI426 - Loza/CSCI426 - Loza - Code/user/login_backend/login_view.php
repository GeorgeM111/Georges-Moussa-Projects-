<?php
// This php file will print information in the login page
if (!defined('LOZA')) {
    header('Location: ../');
    exit;
}
function printNameEmailEmpty()
{
    if (isset($_SESSION['logInErrors'])) {
        if (isset($_SESSION['logInErrors']['nameEmailEmpty'])) {
            echo '<p class="text-danger italiana-regular text-bolder">*' . $_SESSION['logInErrors']['nameEmailEmpty'] . '</p>';
            unset($_SESSION['logInErrors']['nameEmailEmpty']);
        }
    }
}

function printLoginErrorData()
{
    if (isset($_SESSION['loginErrData'])) {
        echo $_SESSION['loginErrData'];
        if (!isset($_SESSION['logInErrors']['nameEmailEmpty']))
            unset($_SESSION['loginErrData']);
    }
}

function printPasswordEmpty()
{
    if (isset($_SESSION['logInErrors'])) {
        if (isset($_SESSION['logInErrors']['passwordEmpty'])) {
            echo '<p class="text-danger italiana-regular text-bolder">*' . $_SESSION['logInErrors']['passwordEmpty'] . '</p>';
            unset($_SESSION['logInErrors']['passwordEmpty']);
        }
    }
}

function printnoUser()
{
    if (isset($_SESSION['logInErrors'])) {
        if (isset($_SESSION['logInErrors']['noUser'])) {
            echo '<p class="text-danger italiana-regular text-center text-bolder fs-5">*' . $_SESSION['logInErrors']['noUser'] . '</p>';
            unset($_SESSION['logInErrors']);
            unset($_SESSION['loginErrData']);
        }
    }
}

function printbadPass()
{
    if (isset($_SESSION['logInErrors'])) {
        if (isset($_SESSION['logInErrors']['badPass'])) {
            echo '<p class="text-danger italiana-regular text-bolder">*' . $_SESSION['logInErrors']['badPass'] . '</p>';
            unset($_SESSION['logInErrors']['badPass']);
        }
    }
}

function printBlockedCustomer()
{
    if (isset($_SESSION['logInErrors'])) {
        if (isset($_SESSION['logInErrors']['blockedCustomer'])) {
            echo '<p class="text-danger italiana-regular text-center text-bolder fs-6">*' . $_SESSION['logInErrors']['blockedCustomer'] . '</p>';
            unset($_SESSION['logInErrors']);
            unset($_SESSION['loginErrData']);
        }
    }
}
