<!DOCTYPE html>
<html lang="en">
<?php require_once "../backend/config_session.php"; ?>

<head>
    <meta charset="utf-8">
    <title>Daddy's Restaurant</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <link href="images/logo.jpg" rel="icon">
    <meta content="" name="description">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        @media (min-width: 500px) and (max-width: 768px) {
            #itemImg {
                width: 70% !important;
            }
        }
    </style>
</head>

<body>
    <?php include("navBar.php"); ?>
    <div class="container-fluid p-0 mx-sm-0">
        <?php
        if (isset($_GET['itemID'])) {
            $itemID = $_GET['itemID'];

            $sql = "SELECT * FROM item WHERE ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $itemID);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();

            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);
        ?>
                <button class="btn btn-warning mt-2 ms-2 ms-sm-3 ms-md-5" onclick="goBack()">Go Back</button>
                <div class="row mx-sm-5 mt-1 mx-2">
                    <div class="col-12 col-sm-12 col-md-6">
                        <h3 class="text-center text-md-start pacifico text-sm-center"> <span class="border-bottom border-black border-3"><?php echo $row['NAME']; ?> : <span id="itemPrice"><?php echo $row['PRICE']; ?></span> $</span></h3>
                    </div>
                    <div class="col-12 col-sm-12 col-md-6 text-center text-sm-center text-md-end  mt-3 mt-sm-3 mt-md-0">
                        <button class="btn btn-warning" onclick="addToCart()">Add To Cart</button>
                    </div>
                </div>
                <div class="mx-5 mt-4">
                    <div class="row">
                        <div class="col-12 col-sm-12 text-center col-md-3">
                            <img src="images/itemsImg/<?php echo $row['IMAGE'] ?>" class="img-fluid w-100" alt="<?php echo $row['NAME']; ?>" id="itemImg">
                        </div>
                        <div class="col-12 col-sm-9 mt-3 mt-sm-0 mx-auto d-block mt-md-0 mt-sm-3 mt-3">
                            <h5 class="pacifico">Write down any request</h5>
                            <textarea class="w-100 mx-auto d-block" id="pRequest"></textarea>
                            <div class="row mt-2">
                                <div class="col-12 col-sm-12 col-md-6">
                                    <input type="hidden" id="pID" value="<?php echo $row['ID'] ?>">
                                    <input type="hidden" id="pName" value="<?php echo $row['NAME'] ?>">
                                    <input type="hidden" id="pPrice" value="<?php echo $row['PRICE'] ?>">
                                    <input type="hidden" id="pQuantity" value="1">
                                    <?php
                                    $removableSql = "SELECT INGREDIENT.ID,INGREDIENT.NAME,INGREDIENT.PRICE FROM ingredient,removable,ITEM WHERE (ITEM_ID=ITEM.ID  AND INGREDIENT_ID=ingredient.ID) AND ITEM.ID= ? ;";
                                    $stmt2 = $conn->prepare($removableSql);
                                    $stmt2->bind_param("i", $row['ID']);
                                    $stmt2->execute();
                                    $resultRemovable = $stmt2->get_result();
                                    $stmt2->close();
                                    if ($resultRemovable->num_rows > 0) :
                                    ?>
                                        <h5 class="pacifico text-center">Removable Ingredients</h5>
                                        <ul class="list-group">
                                            <?php while ($row2 = $resultRemovable->fetch_assoc()) : ?>
                                                <li class="list-group-item">
                                                    <h5 class="d-flex justify-content-between align-items-center pb-0">
                                                        <span><?php echo $row2['NAME'] ?></span>
                                                        <div>
                                                            <button class="border-0 bg-white" onclick="toggleIngredient(<?php echo $row2['ID'] ?>,<?php echo $row2['PRICE'] ?>,'removable')" id="<?php echo $row2['ID'] ?>"><i class="fa-solid fa-plus bg-warning fs-6 rounded-pill p-1"></i></button>
                                                        </div>
                                                    </h5>
                                                </li>

                                            <?php endwhile; ?>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                                <div class="col-12 col-sm-12 col-md-6">
                                    <?php
                                    $addableSql = "SELECT INGREDIENT.ID,INGREDIENT.NAME,INGREDIENT.PRICE FROM ingredient,addable,ITEM WHERE (ITEM_ID=ITEM.ID  AND INGREDIENT_ID=ingredient.ID) AND ITEM.ID= ? ;";
                                    $stmt2 = $conn->prepare($addableSql);
                                    $stmt2->bind_param("i", $row['ID']);
                                    $stmt2->execute();
                                    $resultAddable = $stmt2->get_result();
                                    $stmt2->close();
                                    if ($resultAddable->num_rows > 0) :
                                    ?>
                                        <h5 class="pacifico text-center">Addable Ingredients</h5>
                                        <ul class="list-group">
                                            <?php while ($row2 = $resultAddable->fetch_assoc()) : ?>
                                                <li class="list-group-item">
                                                    <h5 class="d-flex justify-content-between align-items-center pb-0">
                                                        <span><?php echo $row2['NAME'] ?></span>
                                                        <div>
                                                            <span class="text-warning me-2"><span id="addRemove-<?php echo $row2['ID'] ?>">+</span> <?php echo $row2['PRICE'] ?> $</span>
                                                            <button class="border-0 bg-white" onclick="toggleIngredient(<?php echo $row2['ID'] ?>,<?php echo $row2['PRICE'] ?>,'addable')" id="<?php echo $row2['ID'] ?>"><i class="fa-solid fa-plus bg-warning fs-6 rounded-pill p-1"></i></button>
                                                        </div>
                                                    </h5>
                                                </li>
                                            <?php endwhile; ?>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mt-4 mb-3">
                                <div class="mt-1 me-1">
                                    <p class="d-inline">Quantity : <span id="quantity">1</span></p>
                                </div>
                                <button class="btn btn-secondary pt-0 pb-0 me-1" onclick="increaseQuantity()"><i class="fa-solid fa-plus"></i></button>
                                <button class="btn btn-secondary " onclick="decreaseQuantity()"><i class="fa-solid fa-minus"></i></button>
                            </div>

                        </div>
                    </div>
                </div>
    </div>

<?php
            } else {
                echo "Product does not exist";
            }
        } else {
            echo "Product does not exist";
        }

        include 'footer.php';
?>

<script src="javascript/jquery-3.1.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new WOW({
            resetOnScroll: true
        }).init();
    });

    let removableIngredients = [];
    let addableIngredients = [];

    function toggleIngredient(ingredientID, ingredientPrice, type) {
        let button = document.getElementById(ingredientID);
        let icon = button.querySelector("i");
        let indicator = document.getElementById("addRemove-" + ingredientID);

        if (icon.classList.contains("fa-plus")) {
            icon.classList.remove("fa-plus");
            icon.classList.add("fa-minus");

            if (type === 'addable') {
                let itemPriceElem = document.getElementById("itemPrice");
                itemPriceElem.innerHTML = (parseFloat(itemPriceElem.innerHTML) + ingredientPrice).toFixed(2);
                if (!addableIngredients.includes(ingredientID)) {
                    addableIngredients.push(ingredientID);
                }
                const remIndex = removableIngredients.indexOf(ingredientID);
                if (remIndex > -1) {
                    removableIngredients.splice(remIndex, 1);
                }
            } else if (type === 'removable') {
                if (!removableIngredients.includes(ingredientID)) {
                    removableIngredients.push(ingredientID);
                }
                const addIndex = addableIngredients.indexOf(ingredientID);
                if (addIndex > -1) {
                    addableIngredients.splice(addIndex, 1);
                }
            }
        } else if (icon.classList.contains("fa-minus")) {
            icon.classList.remove("fa-minus");
            icon.classList.add("fa-plus");

            if (indicator) {
                indicator.innerHTML = "+";
            }

            if (type === 'addable') {
                let itemPriceElem = document.getElementById("itemPrice");
                itemPriceElem.innerHTML = (parseFloat(itemPriceElem.innerHTML) - ingredientPrice).toFixed(2);
                const index = addableIngredients.indexOf(ingredientID);
                if (index > -1) {
                    addableIngredients.splice(index, 1);
                }
            } else if (type === 'removable') {
                const index = removableIngredients.indexOf(ingredientID);
                if (index > -1) {
                    removableIngredients.splice(index, 1);
                }
            }
        }
    }


    function addToCart() {
        let pID = parseInt(document.getElementById("pID").value);
        let pName = document.getElementById("pName").value;
        let pPrice = parseFloat(document.getElementById("itemPrice").innerHTML);
        let pRequest = (document.getElementById("pRequest").value).trim();
        let quantity = parseInt(document.getElementById("pQuantity").value);
        if (removableIngredients.length === 0) {
            removableIngredients.push(0);
        }
        if (addableIngredients.length === 0) {
            addableIngredients.push(0)
        }

        console.log("Data being sent:", {
            id: pID,
            name: pName,
            price: pPrice,
            request: pRequest,
            quantity: quantity,
            removedIngredients: removableIngredients,
            addedIngredients: addableIngredients
        });

        $.ajax({
            type: 'POST',
            url: 'addToCart.php',
            data: {
                id: pID,
                name: pName,
                price: pPrice,
                request: pRequest,
                quantity: quantity,
                removedIngredients: removableIngredients,
                addedIngredients: addableIngredients
            },
            success: function(response) {
                console.log('Server response:', response);
                if (response.trim().toLowerCase().includes('{"success":true}')) {
                    alert('Product added to cart!');
                    window.location = 'cart.php';
                } else {
                    alert('Failed to add product to cart');
                }
            },
            error: function(error) {
                console.error('Error adding product to cart:', error);
            }
        });
    }

    function increaseQuantity() {
        let quantityElement = document.getElementById("quantity");
        let quantity = parseInt(quantityElement.innerHTML);
        let pQuantity = document.getElementById("pQuantity");
        quantity++;
        pQuantity.value = quantity;
        quantityElement.innerHTML = quantity;
    }

    function decreaseQuantity() {
        let quantityElement = document.getElementById("quantity");
        let quantity = parseInt(quantityElement.innerHTML);
        let pQuantity = document.getElementById("pQuantity");
        if (quantity > 1) {
            quantity--;
        }
        pQuantity.value = quantity;
        quantityElement.innerHTML = quantity;
    }



    function goBack() {
        window.location.href = "menu.php";
    }
</script>
</body>

</html>