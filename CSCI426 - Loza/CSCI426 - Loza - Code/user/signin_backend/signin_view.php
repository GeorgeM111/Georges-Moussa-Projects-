<?php
if (!defined('LOZA')) {
    header('Location: ../');
    exit;
}

function printRegisteredEmail()
{
    if (isset($_SESSION['signInErrors'])) {
        if (isset($_SESSION['signInErrors']['registeredEmail'])) {
            echo '<p class="text-danger italiana-regular text-bolder">' . $_SESSION['signInErrors']['registeredEmail'] . '</p>';
            unset($_SESSION['signInErrors']['registeredEmail']);
        }
    }
}
function printInvalidEmail()
{
    if (isset($_SESSION['signInErrors'])) {
        if (isset($_SESSION['signInErrors']['invalidEmail'])) {
            echo '<p class="text-danger italiana-regular text-bolder">' . $_SESSION['signInErrors']['invalidEmail'] . '</p>';
            unset($_SESSION['signInErrors']['invalidEmail']);
        }
    }
}

function printRegisteredPhoneNumber()
{
    if (isset($_SESSION['signInErrors'])) {
        if (isset($_SESSION['signInErrors']['registeredPhoneNumber'])) {
            echo '<p class="text-danger italiana-regular text-bolder">' . $_SESSION['signInErrors']['registeredPhoneNumber'] . '</p>';
            unset($_SESSION['signInErrors']['registeredPhoneNumber']);
        }
    }
}

function printInvalidPhoneNumber()
{
    if (isset($_SESSION['signInErrors'])) {
        if (isset($_SESSION['signInErrors']['invalidPhoneNumber'])) {
            echo '<p class="text-danger italiana-regular text-bolder">' . $_SESSION['signInErrors']['invalidPhoneNumber'] . '</p>';
            unset($_SESSION['signInErrors']['invalidPhoneNumber']);
        }
    }
}

function printEmptyFirstName()
{
    if (isset($_SESSION['signInErrors'])) {
        if (isset($_SESSION['signInErrors']['emptyFN'])) {
            echo '<p class="text-danger italiana-regular text-bolder">' . $_SESSION['signInErrors']['emptyFN'] . '</p>';
            unset($_SESSION['signInErrors']['emptyFN']);
        }
    }
}

function printEmptyMiddleName()
{
    if (isset($_SESSION['signInErrors'])) {
        if (isset($_SESSION['signInErrors']['emptyMN'])) {
            echo '<p class="text-danger italiana-regular text-bolder">' . $_SESSION['signInErrors']['emptyMN'] . '</p>';
            unset($_SESSION['signInErrors']['emptyMN']);
        }
    }
}

function printEmptyLastName()
{
    if (isset($_SESSION['signInErrors'])) {
        if (isset($_SESSION['signInErrors']['emptyln'])) {
            echo '<p class="text-danger italiana-regular text-bolder">' . $_SESSION['signInErrors']['emptyln'] . '</p>';
            unset($_SESSION['signInErrors']['emptyln']);
        }
    }
}

function printEmptyCompany()
{
    if (isset($_SESSION['signInErrors'])) {
        if (isset($_SESSION['signInErrors']['emptyCompany'])) {
            echo '<p class="text-danger italiana-regular text-bolder">' . $_SESSION['signInErrors']['emptyCompany'] . '</p>';
            unset($_SESSION['signInErrors']['emptyCompany']);
        }
    }
}

function printEmptyAddress()
{
    if (isset($_SESSION['signInErrors'])) {
        if (isset($_SESSION['signInErrors']['emptyAddress'])) {
            echo '<p class="text-danger italiana-regular text-bolder">' . $_SESSION['signInErrors']['emptyAddress'] . '</p>';
            unset($_SESSION['signInErrors']['emptyAddress']);
        }
    }
}

function printInvalidPassword()
{
    if (isset($_SESSION['signInErrors'])) {
        if (isset($_SESSION['signInErrors']['invalidPassword'])) {
            echo '<p class="text-danger italiana-regular text-bolder">' . $_SESSION['signInErrors']['invalidPassword'] . '</p>';
            unset($_SESSION['signInErrors']['invalidPassword']);
        }
    }
}

function printBadPasswords()
{
    if (isset($_SESSION['signInErrors'])) {
        if (isset($_SESSION['signInErrors']['badPasswords'])) {
            echo '<p class="text-danger italiana-regular text-bolder">' . $_SESSION['signInErrors']['badPasswords'] . '</p>';
            unset($_SESSION['signInErrors']['badPasswords']);
        }
    }
}

function printFirstName()
{
    if (isset($_SESSION['signInData']['fn'])) {
        if (!isset($_SESSION['signInErrors']['emptyFN'])) {
            echo $_SESSION['signInData']['fn'];
        }
    }
}

function printMiddleName()
{
    if (isset($_SESSION['signInData']['mn'])) {
        if (!isset($_SESSION['signInErrors']['emptyMN'])) {
            echo $_SESSION['signInData']['mn'];
        }
    }
}

function printLastName()
{
    if (isset($_SESSION['signInData']['ln'])) {
        if (!isset($_SESSION['signInErrors']['emptyLN'])) {
            echo $_SESSION['signInData']['ln'];
        }
    }
}

function printCompany()
{
    if (isset($_SESSION['signInData']['company'])) {
        if (!isset($_SESSION['signInErrors']['emptyCompany'])) {
            echo $_SESSION['signInData']['company'];
        }
    }
}

function printAddress()
{
    if (isset($_SESSION['signInData']['address'])) {
        if (!isset($_SESSION['signInErrors']['emptyAddress'])) {
            echo $_SESSION['signInData']['address'];
            unset($_SESSION['signInData']); //Last called function unsets the whole signInData session.
        }
    }
}

function printEmail()
{
    if (isset($_SESSION['signInData']['email'])) {
        if (!(isset($_SESSION['signInErrors']['invalidEmail']) && isset($_SESSION['signInErrors']['registeredEmail']))) {
            echo $_SESSION['signInData']['email'];
        }
    }
}

function printPhoneNumber()
{
    if (isset($_SESSION['signInData']['phNb'])) {
        if (!(isset($_SESSION['signInErrors']['invalidPhoneNumber']) && isset($_SESSION['signInErrors']['registeredPhoneNumber']))) {
            echo $_SESSION['signInData']['phNb'];
        }
    }
}
