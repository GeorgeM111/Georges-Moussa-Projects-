<?php
require_once("../database/db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = isset($_POST['name']) ? trim($_POST['name']) : "";
    $price = isset($_POST['price']) ? (float)$_POST['price'] : 0;

    if (empty($name) || $price <= 0) {
        http_response_code(400);
        echo "All fields are required and price must be greater than 0.";
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO ingredient (NAME, PRICE) VALUES (?, ?)");
    $stmt->bind_param("sd", $name, $price);
    if ($stmt->execute()) {
        echo "Ingredient added successfully.";
    } else {
        http_response_code(500);
        echo "Error adding ingredient.";
    }
    $stmt->close();
    $conn->close();
} else {
    http_response_code(405);
    echo "Method not allowed.";
}
