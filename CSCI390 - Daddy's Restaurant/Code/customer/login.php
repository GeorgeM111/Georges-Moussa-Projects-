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
    <?php require_once "../backend/config_session.php";
    include "functions.php";
    include "../backend/login_backend/login_view.php" ?>
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
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">
                                    <div class="text-center">
                                        <h3 class="pacifico fs-3 logo-brand"><i class="fa fa-utensils me-3"></i>Daddy's Restaurant</h3>
                                        <h4 class="mt-1 pb-1">Welcome back !</h4>
                                        <?php printWrongCredentials();
                                        printBlockedPerson() ?>
                                    </div>

                                    <form action="../backend/login_backend/login_server.php" method="post">
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="phoneNumber">Phone Number</label>
                                            <input type="phone" id="phoneNumber" name="phoneNumber" class="form-control" placeholder="Format: 00 000 000" pattern="\d{2} \d{3} \d{3}"
                                                title="Phone Number Example : 71 791 910" required>
                                        </div>
                                        <div class="form-outline mb-1">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" id="password" name="password" class="form-control" placeholder="Please Enter Your Password" required>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center pb-2">
                                            <p class="mb-0 me-2"><a href="../backend/forgotPassword_backend/sendResetLink.php" class="text-primary">Forgot Password </a></p>
                                        </div>
                                        <div class="text-center pt-1 mb-3 pb-1">
                                            <button class="btn btn-warning btn-block fa-lg" type="submit">Log in</button>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">Don't have an account? <a href="signup.php" class="text-danger">Register Now</a></p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center bg">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h3 class="pacifico fs-3 text-center logo-brand text-warning"><i class="fa fa-utensils me-3"></i>Daddy's Restaurant</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>