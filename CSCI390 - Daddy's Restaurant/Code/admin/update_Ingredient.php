<?php
require_once("../database/db.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ingredientID = isset($_POST['ingredientID']) ? (int)$_POST['ingredientID'] : 0;
    $name = isset($_POST['name']) ? trim($_POST['name']) : "";
    $price = isset($_POST['price']) ? (float)$_POST['price'] : 0;

    if ($ingredientID <= 0 || empty($name) || $price <= 0) {
        http_response_code(400);
        echo "All fields are required and price must be greater than 0.";
        exit();
    }

    $stmt = $conn->prepare("UPDATE ingredient SET NAME = ?, PRICE = ? WHERE ID = ?");
    if (!$stmt) {
        http_response_code(500);
        echo "Database error: " . $conn->error;
        exit();
    }
    $stmt->bind_param("sdi", $name, $price, $ingredientID);

    if ($stmt->execute()) {
        echo "Ingredient updated successfully.";
    } else {
        http_response_code(500);
        echo "Error updating ingredient.";
    }

    $stmt->close();
    $conn->close();
} else {
    http_response_code(405);
    echo "Method not allowed.";
}
