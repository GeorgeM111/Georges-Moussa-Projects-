<?php 

function printbadOldPass(){
    if(isset($_SESSION['updateProfileErrors'])){
        if(isset($_SESSION['updateProfileErrors']['badOldPass'])){
            echo '<p class="text-danger">'.$_SESSION['updateProfileErrors']['badOldPass'].'</p>';
            unset($_SESSION['updateProfileErrors']['badOldPass']);
        }
    }
}

function printbadNewPass(){
    if(isset($_SESSION['updateProfileErrors'])){
        if(isset($_SESSION['updateProfileErrors']['badNewPass'])){
            echo '<p class="text-danger">'.$_SESSION['updateProfileErrors']['badNewPass'].'</p>';
            unset($_SESSION['updateProfileErrors']['badNewPass']);
        }
    }
}

function printunchangedPass(){
    if(isset($_SESSION['updateProfileErrors'])){
        if(isset($_SESSION['updateProfileErrors']['unchangedPass'])){
            echo '<p class="text-danger">'.$_SESSION['updateProfileErrors']['unchangedPass'].'</p>';
            unset($_SESSION['updateProfileErrors']['unchangedPass']);
        }
    }
}

function printTakenUsername(){
    if(isset($_SESSION['updateProfileErrors'])){
        if(isset($_SESSION['updateProfileErrors']['takenUsername'])){
            echo '<p class="text-danger">'.$_SESSION['updateProfileErrors']['takenUsername'].'</p>';
            unset($_SESSION['updateProfileErrors']['takenUsername']);
        }
    }
}

function printTakenEmail(){
    if(isset($_SESSION['updateProfileErrors'])){
        if(isset($_SESSION['updateProfileErrors']['takenEmail'])){
            echo '<p class="text-danger">'.$_SESSION['updateProfileErrors']['takenEmail'].'</p>';
            unset($_SESSION['updateProfileErrors']['takenEmail']);
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

function printInvalidPassword(){
    if(isset($_SESSION['updateProfileErrors'])){
        if(isset($_SESSION['updateProfileErrors']['invalidPassword'])){
            echo '<p class="text-danger">'.$_SESSION['updateProfileErrors']['invalidPassword'].'</p>';
            unset($_SESSION['updateProfileErrors']['invalidPassword']);
        }
    }
}

function printInvalidUsername(){
    if(isset($_SESSION['updateProfileErrors'])){
        if(isset($_SESSION['updateProfileErrors']['invalidUsername'])){
            echo '<p class="text-danger">'.$_SESSION['updateProfileErrors']['invalidUsername'].'</p>';
            unset($_SESSION['updateProfileErrors']['invalidUsername']);
        }
    }
}

