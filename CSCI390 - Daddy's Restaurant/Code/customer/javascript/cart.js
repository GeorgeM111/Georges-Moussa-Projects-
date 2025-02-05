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
    document.getElementById("totalItems").innerText = uniqueItems;
    document.getElementById("totalPrice").innerText = total.toFixed(2) + " $";
}

// Attach the change event listener to quantity inputs
document.querySelectorAll('.quantity-input').forEach(function (input) {
    input.addEventListener('change', function () {
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
        success: function (response) {
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
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
            alert('Error removing item. Please try again.');
        }
    });
}