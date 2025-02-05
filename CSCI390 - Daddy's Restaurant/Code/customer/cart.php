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
    <link href="css/cart.css" rel="stylesheet">

    <style>
        #AddedItems {
            background-color: white;
        }

        input[name="quantity"] {
            width: 40px;
        }
    </style>
</head>

<body>
    <?php include("navBar.php"); ?>
    <div class="container-fluid mb-4">
        <?php printCartItems($conn); ?>
    </div>
    <?php include("footer.php"); ?>

    <script src="javascript/jquery-3.1.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let quantityInputs = document.getElementsByClassName('quantity-input');

        function handleQuantityChange(event) {
            const newValue = parseInt(event.target.value, 10);
            if (newValue <= 0) {
                event.target.value = 1;
            }
        }


        for (x of quantityInputs) {
            x.addEventListener('change', handleQuantityChange);
        }

        function updateTotalPrice() {
            var total = 0;
            var uniqueItems = 0;
            var itemTotalPriceElements = document.querySelectorAll('.rows');

            itemTotalPriceElements.forEach(function(element) {
                var quantity = parseInt(element.querySelector('.quantity-input').value, 10);

                if (!isNaN(quantity) && quantity > 0) {
                    uniqueItems++;
                }

                var price = parseFloat(element.querySelector('.price').innerText);

                if (!isNaN(price) && !isNaN(quantity)) {
                    var itemPrice = price * quantity;
                    total += itemPrice;
                }
            });

            document.getElementById("totalItems").innerText = uniqueItems;
            document.getElementById("totalPrice").innerText = total.toFixed(2) + " $";
        }
        document.querySelectorAll('.quantity-input').forEach(function(input) {
            input.addEventListener('change', function() {
                updateTotalPrice();
            });
        });

        function removeFromCart(itemId) {
            $.ajax({
                type: 'POST',
                url: 'removeFromCart.php',
                data: {
                    itemId: itemId
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert('Item removed successfully');
                        window.location.reload();
                        var itemElement = document.getElementById('item_' + itemId);
                        if (itemElement) {
                            itemElement.remove();
                        }
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Error removing item. Please try again.');
                }
            });
        }

        $(document).ready(function() {
            $('.quantity-input').on('change', function() {
                let productId = $(this).data('order-id');
                let newQuantity = $(this).val();

                if (newQuantity < 1) {
                    $(this).val(1);
                    return;
                }
                $.ajax({
                    url: 'update_cart.php',
                    type: 'POST',
                    data: {
                        product_id: productId,
                        quantity: newQuantity
                    },
                    success: function(response) {
                        if (!response.success) {
                            alert('Failed to update quantity. Please try again.');
                        }
                    },
                    error: function() {
                        alert('An error occurred while updating the cart. Please try again.');
                    }
                });
            });
        });
    </script>
    </script>
</body>

</html>