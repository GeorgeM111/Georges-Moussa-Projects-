<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['pswd']) &&isset($_POST['cpswd']) && isset($_POST['position'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $pswd = $_POST['pswd'];
        $cpswd = $_POST['cpswd'];
        $position = $_POST['position'];
        define('LOZA',true);
        require_once("../../Database/db.php");
        require_once("addUser_model.php");
        require_once("addUser_controler.php");
        
        $errors = [];
        $dbUsername = getUsername($conn,$username);
        if(empty($username)){
            $errors['emptyUsername'] = "* Please Enter a username";
        }
        if(isUsernameInvalid($username)){
            $errors['invalidUsername'] = "* Username doesn't meet the listed criteria";
        }
        if(isUsernameTaken($dbUsername)){
            $errors['usernameTaken'] = "* This username is already registered";
        }
        if(isEmailInvalid($email)){
            $errors['invalidEmail']="* Please Enter a valid email";
        }
        $dbEmail = getEmail($conn,$email);
        if(isEmailTaken($dbEmail)){
            $errors['emailTaken'] = "* This email is already taken";
        }
        if(arePasswordsNotMatching($pswd,$cpswd))
        {    
            $errors['passwordsMismatch'] = "* Passwords Do Not Match";
        }
        if(isPassWordInvalid($pswd)){
            $errors['invalidPassword'] = "* Password doesn't meet the listed criteria";
        }

        session_start();
        if(!$errors){
            createUser($conn,$username,$pswd,
            $email,$position);
            $_SESSION['success'] = "User Created Successfully !";
            header("Location: ../adminAuthentication.php");
        }else{
            $_SESSION['addUserData'] = [
                "username" =>$username,
                "email"=>$email,
            ];
            $_SESSION['addUserErrors'] = $errors;
            header("Location: ../adminAuthentication.php");
        }
    }else{
        header("Location ../adminAuthentication.php");
        die();
    }

}else{
    header("Location: ../index.php");
    die();
}