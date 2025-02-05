<!DOCTYPE html>
<html lang="en">
<?php require_once "../backend/config_session.php"; ?>
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
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/animate.css">
    <style>
        .addToCart {
            top: -25% !important;
            right: 60% !important;
            z-index: 999;
        }
    </style>
</head>

<body>
    <?php include("navBar.php"); ?>

    <div class="container-fluid py-5">
        <div id="menu-body" class="container">
            <div class="text-center wow slideInDown">
                <h1 class="pacifico text-center text-warning mb-3">Our Menu</h1>
                <div class="ps-4"> <img src="images/img.png" class="image-fluid mx-auto d-block w-75 h-50" alt=""> </div>
            </div>
            <div class="d-flex justify-content-center wow fadeInDown" id="selectionDiv">
                <select name="CategorySelection" class="" id="CategorySelection" onchange="toggleCategories()">
                    <?php printCategoryOptions($conn); ?>
                </select>
            </div>
            <?php
            printItems($conn)
            ?>
        </div>
    </div>
    <?php include "footer.php" ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <?php
    if (isset($_SESSION['orderPlacedSuccessfully'])) {
        echo "<script>alert('{$_SESSION['orderPlacedSuccessfully']}');</script>";
        unset($_SESSION['orderPlacedSuccessfully']);
    }
?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new WOW({
                resetOnScroll: true
            }).init();
        });

        function toggleCategories() {
            let options = document.getElementsByName("options");
            let categories = document.getElementsByName("categories");

            for (let i = 0; i < options.length; i++) {
                if (options[i].selected) {
                    for (let j = 0; j < categories.length; j++)
                        categories[j].style.display = "none";
                    categories[i].style.display = "block";
                    break;
                }
            }
        }
    </script>

</body>

</html>