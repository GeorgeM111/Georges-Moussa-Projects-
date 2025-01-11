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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="style/animate.css">
    <style>

    #scroll{
        display:none;
    }
 @media (max-width: 341px) {
            #scroll {
                display: block !important;
            }
        }
    </style>
</head>

<body>
    <?php
    include "header.php";
    include "../Database/db.php";

    if (isset($_SESSION['cart'])) {
        error_log(print_r($_SESSION['cart'], true)); // This will print the contents of $_SESSION['cart'] to the PHP error log
        $numberOfItems = count($_SESSION['cart']);
        $total = 0;

        if ($numberOfItems > 0) { ?>
            <div class="row mt-3 mb-sm-5 mx-3">
                <div class="col-md-8  mt-6" id="AddedItems">
                    <div class="table-responsive">
                        <table class="table italiana-regular text-bold">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="pe-0" id="tableBody">
                                <?php
                                $i = 0;
                                foreach ($_SESSION['cart'] as $item) { ?>
                                    <tr class="rows">
                                        <td>
                                            <img class="flex-shrink-0 img-fluid rounded" src="img/store/<?php echo $item['name']; ?>.jpg" alt="Product Image" style="width: 80px;">
                                        </td>
                                        <td>
                                            <?php echo $item['name']; ?> with a <?php echo $item['cover']; ?> cover.
                                        </td>
                                        <td>
                                            <span class="price">
                                                <?php echo $item['price']; ?>
                                            </span> $
                                        </td>
                                        <td class="w-25">
                                            <input type="number" min="1" class="w-100 arial quantity-input"  value="<?php echo $item['quantity']; ?>" id="quantity_<?php echo $i; ?>">
                                            <a href="#" class="remove text-danger fs-3 text-center" onclick="removeItem(<?php echo $item['id']; ?>)"><i class="fa-solid fa-circle-xmark"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                    $itemPrice =floatval($item['price'])* floatval($item['quantity']);
                                    $total += $itemPrice;
                                    $i++;
                                } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-4 mb-md-0 mb-sm-3 mb-3">
                    <div class="check border bg-white">
                        <div class="mt-3">
                            <h4 class="text-center italiana-regular text-bold fs-3">Summary</h4>
                            <h6 class="d-flex justify-content-between italiana-regular text-bold fs-5  pb-2 me-3 ms-3">
                                <span>Total Items:</span>
                                <span id="totalItems" class="text-secondary"><?php echo $numberOfItems; ?></span>
                            </h6>
                            <div class="d-flex p-0 m-0 justify-content-center my-4">
                                <hr class="w-75 p-0 m-0 summary wow slideInLeft">
                            </div>
                            <h6 class="d-flex justify-content-between  italiana-regular text-bold fs-5 pb-2 me-3 ms-3">
                                <span>Total Price</span>
                                <span id="totalPrice"><?php echo $total; ?> $</span>
                            </h6>
                            <div class="me-5 ms-5 mb-3">
                                    <?php 
                                    $action = "saveOrder.php";
                                    if(!isset($_SESSION['loginCredentials']) && isset($_SESSION['cart'])){
                                        $action = "checkout.php";
                                    } ?>
                                        <form action="<?php echo $action; ?>" method="post">
                                        <div class="d-grid">
                                        <button type="submit" class="btn btn-gold italiana-regular text-bold btn-block checkout">Place Order</button>
                                        </div>
                                        
                                        </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else {
        ?>
            <div class="col-12 mx-auto d-block">
                <div class="d-flex justify-content-center align-items-center">
                    <img src="img/chocolate-black.png" class="mt-4 mb-1" alt="Empty Cart" style="width:14%;">
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <h1 class="display-1 italianno-regular mb-3 mt-0">Cart is empty</h1>
                </div>
            </div>
        <?php
        }
    } else {
        ?>
        <div class="col-12 mx-auto d-block">
            <div class="d-flex justify-content-center align-items-center">
                <img src="img/chocolate-black.png" class="mt-4 mb-1" alt="Empty Cart" style="width:17%;">
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <h1 class="display-1 italianno-regular mb-3 mt-0">Cart is empty</h1>
            </div>
        </div>
    <?php
    }
    include "footer.php";
    ?>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            new WOW({
                resetOnScroll: true
            }).init();
        });

    let quantityInputs = document.getElementsByClassName('quantity-input');
    function handleQuantityChange(event) {
    const newValue = parseInt(event.target.value, 10); 
    if (newValue <= 0) {
        event.target.value = 1;
    }
}

    for( x of quantityInputs){
        x.addEventListener('change', handleQuantityChange);
    }

        document.addEventListener('DOMContentLoaded', function() {
            new WOW({
                resetOnScroll: true
            }).init();
        });


        function removeItem(itemId) {
            $.ajax({
                type: 'POST',
                url: 'remove_item.php',
                data: {
                    itemId: itemId
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert('Item removed successfully');
                        window.location.reload();
                        // Remove the item element from the DOM
                        var itemElement = document.getElementById('item_' + itemId);
                        if (itemElement) {
                            itemElement.remove();
                        }
                    } else {
                        alert(response.message); // Display the error message
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Error removing item. Please try again.');
                }
            });
        }
        function updateTotalPrice() {
    var total = 0;
    var uniqueItems = 0; // Initialize the uniqueItems variable
    var itemTotalPriceElements = document.querySelectorAll('.rows');

    itemTotalPriceElements.forEach(function (element) {
        var quantity = parseInt(element.querySelector('.quantity-input').value, 10);

        if (!isNaN(quantity) && quantity > 0) {
            // If the quantity is greater than 0, it means the item is in the cart
            uniqueItems++;
        }

        var price = parseFloat(element.querySelector('.price').innerText); // Use parseFloat to handle decimal values

        if (!isNaN(price) && !isNaN(quantity)) {
            var itemPrice = price * quantity;
            total += itemPrice;
        }
    });

    // Update the unique items count and total price displayed on the page
    document.getElementById("totalItems").innerText =  uniqueItems;
    document.getElementById("totalPrice").innerText = total.toFixed(2) +" $";
}

// Attach the change event listener to quantity inputs
document.querySelectorAll('.quantity-input').forEach(function (input) {
    input.addEventListener('change', function () {
        updateTotalPrice();
    });
});
    </script>
</body>

</html>