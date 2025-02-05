<!DOCTYPE html>
<html lang="en">
<?php require_once "../backend/config_session.php" ?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Daddy's Restaurant</title>
    <link href="images/logo.jpg" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/signup.css" rel="stylesheet">
    <style>
        .bg {
            background: black;
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
                <div class="col-xl-6">
                    <div class="card rounded-3 text-black">
                        <div class="card-body p-md-5 mx-md-4">
                            <div class="text-center">
                                <h3 class="pacifico fs-3 logo-brand"><i class="fa fa-utensils me-3"></i>Daddy's Restaurant</h3>
                                <h4 class="mt-1 pb-1">Enter Reset Token</h4>
                                <p class="text-warning"><small>if your email is registered into our website weill send you an email with a token. If you can't find the email, please try checking the Spam/Junk emails.</small></p>
                            </div>

                            <form action="../backend/forgotPassword_backend/verifyToken.php" method="post">
                                <?php
                                if (isset($_SESSION['tokenExpired'])) {
                                    echo '<p class="text-danger"><small>' . $_SESSION['tokenExpired'] . '</small></p>';
                                    unset($_SESSION['tokenExpired']);
                                }
                                if (isset($_SESSION['tokenIncorrect'])) {
                                    echo '<p class="text-danger"><small>' . $_SESSION['tokenIncorrect'] . '</small></p>';
                                    unset($_SESSION['tokenIncorrect']);
                                }
                                ?>
                                <div class="form-outline mb-4">
                                    <label class="form-label" for="token">Enter Reset Token</label>
                                    <input type="text" id="token" name="token" class="form-control" placeholder="Enter the reset token" required>
                                </div>

                                <div class="text-center pt-1 mb-3 pb-1">
                                    <button class="btn btn-warning btn-block fa-lg" type="submit">Verify Token</button>
                                </div>
                            </form>

                            <div class="d-flex align-items-center justify-content-center pb-4">
                                <p class="mb-0 me-2"><a href="forgotPassword.php" class="text-danger">Didn't receive a token? Request again</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>