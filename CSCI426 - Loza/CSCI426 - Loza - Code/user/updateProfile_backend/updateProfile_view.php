<?php
if (!defined('LOZA')) {
    header('Location: ../'); 
    exit;
}

function printRegisteredEmail(){
    if(isset($_SESSION['updateProfileErrors'])){
        if(isset($_SESSION['updateProfileErrors']['takenEmail'])){
            echo '<p class="text-danger text-bolder">'.$_SESSION['updateProfileErrors']['takenEmail'].'</p>';
            unset($_SESSION['updateProfileErrors']['takenEmail']);
        }
    }
}
function printInvalidEmail(){
    if(isset($_SESSION['updateProfileErrors'])){
        if(isset($_SESSION['updateProfileErrors']['invalidEmail'])){
            echo '<p class="text-danger text-bolder">'.$_SESSION['updateProfileErrors']['invalidEmail'].'</p>';
            unset($_SESSION['updateProfileErrors']['invalidEmail']);
        }
    }
}

function printRegisteredPhoneNumber(){
    if(isset($_SESSION['updateProfileErrors'])){
        if(isset($_SESSION['updateProfileErrors']['takenPhnb'])){
            echo '<p class="text-danger text-bolder">'.$_SESSION['updateProfileErrors']['takenPhnb'].'</p>';
            unset($_SESSION['updateProfileErrors']['takenPhnb']);
        }
    }
}

function printInvalidPhoneNumber(){
    if(isset($_SESSION['updateProfileErrors'])){
        if(isset($_SESSION['updateProfileErrors']['invalidPhone'])){
            echo '<p class="text-danger  text-bolder">'.$_SESSION['updateProfileErrors']['invalidPhone'].'</p>';
            unset($_SESSION['updateProfileErrors']['invalidPhone']);
        }
    }
}

function printbadOldPass(){
    if(isset($_SESSION['updateProfileErrors'])){
        if(isset($_SESSION['updateProfileErrors']['badOldPass'])){
            echo '<p class="text-danger text-bolder">'.$_SESSION['updateProfileErrors']['badOldPass'].'</p>';
            unset($_SESSION['updateProfileErrors']['badOldPass']);
        }
    }
}

function printbadNewPass(){
    if(isset($_SESSION['updateProfileErrors'])){
        if(isset($_SESSION['updateProfileErrors']['badNewPass'])){
            echo '<p class="text-danger text-bolder">'.$_SESSION['updateProfileErrors']['badNewPass'].'</p>';
            unset($_SESSION['updateProfileErrors']['badNewPass']);
        }
    }
}

function printunchangedPass(){
    if(isset($_SESSION['updateProfileErrors'])){
        if(isset($_SESSION['updateProfileErrors']['unchangedPass'])){
            echo '<p class="text-danger text-bolder">'.$_SESSION['updateProfileErrors']['unchangedPass'].'</p>';
            unset($_SESSION['updateProfileErrors']['unchangedPass']);
        }
    }
}

function printInvalidPassword(){
    if(isset($_SESSION['updateProfileErrors'])){
        if(isset($_SESSION['updateProfileErrors']['invalidPassword'])){
            echo '<p class="text-danger text-bolder">'.$_SESSION['updateProfileErrors']['invalidPassword'].'</p>';
            unset($_SESSION['updateProfileErrors']['invalidPassword']);
        }
    }
}

function alertProfileUpdated() {
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