<?php
require_once "../backend/config_session.php";
if (isset($_POST['id'], $_POST['name'], $_POST['price'], $_POST['request'], $_POST['quantity'], $_POST['removedIngredients'], $_POST['addedIngredients'])) {
    $itemId = $_POST['id'];
    $itemName = $_POST['name'];
    $itemPrice = $_POST['price'];
    $itemRequest = $_POST['request'];
    $quantity = (int)$_POST['quantity'];
    $removedIngredients = $_POST['removedIngredients'];
    $addedIngredients = $_POST['addedIngredients'];

    if ($quantity <= 0) {
        echo json_encode(['success' => false, 'error' => 'Invalid quantity']);
        exit;
    }

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    $itemIndex = -1;
    foreach ($_SESSION['cart'] as $index => $item) {
        if (count($removedIngredients)  > count($item['removedIngredients'])) {
            $removedDifference =  array_diff($removedIngredients, $item['removedIngredients']);
        } else {
            $removedDifference =  array_diff($item['removedIngredients'], $removedIngredients);
        }

        if (count($addedIngredients)  > count($item['addedIngredients'])) {
            $addedDifference =  array_diff($addedIngredients, $item['addedIngredients']);
        } else {
            $addedDifference =  array_diff($item['addedIngredients'], $addedIngredients);
        }
        if ($item['id'] == $itemId && $itemRequest == $item['request'] && empty($removedDifference) && empty($addedDifference)) {
            $itemIndex = $index;
            break;
        }
    }
    if ($itemIndex != -1) {
        error_log('Current quantity: ' . $_SESSION['cart'][$itemIndex]['quantity'] . ' Adding: ' . $quantity);
        $_SESSION['cart'][$itemIndex]['quantity'] += $quantity;
    } else {
        $item = array(
            'id' => $itemId,
            'name' => $itemName,
            'price' => $itemPrice,
            'request' => $itemRequest,
            'quantity' => $quantity,
            'removedIngredients' => $removedIngredients,
            'addedIngredients' => $addedIngredients,
            'indexID' => count($_SESSION['cart']),
        );

        $_SESSION['cart'][] = $item;
    }
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid data']);
}
