<?php
function printWrongCredentials()
{
    if (isset($_SESSION['logInErrors'])) {
        if (isset($_SESSION['logInErrors']['wrongCredentials'])) {
            echo '<small class="text-danger fs-6 text-center">' . $_SESSION['logInErrors']['wrongCredentials'] . '</small>';
            unset($_SESSION['logInErrors']['wrongCredentials']);
        }
    }
}

function printBlockedPerson()
{
    if (isset($_SESSION['logInErrors'])) {
        if (isset($_SESSION['logInErrors']['blockedPerson'])) {
            echo '<small class="text-danger fs-6 text-center">' . $_SESSION['logInErrors']['blockedPerson'] . '</small>';
            unset($_SESSION['logInErrors']['blockedPerson']);
        }
    }
}
