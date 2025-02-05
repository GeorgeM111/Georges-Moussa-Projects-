<?php

function printUsernameEmpty()
{
    if (isset($_SESSION['logInErrors'])) {
        if (isset($_SESSION['logInErrors']['usernameEmpty'])) {
            echo '<small class="text-danger">' . $_SESSION['logInErrors']['usernameEmpty'] . '</small>';
            unset($_SESSION['logInErrors']['usernameEmpty']);
        }
    }
}

function printPasswordEmpty()
{
    if (isset($_SESSION['logInErrors'])) {
        if (isset($_SESSION['logInErrors']['passwordEmpty'])) {
            echo '<small class="text-danger">' . $_SESSION['logInErrors']['passwordEmpty'] . '</small>';
            unset($_SESSION['logInErrors']['passwordEmpty']);
        }
    }
}

function printWrongCredentials()
{
    if (isset($_SESSION['logInErrors'])) {
        if (isset($_SESSION['logInErrors']['wrongCredentials'])) {
            echo '<small class="text-danger text-center">' . $_SESSION['logInErrors']['wrongCredentials'] . '</small>';
            unset($_SESSION['logInErrors']['wrongCredentials']);
        }
    }
}

function printBlockedPerson()
{
    if (isset($_SESSION['logInErrors'])) {
        if (isset($_SESSION['logInErrors']['blockedPerson'])) {
            echo '<small class="text-danger text-center">' . $_SESSION['logInErrors']['blockedPerson'] . '</small>';
            unset($_SESSION['logInErrors']['blockedPerson']);
        }
    }
}
