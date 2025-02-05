<?php
require_once("../database/db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = isset($_POST['name']) ? trim($_POST['name']) : "";
    $description = isset($_POST['description']) ? trim($_POST['description']) : "";

    if (empty($name) || empty($description)) {
        http_response_code(400);
        echo "All fields are required.";
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO category (name, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $description);
    if ($stmt->execute()) {
        echo "Category added successfully.";
    } else {
        http_response_code(500);
        echo "Error adding category.";
    }
    $stmt->close();
    $conn->close();
} else {
    http_response_code(405);
    echo "Method not allowed.";
}
