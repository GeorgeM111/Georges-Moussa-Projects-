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
    include 'header.php';
    include "../Database/db.php";

    if (isset($_GET['chocID'])) {
        $chocID = $_GET['chocID'];

        $sql = "SELECT * FROM chocolates WHERE id = $chocID";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
    ?>

            <div class="container-xxl pt-5 pb-2">
                <div class="container">
                    <div class="text-center mx-auto" style="max-width: 600px;">
                        <h1 class="mb-1 pb-0 italiana-regular text-bold fs-1 wow slideInUp"><?php echo $row['name']; ?></h1>
                        <p class="italianno-regular fs-2 wow slideInUp mb-0" data-wow-duration="1.5s"><?php echo $row['desc']; ?></p>
                        <p class="italiana-regular text-bold text-center fs-6 wow slideInUp"> Weight: <?php echo $row['weight']; ?> <small>g</small> , Price : <?php echo $row['price']; ?> $ </p>
                    </div>
                    <div class="d-block mx-auto w-50">
                        <div class="row">
                            <div class="col-sm-6 mb-3 border border-dark wow fadeInLeft">
                                <img src="img/store/<?php echo $row['name']; ?>.jpg" class="w-100" alt="<?php echo $row['name']; ?>">
                            </div>
                            <div class="col-sm-6 mb-3 border border-dark wow fadeInRight">
                                <img src="img/covers/coverGold.jpg" width="100%" class="w-100" alt="cover" id="MainImg">
                            </div>
                        </div>
                    </div>
                    <h4 class="text-center italiana-regular text-bold wow slideInUp">Select Cover Color</h4>
                        <div class="d-flex justify-content-center align-items center mb-3">
                        <button type="button" class="btn btn-gold wow fadeInLeft mx-2" id="Gold" onclick="changePic('Gold')" data-wow-delay="0.5s"></button>
                        <button type="button" class="btn btn-danger wow slideInLeft mx-2" id="Red" onclick="changePic('Red')"></button>
                        <button type="button" class="btn btn-silver wow slideInRight mx-2" id="Silver" onclick="changePic('Silver')"></button>
                        <button type="button" class="btn btn-brown wow fadeInRight mx-2"id="Brown" onclick="changePic('Brown')" data-wow-delay="0.5s"></button>
                        </div>
                    <input type="hidden" id="pID" value="<?php echo $row['id'] ?>">
                    <input type="hidden" id="pName" value="<?php echo $row['name']; ?>">
                    <input type="hidden" id="pPrice" value="<?php echo $row['price']; ?>">
                    <input type="hidden" id="pCover" value="Gold">
                    <div class="text-center  wow slideInUp">
                    <input type="number" value="1" min="1" id="quantity"><br>
                    <button id="addToCartBtn" class="btn btn-brown text-bold italiana-regular text-white mt-3" onclick="addToCart()">Add To Cart</button>
                    </div>
                </div>

            </div>
    <?php
        }
    } else {
        echo "Product does not exist";
    }

    include 'footer.php';
    ?>
    <script src="js/jquery.js"></script>
    <script>
        function addToCart() {
            let pID = document.getElementById("pID").value;
            let pName = document.getElementById("pName").value;
            let pPrice = document.getElementById("pPrice").value;
            let pCover = document.getElementById("pCover").value;
            let quantity = document.getElementById("quantity").value;

            console.log("Data being sent:", {
                id: pID,
                name: pName,
                price: pPrice,
                cover: pCover,
                quantity: quantity
            });

            $.ajax({
                type: 'POST',
                url: 'addToCart.php',
                data: {
                    id: pID,
                    name: pName,
                    price: pPrice,
                    cover: pCover,
                    quantity: quantity
                },
                success: function(response) {
                    console.log('Server response:', response); // Log the response to the console
                    if (response.trim().toLowerCase().includes('{"success":true}')) {
                        alert('Product added to cart!');
                        window.location = 'cart.php'; // Redirect to cart.php upon success
                        exit();
                    } else {
                        alert('Failed to add product to cart');
                    }
                },
                error: function(error) {
                    console.error('Error adding product to cart:', error);
                }
            });
        }

        function changePic(ID) {
            document.getElementById("MainImg").src = "img/covers/cover" + ID+".jpg";
            document.getElementById("pCover").value=ID;
        }
    </script>
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