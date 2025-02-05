<!DOCTYPE html>
<html lang="en">
<?php session_start();
require_once("view.php"); ?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <title>Secret Elegance</title>
    <link href="images/logo/emblemBlack.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../customer/style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="style/animate.css">
    <style>
        .navbar .collapse .navbar-nav .active {
            color: var(--gold) !important;
            border-bottom: 3px solid #fff;
        }

        .navbar .collapse .navbar-nav>a:hover {
            color: var(--gold) !important;
        }

        .bg-dark {
            background-color: #000 !important;
        }

        body {
            background-color: gray;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
</head>

<body>


    <div class="container d-flex justify-content-center align-items-center mt-5">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center" style="background: #000;">
                <div class="text-center p-5 p-sm-0">
                    <h2 class="text-warning"><i class="fa fa-utensils me-3"></i>Saj Abou Charbel</h2>
                </div>
            </div>
            <div class="col-md-6  mt-sm-0 mt-3">
                <form action="server.php" method="post">
                    <div class="row align-items-center">
                        <div class="row">
                            <div class="<?php if (!isset($_SESSION['logInErrors']['wrongCredentials'])) echo "mb-4";
                                        else echo "mb-1" ?> text-center sagire text-bold">
                                <h2>Hello There!</h2>
                                <small class="text-danger">Note: This page is only for administrative use</small>

                            </div>
                            <?php printWrongCredentials() ?>
                        </div>
                        <div class="input-group <?php if (!isset($_SESSION['logInErrors']['usernameEmpty'])) echo "mb-3" ?>">
                            <input type="text" class="form-control form-control-lg bg-light fs-6" placeholder="Username" name="username">
                        </div>
                        <?php printUsernameEmpty(); ?>
                        <div class="input-group <?php if (!isset($_SESSION['logInErrors']['passwordEmpty'])) echo "mb-3" ?>">
                            <input type="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password" name="password">
                        </div>
                        <?php printPasswordEmpty(); ?>
                        <div class="input-group mb-2 d-flex justify-content-between align-items-center">
                            <div class="remember d-flex justify-content-center align-items-center">
                                <input type="checkbox" name="remember" class="me-1" id="remember">
                                <small><a onclick="checkRemember()" href="#remember" class="text-decoration-none text-dark sagire text-bold">Remember me</a></small>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <button type="submit" class="btn btn-lg w-100 fs-6 btn-warning">Log In</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        function checkRemember() {
            let remember = document.getElementById("remember");
            if (remember.checked === true) {
                remember.checked = false;
            } else {
                remember.checked = true;
            }
        }
    </script>
</body>

</html>