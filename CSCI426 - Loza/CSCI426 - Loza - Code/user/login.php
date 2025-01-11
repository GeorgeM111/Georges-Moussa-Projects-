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
  <link rel="stylesheet" href="style/animate.css">
</head>
<body>
 <?php include "header.php"; 
 include "login_backend/login_view.php"; 
   //If the customer is already logged in and accessed this page through URL, then unset they're info
if (isset($_SESSION['loginCredentials'])) {
   unset($_SESSION['loginCredentials']);
  echo "<script>window.location.reload();</script>";
}
  ?> 
 <div class="container-fluid px-0 wow fadeIn text-bold mx-0 italiana-regular ">
   <div class="d-flex justify-content-center p-5 align-items center mainContainer">
   <div class="wrapper text-white">
  <form action="login_backend/login_server.php" method="post" autocomplete="off">
    <h1 class="text-center">Login</h1>
    <?php printnoUser(); 
          printBlockedCustomer(); 
    ?>
  <div class="input-box w-100 mb-4 position-relative">
    <input type="text" placeholder="Username / Email" class="w-100 h-100 ps-3 bg-transparent"  name="nameEmail" value="<?php printLoginErrorData() ?>">
    <i class="fa-solid fa-user position-absolute"></i>
    <?php printNameEmailEmpty();?>
  </div>
  <div class="input-box w-100 mb-4 position-relative">
    <input type="password" class="w-100 h-100 ps-3 bg-transparent" id="password"  placeholder="Password" name="pass" >
    <i class="fa-solid fa-lock position-absolute"></i>
    <?php printPasswordEmpty();
          printbadPass();
    ?>
  </div>
  <div class="show-forgot d-flex justify-content-between  mb-2">
    <label><input type="checkbox" onchange="showHide()">Show Password</label>
    <!-- <a href="" class="text-decoration-none text-white">Forgot Password ?</a> -->
  </div>
  <button type="submit" class="w-100 text-bold">Login</button>
  <div class="register text-center mt-2">
    <p class="m-0 p-0">Don't have an account yet? <a href="register.php" class="text-white text-decoration-none text-bold">Register now!</a></p>
  </div>
</form>
  </div>
   </div>
 </div>
 <?php include "footer.php" ?>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        new WOW({
            resetOnScroll: true
        }).init();
    });

    let passwordInput = document.getElementById("password");
    function showHide(){
       if(passwordInput.type === "text"){
        passwordInput.type = "password";
       }
       else if(passwordInput.type === "password"){
        passwordInput.type = "text";
      }
    }
</script>
</body>
</html>
