<?php
// saveOrder.php
session_start();
include "../Database/db.php";

// Check if 'cart' index is set in the session
if (isset($_SESSION['cart'])) {
    if($_SESSION['loginCredentials']){
    $customerId =$_SESSION['loginCredentials']['id'];
    $query = "INSERT INTO orders (`customer_id`, `status`, `created_at`) VALUES ('$customerId', 'Pending', NOW())";
    $result = mysqli_query($conn, $query);
       // Check if the order insertion was successful
       if ($result) {
        $orderID = mysqli_insert_id($conn);
        foreach ($_SESSION['cart'] as $item) {
            $productId = $item['id'];
            $quantity = $item['quantity'];
			$cover = $item['cover'];
			$price = $item['price'];
            $query3 = "INSERT INTO order_details (order_id, chocolate_id, quantity, cover, price) VALUES ('$orderID', '$productId', '$quantity', '$cover', '$price')";
            mysqli_query($conn, $query3);
        }
       
    }

        //unset($_SESSION['cart']);

        // Set a session variable for the success message
        $_SESSION['success_message'] = 'Thank you for shopping in our store';

        // Redirect the user to the index page
        header("Location: result.php");
        exit; // Make sure to exit after redirection
    } else {
        // Return an error response if the 'orders' insertion fails
        echo json_encode(['success' => false, 'error' => 'Error submitting order']);
    }
} else {
    // Return an error response if 'cart' index is not set
    echo json_encode(['success' => false, 'error' => 'Cart is empty']);
}
?>
