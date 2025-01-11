<?php
if (!defined('LOZA')) {
    header('Location: ../'); 
    exit;
}
function printTakenUsername(){
    if(isset($_SESSION['addUserErrors'])){
        if(isset($_SESSION['addUserErrors']['usernameTaken'])){
            echo '<p class="text-danger">'.$_SESSION['addUserErrors']['usernameTaken'].'</p>';
            unset($_SESSION['addUserErrors']['usernameTaken']);
        }
    }
}

function printTakenEmail(){
    if(isset($_SESSION['addUserErrors'])){
        if(isset($_SESSION['addUserErrors']['emailTaken'])){
            echo '<p class="text-danger">'.$_SESSION['addUserErrors']['emailTaken'].'</p>';
            unset($_SESSION['addUserErrors']['emailTaken']);
        }
    }
}

function printInvalidEmail(){
    if(isset($_SESSION['addUserErrors'])){
        if(isset($_SESSION['addUserErrors']['invalidEmail'])){  
            echo '<p class="text-danger">'.$_SESSION['addUserErrors']['invalidEmail'].'</p>';
            unset($_SESSION['addUserErrors']['invalidEmail']);
        }
    }
}

function printPasswordsMismatch(){
    if(isset($_SESSION['addUserErrors'])){
        if(isset($_SESSION['addUserErrors']['passwordsMismatch'])){
            echo '<p class="text-danger">'.$_SESSION['addUserErrors']['passwordsMismatch'].'</p>';
            unset($_SESSION['addUserErrors']['passwordsMismatch']);
        }
    }
}

function printPasswordInvalid(){
    if(isset($_SESSION['addUserErrors'])){
        if(isset($_SESSION['addUserErrors']['invalidPassword'])){
            echo '<p class="text-danger">'.$_SESSION['addUserErrors']['invalidPassword'].'</p>';
            unset($_SESSION['addUserErrors']['invalidPassword']);
        }
    }
}

function printInvalidUsername(){
    if(isset($_SESSION['addUserErrors'])){
        if(isset($_SESSION['addUserErrors']['invalidUsername'])){
            echo '<p class="text-danger">'.$_SESSION['addUserErrors']['invalidUsername'].'</p>';
            unset($_SESSION['addUserErrors']['invalidUsername']);
        }
    }
}

function printEmptyUsername(){
    if(isset($_SESSION['addUserErrors'])){
        if(isset($_SESSION['addUserErrors']['emptyUsername'])){
            echo '<p class="text-danger">'.$_SESSION['addUserErrors']['emptyUsername'].'</p>';
            unset($_SESSION['addUserErrors']['emptyUsername']);
        }
    }
}

function printInvalidPassword(){
    if(isset($_SESSION['addUserErrors'])){
        if(isset($_SESSION['addUserErrors']['invalidPassword'])){
            echo '<p class="text-danger">'.$_SESSION['addUserErrors']['invalidPassword'].'</p>';
            unset($_SESSION['addUserErrors']['invalidPassword']);
        }
    }
}

function printEmail(){
    if(isset($_SESSION['addUserData'])){
        if(isset($_SESSION['addUserData']['email']) && !isset($_SESSION['addUserErrors']['invalidEmail']) && !isset($_SESSION['addUserErrors']['emailTaken']))
        {
            echo $_SESSION['addUserData']['email'];
            unset($_SESSION['addUserData']['email']);
        }
    }
}

function printUsername(){
    if(isset($_SESSION['addUserData'])){
        if(isset($_SESSION['addUserData']['username']) && !isset($_SESSION['addUserErrors']['emptyUsername']) && !isset($_SESSION['addUserErrors']['invalidUsername']) && !isset($_SESSION['addUserErrors']['usernameTaken']))
        {
            echo $_SESSION['addUserData']['username'];
            unset($_SESSION['addUserData']['username']);
        }
    }
}

function printSuccessMessage(){
    if (isset($_SESSION['success'])) {
        echo '
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                alert("' . $_SESSION['success'] . '");
            });
        </script>
        ';
        unset($_SESSION['success']);
    }
}
