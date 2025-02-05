<?php
require_once("../database/db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_id = isset($_POST['item_id']) ? (int) $_POST['item_id'] : 0;
    $ingredient_id = isset($_POST['ingredient_id']) ? (int) $_POST['ingredient_id'] : 0;
    if ($item_id <= 0 || $ingredient_id <= 0) {
        http_response_code(400);
        echo "Invalid parameters.";
        exit();
    }
    $stmt = $conn->prepare("DELETE FROM Addable WHERE ITEM_ID = ? AND INGREDIENT_ID = ?");
    $stmt->bind_param("ii", $item_id, $ingredient_id);
    if ($stmt->execute()) {
        echo "Addable ingredient removed successfully.";
    } else {
        http_response_code(500);
        echo "Error removing addable ingredient.";
    }
    $stmt->close();
    $conn->close();
} else {
    http_response_code(405);
    echo "Method not allowed.";
}
