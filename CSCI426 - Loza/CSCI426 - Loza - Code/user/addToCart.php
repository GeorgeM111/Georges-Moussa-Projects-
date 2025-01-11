<?php
session_start();

// Check if the product data is received
if (isset($_POST['id'], $_POST['name'], $_POST['price'], $_POST['cover'], $_POST['quantity'])) {
    $productId = $_POST['id'];
    $productName = $_POST['name'];
    $productPrice = $_POST['price'];
    $productCover = $_POST['cover'];
    $quantity = $_POST['quantity'];

    // Initialize the cart if it doesn't exist in the session
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Check if the product is already in the cart
    $productIndex = -1;
    foreach ($_SESSION['cart'] as $index => $item) {
        if ($item['id'] == $productId && $productCover == $item['cover']) {
            $productIndex = $index;
            break;
        }
    }

    // If the product is in the cart, update the quantity; otherwise, add it to the cart
    if ($productIndex != -1) {
        $_SESSION['cart'][$productIndex]['quantity'] += $quantity;
    } else {
        // Add the product to the cart
        $product = array(
            'id' => $productId,
            'name' => $productName,
            'price' => $productPrice,
            'cover' => $productCover,
            'quantity' => $quantity
        );

        $_SESSION['cart'][count($_SESSION['cart'])] = $product;	
    }

    // Return a success response
    echo json_encode(['success' => true]);
} else {
    // Return an error response if the data is not received
    echo json_encode(['success' => false, 'error' => 'Invalid data']);
}
?>
