<?php
require_once "../backend/config_session.php";
if (isset($_POST['itemId']) && is_numeric($_POST['itemId'])) {
    $itemId = $_POST['itemId'];

    $itemIndex = -1;
    foreach ($_SESSION['cart'] as $index => $item) {
        if ($item['id'] == $itemId) {
            $itemIndex = $index;
            break;
        }
    }
 
    if ($itemIndex != -1) {
        unset($_SESSION['cart'][$itemIndex]);
        echo json_encode(['success' => true, 'cart' => $_SESSION['cart']]);
        if(count($_SESSION['cart']) ==0){
            unset($_SESSION['cart']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Item not found in cart']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid item ID' . $_POST['item']]);
}
?>
