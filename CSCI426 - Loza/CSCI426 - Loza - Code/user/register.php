<?php include "../Database/db.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="initial-scale=1, maximum-scale=1">
  <title>Loza Chocolatier</title>
  <link href="img/logo.png" rel="icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer">
       <link
     rel="stylesheet"
     href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"
   />
  <link rel="stylesheet" href="style/animate.css">
  <style>

@media only screen and (max-width: 515px) {
   #phone{
       width:100% !important;
   }
}

  </style>
</head>
<body>
 <?php include "header.php"; 
 include "signin_backend/signin_view.php"; 
   //If the customer is already logged in and accessed this page through URL, then unset they're info
if (isset($_SESSION['loginCredentials'])) {
    unset($_SESSION['loginCredentials']);
  echo "<script>window.location.reload();</script>";
}
  ?> 
 <div class="container-fluid px-0 wow fadeIn text-bold mx-0 italiana-regular ">
<div class="d-flex  justify-content-center">
<div class="alert alert-warning alert-dismissible position-absolute wow fadeInLeft py-1" id="alert">
  <button type="button" class="btn-close my-2 me-2 p-0 pt-1" data-bs-dismiss="alert"></button>
  Password Criteria : Should Be At Least 8 Characters Long.
</div>
</div>
   <div class="d-flex justify-content-center p-5 align-items center mainContainer">
   <div class="wrapper text-white">
  <form action="signin_backend/signin_server.php" method="post">
    <h1 class="text-center">Sign In</h1>

      <div class="input-box w-100 mb-4 position-relative">
    <input type="text" placeholder="First Name" class="w-100 h-100 ps-3 bg-transparent" name="fn" value="<?php printFirstName(); ?>">
    <?php printEmptyFirstName(); ?>
  </div>

      <div class="input-box w-100 mb-4 position-relative">
    <input type="text" placeholder="Middle Name" class="w-100 h-100 ps-3 bg-transparent" name="mn" value="<?php printMiddleName(); ?>">
    <?php printEmptyMiddleName(); ?>
  </div>


      <div class="input-box w-100 mb-4 position-relative">
    <input type="text" placeholder="Last Name" class="w-100 h-100 ps-3 bg-transparent" name="ln" value="<?php printLastName(); ?>">
    <?php printEmptyLastName(); ?>
      </div>

      <div class="input-box w-100 mb-4 position-relative">
    <input type="email" placeholder="Email" class="w-100 h-100 ps-3 bg-transparent" name="email" value="<?php printEmail(); ?>">
    <?php printRegisteredEmail();
          printInvalidEmail();
     ?>
  </div>

    <div class="input-box w-100 mb-4 position-relative">
    <input type="text" id="phone" class=" bg-transparent" name="phNb" value="<?php printPhoneNumber(); ?>" style="height:50px;width:162%;">
    <?php printRegisteredPhoneNumber();

     ?>
  </div>

    <div class="input-box w-100 mb-4 position-relative">
    <input type="text" placeholder="Company" class="w-100 h-100 ps-3 bg-transparent" name="company" value="<?php printCompany(); ?>">
  </div>

  <div class="input-box w-100 mb-4 position-relative">
    <input type="text" class="w-100 h-100 ps-3 bg-transparent" placeholder="Address" name="address" value="<?php printAddress(); ?>">
    <?php printEmptyAddress(); ?>
  </div>

  <div class="input-box w-100 mb-4 position-relative">
    <input type="password" placeholder="Password" id="password" class="w-100 h-100 ps-3 bg-transparent" name="pwd">
    <?php printInvalidPassword(); ?>
  </div>

  <div class="input-box w-100 mb-4 position-relative">
    <input type="password" placeholder="Confirm Password" id="cpassword" class="w-100 h-100 ps-3 bg-transparent" name="cpwd">
    <?php printBadPasswords(); ?>
  </div>

  <div class="show-forgot d-flex justify-content-center  mb-2">
    <label><input type="checkbox" onchange="showHide()">Show Password</label>
  </div>
  <button type="submit" class="w-100 text-bold">Sign In</button>
  <div class="register text-center mt-2">
    <p class="m-0 p-0">Already Registered ? <a href="login.php" class="text-white text-decoration-none text-bold">Login</a></p>
  </div>
</form>
  </div>
   </div>
 </div>
 <?php include "footer.php" ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
  <script>
   const phoneInputField = document.querySelector("#phone");
   const phoneInput = window.intlTelInput(phoneInputField, {
     utilsScript:
       "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
   });

    document.addEventListener('DOMContentLoaded', function() {
        new WOW({
            resetOnScroll: true
        }).init();
    });

    let passwordInput = document.getElementById("password");
    let CpasswordInput = document.getElementById("cpassword");
    function showHide(){
       if(passwordInput.type === "text"){
        passwordInput.type = "password";
       }
       else if(passwordInput.type === "password"){
        passwordInput.type = "text";
      }
      if(CpasswordInput.type === "text"){
        CpasswordInput.type = "password";
       }
       else if(CpasswordInput.type === "password"){
        CpasswordInput.type = "text";
      }
    }
</script>
</body>
</html>
