<?php
// Include necessary functions
include "../Database/db.php";

// Function to export cart items to CSV
function exportCartToCSV($cartItems) {
    $csvContent = '';
    $header = array_keys($cartItems[0]);
    $header[] = 'Total Price'; // Add a new column for Total Price
    $csvContent .= implode(',', $header) . "\n";

    foreach ($cartItems as $item) {
        $itemPrice = $item['price'] * $item['quantity']; // Calculate the total price for the item
        $item['Total Price'] = $itemPrice; // Add the total price to the item data
        $csvContent .= implode(',', $item) . "\n";
    }

    return $csvContent;
}

if (isset($_POST['cart'])) {
	$cartItems = json_decode($_POST['cart'], true);
    if (is_array($cartItems)) {
        $csvContent = '';
        if (!empty($cartItems)) {
            $header = array_keys($cartItems[0]);
            $csvContent .= implode(',', $header) . "\n";

            foreach ($cartItems as $item) {
                $csvContent .= implode(',', $item) . "\n";
            }
        }

        // Send the CSV content to the client
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="cart_items.csv"');
        echo $csvContent;
        exit; // Add this line to prevent further execution
    } else {
        echo "Invalid cart data.";
    }
} else {
    echo "Invalid request.";
}
?>
