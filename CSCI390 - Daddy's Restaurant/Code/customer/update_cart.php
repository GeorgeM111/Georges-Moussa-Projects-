<?php
require_once "../backend/config_session.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = intval($_POST['product_id']);
    $newQuantity = intval($_POST['quantity']);

    if (isset($_SESSION['cart']) && array_key_exists($productId, $_SESSION['cart'])) {
        $_SESSION['cart'][$productId]['quantity'] = $newQuantity;
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}
?>
