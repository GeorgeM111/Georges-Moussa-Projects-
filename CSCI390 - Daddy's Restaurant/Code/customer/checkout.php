<!DOCTYPE html>
<html lang="en">
<?php
require_once "../backend/config_session.php";
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) <= 0) {
    header("Location: cart.php");
}
?>

<head>
    <meta charset="utf-8">
    <title>Daddy's Restaurant</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link href="images/logo.jpg" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/checkout.css" rel="stylesheet">
    <style>
        select {
            border-radius: 40px !important;
        }
    </style>
</head>

<body>
    <?php include("navBar.php"); ?>

    <?php printCheckoutItems($conn); ?>
    <?php include("footer.php") ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const dineInButton = document.querySelector('#dineInButton');
        const dineOutButton = document.querySelector('#dineOutButton');
        const dineInForm = document.querySelector('#dineIn');
        const dineOutForm = document.querySelector('#dineOut');

        dineInButton.addEventListener('click', () => {
            dineInForm.classList.toggle('show');
            dineOutForm.classList.remove('show');
        });

        dineOutButton.addEventListener('click', () => {
            dineOutForm.classList.toggle('show');
            dineInForm.classList.remove('show');
        });


        function dineOut() {
            let select = document.getElementById("dineOutSelect");
            let address = document.getElementById("address");
            let addressInput = document.getElementById("addressInput");
            if (select.value == "Pickup") {
                address.style.display = "none";
                tableNbInput.removeAttribute('required');

            } else {
                address.style.display = "block";
                addressInput.setAttribute('required', 'required');
            }
        }
    </script>

</body>

</html>