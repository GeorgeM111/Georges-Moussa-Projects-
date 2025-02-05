<?php
function printEmptyName(){
    if(isset($_SESSION['signUpErrors'])){
        if(isset($_SESSION['signUpErrors']['emptyName'])){
            echo '<small class="text-danger fs-6 text-bolder">'.$_SESSION['signUpErrors']['emptyName'].'</small>';
            unset($_SESSION['signUpErrors']['emptyName']);
        }
    }
}

function printFullName(){
    if(isset($_SESSION['signUpData']['fullName']) && !isset($_SESSION['signUpErrors']['emptyName'])){
        echo $_SESSION['signUpData']['fullName'];
        unset($_SESSION['signUpData']['fullName']);
    }
}


function printEmptyPhone(){
    if(isset($_SESSION['signUpErrors'])){
        if(isset($_SESSION['signUpErrors']['emptyPhone'])){
            echo '<small class="text-danger fs-6 text-bolder">'.$_SESSION['signUpErrors']['emptyPhone'].'</small>';
            unset($_SESSION['signUpErrors']['emptyPhone']);
        }
    }
}

function printRegisteredPhoneNumber(){
    if(isset($_SESSION['signUpErrors'])){
        if(isset($_SESSION['signUpErrors']['registeredPhone'])){
            echo '<small class="text-danger fs-6 text-bolder">'.$_SESSION['signUpErrors']['registeredPhone'].'</small>';
            unset($_SESSION['signUpErrors']['registeredPhone']);
        }
    }
}

function printPhoneNumber(){
    if(isset($_SESSION['signUpData']['phoneNumber']) && !isset($_SESSION['signUpErrors']['emptyPhone']) && !isset($_SESSION['signUpErrors']['registeredPhone'])){
        echo $_SESSION['signUpData']['phoneNumber'];
        unset($_SESSION['signUpData']['phoneNumber']);
    }
}

function printEmptyPassword(){
    if(isset($_SESSION['signUpErrors'])){
        if(isset($_SESSION['signUpErrors']['emptyPassword'])){
            echo '<small class="text-danger fs-6 text-bolder">'.$_SESSION['signUpErrors']['emptyPassword'].'</small>';
            unset($_SESSION['signUpErrors']['emptyPassword']);
        }
    }
}

function printShortPassword(){
    if(isset($_SESSION['signUpErrors'])){
        if(isset($_SESSION['signUpErrors']['shortPassword'])){
            echo '<small class="text-danger fs-6 text-bolder">'.$_SESSION['signUpErrors']['shortPassword'].'</small>';
            unset($_SESSION['signUpErrors']['shortPassword']);
        }
    }
}

function printInvalidEmail(){
    if(isset($_SESSION['signUpErrors'])){
        if(isset($_SESSION['signUpErrors']['invalidEmail'])){
            echo '<small class="text-danger fs-6 text-bolder">'.$_SESSION['signUpErrors']['invalidEmail'].'</small>';
            unset($_SESSION['signUpErrors']['invalidEmail']);
        }
    }
}
function printRegisteredEmail(){
    if(isset($_SESSION['signUpErrors'])){
        if(isset($_SESSION['signUpErrors']['registeredEmail'])){
            echo '<small class="text-danger fs-6 text-bolder">'.$_SESSION['signUpErrors']['registeredEmail'].'</small>';
            unset($_SESSION['signUpErrors']['registeredEmail']);
        }
    }
}

function printEmail(){
    if(isset($_SESSION['signUpData']['email']) && !isset($_SESSION['signUpErrors']['invalidEmail']) && !isset($_SESSION['signUpErrors']['registeredEmail'])){
        echo $_SESSION['signUpData']['email'];
        unset($_SESSION['signUpData']['email']);
    }
}



function printUnmatchedPasswords(){
    if(isset($_SESSION['signUpErrors'])){
        if(isset($_SESSION['signUpErrors']['unmatchedPasswords'])){
            echo '<small class="text-danger fs-6 text-bolder">'.$_SESSION['signUpErrors']['unmatchedPasswords'].'</small>';
            unset($_SESSION['signUpErrors']['unmatchedPasswords']);
        }
    }
}
