<?php
session_start();

// Check if the item ID is received
if (isset($_POST['itemId']) && is_numeric($_POST['itemId'])) {
    $itemId = $_POST['itemId'];

    $itemIndex = -1;
    foreach ($_SESSION['cart'] as $index => $item) {
        if ($item['id'] == $itemId) { // Compare the item ID
            $itemIndex = $index;
            break;
        }
    }
    
    if ($itemIndex != -1) {
        // Remove the item from the cart
        unset($_SESSION['cart'][$itemIndex]);

        // Return the updated cart data as JSON
        echo json_encode(['success' => true, 'cart' => $_SESSION['cart']]);
    } else {
        // Return a message indicating that the item was not found
        echo json_encode(['success' => false, 'message' => 'Item not found in cart']);
    }
} else {
    // Return a message indicating an invalid item ID
    echo json_encode(['success' => false, 'message' => 'Invalid item ID' . $_POST['item']]);
}
?>
