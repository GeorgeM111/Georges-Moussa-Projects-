<?php
require_once("../backend/signup_backend/signup_view.php");
require_once("../backend/config_session.php")
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daddy's Restaurant</title>
  <link href="images/logo.jpg" rel="icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/signup.css" rel="stylesheet">

  <style>
    .bg {
      background: black
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0 pb-lg-3 pt-lg-3 sticky-top wow fadeInDown">
    <a href="home.php" class="navbar-brand p-0 wow fadeInLeft" data-wow-delay="0.5s">
      <h3 class="pacifico fs-3 logo-brand"><i class="fa fa-utensils me-3"></i>Daddy's Restaurant</h3>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
      <span class="fa fa-bars"></span>
    </button>
  </nav>
  <section class="h-100 gradient-form" style="background-color: #eee;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-10">
          <div class="card rounded-3 text-black">
            <div class="row g-0">
              <div class="col-lg-6 d-flex align-items-center bg">
                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                  <h3 class="pacifico fs-3 text-center logo-brand text-warning"><i class="fa fa-utensils me-3"></i>Daddy's Restaurant</h3>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="card-body p-md-5 mx-md-4">
                  <div class="text-center">
                    <h3 class="pacifico fs-3 logo-brand"><i class="fa fa-utensils me-3"></i>Daddy's Restaurant</h3>
                    <h4 class="mt-1 pb-1">Welcome Aboard! !</h4>
                  </div>

                  <form action="../backend/signup_backend/signupServer.php" method="post" id="signUpForm">
                    <div class="<?php if (isset($_SESSION['signUpErrors']['emptyName'])) {
                                  echo "mb-1";
                                } else echo "mb-3"; ?>">
                      <label class="form-label">Full Name</label>
                      <input type="text" class="form-control" name="fullName" placeholder="Enter Your Full Name" value="<?php printFullName() ?>">
                    </div>
                    <?php printEmptyName() ?>
                    <div class="<?php if (isset($_SESSION['signUpErrors']['invalidEmail']) || isset($_SESSION['signUpErrors']['registeredEmail'])) {
                                  echo "mb-1";
                                } else echo "mb-3"; ?>">
                      <label class="form-label">Email Address</label>
                      <input type="email" class="form-control" name="email" placeholder="Enter Your Email Address" value="<?php printEmail() ?>">
                    </div>
                    <?php printInvalidEmail();
                    printRegisteredEmail(); ?>
                    <div class="<?php if (isset($_SESSION['signUpErrors']['emptyPhone']) || isset($_SESSION['signUpErrors']['registeredPhone'])) {
                                  echo "mb-1";
                                } else echo "mb-3"; ?>">
                      <label class="form-label">Phone Number</label>
                      <br>
                      <input type="tel" placeholder="Format : 00 000 000" class="form-control" id="phone" name="phoneNumber" pattern="\d{2} \d{3} \d{3}" value="<?php printPhoneNumber() ?>" required>
                    </div>
                    <?php printEmptyPhone();
                    printRegisteredPhoneNumber();
                    ?>
                    <div class="<?php if (isset($_SESSION['signUpErrors']['emptyPassword']) || isset($_SESSION['signUpErrors']['shortPassword'])) {
                                  echo "mb-1";
                                } else echo "mb-3"; ?>">
                      <label class="form-label">Password</label>
                      <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                    </div>
                    <?php printEmptyPassword() ?>
                    <?php printShortPassword() ?>
                    <div class="<?php if (isset($_SESSION['signUpErrors']['unmatchedPasswords'])) {
                                  echo "mb-1";
                                } else echo "mb-3"; ?>">
                      <label class="form-label"> Confirm Password</label>
                      <input type="password" class="form-control" id="Cpassword" name="Cpassword" placeholder="retype your password">
                    </div>
                    <?php printUnmatchedPasswords() ?>
                    <div class="show-forgot d-flex justify-content-center  mb-2">
                      <label><input type="checkbox" onchange="showHide()">Show Password</label>
                    </div>
                    <div class="d-flex justify-content-center"><a href="login.php" class="text-dark text-decoration-none">Already Have an account ? Click Here!</a></div>
                    <div class="d-flex justify-content-center">
                      <button class="btn btn-warning py-2">Sign up</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php include("footer.php"); ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    let passwordInput = document.getElementById("password");
    let CpasswordInput = document.getElementById("Cpassword");

    function showHide() {
      if (passwordInput.type === "text") {
        passwordInput.type = "password";
      } else if (passwordInput.type === "password") {
        passwordInput.type = "text";
      }
      if (CpasswordInput.type === "text") {
        CpasswordInput.type = "password";
      } else if (CpasswordInput.type === "password") {
        CpasswordInput.type = "text";
      }
    }
  </script>


</body>

</html>