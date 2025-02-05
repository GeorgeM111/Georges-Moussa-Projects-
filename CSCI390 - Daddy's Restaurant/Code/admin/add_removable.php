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
    $stmt = $conn->prepare("INSERT INTO Removable (ITEM_ID, INGREDIENT_ID) VALUES (?, ?)");
    $stmt->bind_param("ii", $item_id, $ingredient_id);
    if ($stmt->execute()) {
        echo "Removable ingredient added successfully.";
    } else {
        http_response_code(500);
        echo "Error adding removable ingredient.";
    }
    $stmt->close();
    $conn->close();
} else {
    http_response_code(405);
    echo "Method not allowed.";
}
