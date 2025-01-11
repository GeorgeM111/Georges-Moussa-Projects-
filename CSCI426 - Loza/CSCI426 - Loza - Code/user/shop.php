<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <title>Loza Chocolatier</title>
    <link href="img/logo.jpg" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="style/animate.css">
</head>
<body>
    <?php
    include "../Database/db.php";


    $query = "SELECT * FROM chocolates";
    $result = $conn->query($query);

    // Check if there are chocolates
    if ($result->num_rows > 0) {
        $chocolates = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $chocolates = array(); // Empty array if no chocolates
    }

    // Close the database connection
    $conn->close();
    ?>


    <!-- Header -->
    <?php include "header.php" ?>
    <!-- End Header -->

    <!-- Products -->
    <div class="container-fluid py-5 px-3"> <!--fixed error change this line -->
            <div class="text-center mx-auto" style="max-width: 640px;">
                <h1 class="pb-0 italiana-regular text-bold fs-1 wow slideInUp">Our Chocolates</h1>
                <p class="italianno-regular fs-2 wow slideInUp" data-wow-duration="1.5s">Experience the perfect blend of smooth, creamy richness in every piece we craft.</p>
            </div>
            <?php
            $rowCounter = 0;
            foreach ($chocolates as $choc) :
                if ($rowCounter == 0) {
                    echo '<div class="row mb-3">';
                } ?>
                <div class="col-lg-3 col-md-6 col-sm-12 col-12 wow fadeInUp">  <!--fixed error change this line -->
                    <div class="card">
                        <img class="card-img-top" src="img/store/<?php echo $choc['name']; ?>.jpg" alt="Card image">
                        <div class="card-body">
                            <h6 class="card-title text-center italiana-regular text-bold text-nowrap"><?php echo $choc['name']; ?></h6>
                            <h3 class="card-text text-center text-bold italianno-regular"><?php echo $choc['price']; ?> $</h3>
                            <div class="d-grid">
                                <button href="#" class="btn btn-border italiana-regular btn-block text-bold" onclick="window.location.href='sproduct.php?chocID=<?php echo $choc['id'] ?>';">Add To Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                $rowCounter++;
                if ($rowCounter == 4) {
                    echo '</div>';
                    $rowCounter = 0;
                }
            endforeach; ?>
    </div>

    <!-- End Products-->

    <!-- Footer -->
    <?php include "footer.php" ?>
    <!-- End Footer -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new WOW({
                resetOnScroll: true
            }).init();
        });
    </script>
</body>

</html>