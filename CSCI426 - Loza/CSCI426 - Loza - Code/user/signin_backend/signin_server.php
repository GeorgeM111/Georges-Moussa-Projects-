<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST["fn"]) && isset($_POST["mn"]) && isset($_POST["ln"]) && isset($_POST["email"]) 
    && isset($_POST["phNb"]) && isset($_POST["company"]) 
    && isset($_POST["address"]) && isset($_POST["pwd"]) && isset($_POST["cpwd"])) 
{
    $firstName = $_POST['fn'];
    $lastName = $_POST['ln'];
    $middleName = $_POST['mn'];
    $email = $_POST['email'];
    $phoneNumber = $_POST['phNb'];
    $company = $_POST['company'];
    $address = $_POST['address'];
    $pwd = $_POST['pwd'];
    $cpwd = $_POST['cpwd'];

    define('LOZA', true);
    require_once("../../Database/db.php");
    require_once("signin_model.php");
    require_once("signin_controler.php");

    $errors = [];
    $dbEmail = getEmail($conn,$email);
    if(isEmailRegistered($dbEmail)){
        $errors['registeredEmail'] = "* This Email Is Already Registered";
    }
    if(isEmailInvalid($email)){
        $errors["invalidEmail"] = "* Enter A Valid Email";
    }

    $dbPhone = getPhoneNumber($conn,$phoneNumber);
    if(isPhoneNumberRegistered($dbPhone)){
        $errors['registeredPhoneNumber'] = "* This phone number is already Registered";
    }
    if(empty($firstName)){
        $errors['emptyFN'] = "* Enter Your First Name";
    }
    if(empty($middleName)){
        $errors['emptyMN'] = "* Enter Your Middle Name";
    }
    if(empty($lastName)){
        $errors['emptyln'] = "* Enter Your Last Name";
    }
    if(empty($address)){
        $errors['emptyAddress'] = "* Enter Your Address";
    }
    if(empty($phoneNumber)){
        $errors["emptyPhone"]=  "* Enter Your Phone Number";
    }

    if(arePasswordsNotMatching($pwd,$cpwd)){
        $errors['badPasswords'] = "* Passwords Don't Match";
    }
    if(isPassWordInvalid($pwd)){
        $errors['invalidPassword'] = "* Password Is Too Short";
    }
    session_start();
    if($errors){
        $_SESSION['signInErrors'] = $errors;
        $_SESSION['signInData'] = [
            "fn" => $firstName,
            "mn" => $middleName,
            "ln" => $lastName,
            "phNb" => $phoneNumber,
            "email" => $email,
            "company" => $company,
            "address" => $address,
        ];
        header("Location: ../register.php");
    }else{
        $CID = mysqli_insert_id($conn);
        createCustomer($conn,$CID,$firstName,$middleName,$lastName,$email,$phoneNumber,$company,$address,$pwd,"Unblocked");
        $newCID = getLastID($conn,$email);
        $loginCredentials = [
            "id"=>$newCID,
            "Name" =>ucwords($firstName." ".$middleName." ".$lastName),
            "fName" =>$firstName,
            "mName" => $middleName,
            "lName" =>$lastName,
            "Email" =>$email,
            "Address"=>$address,
            "Phone"=>$phoneNumber,
            "Company"=>$company,
        ];
        $_SESSION['loginCredentials'] = $loginCredentials;
        $_SESSION['signInSuccess'] = "success";
        header("Location: ../cart.php");
    }
    session_write_close();
    $conn = null;
    $stmt = null;
    
    }else{
        header("Location: ../");
        die();
    }
} else {
    header("Location: ../");
    die();
}
