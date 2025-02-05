<?php
require_once("../database/db.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $categoryID = isset($_POST['categoryID']) ? (int)$_POST['categoryID'] : 0;
    $name = isset($_POST['name']) ? trim($_POST['name']) : "";
    $description = isset($_POST['description']) ? trim($_POST['description']) : "";

    if ($categoryID <= 0 || empty($name) || empty($description)) {
        http_response_code(400);
        echo "Please fill in all fields.";
        exit();
    }

    $stmt = $conn->prepare("UPDATE category SET name = ?, description = ? WHERE id = ?");
    $stmt->bind_param("ssi", $name, $description, $categoryID);
    if ($stmt->execute()) {
        echo "Category updated successfully.";
    } else {
        http_response_code(500);
        echo "Error updating category.";
    }
    $stmt->close();
    $conn->close();
} else {
    http_response_code(405);
    echo "Method not allowed.";
}
