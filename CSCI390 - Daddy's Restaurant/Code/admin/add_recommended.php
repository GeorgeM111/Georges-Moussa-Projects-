<?php
require_once("../database/db.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_id = isset($_POST['item_id']) ? (int)$_POST['item_id'] : 0;
    if ($item_id <= 0) {
        http_response_code(400);
        echo "Invalid item.";
        exit();
    }
    $stmt = $conn->prepare("INSERT INTO recommended (ITEM_ID) VALUES (?)");
    $stmt->bind_param("i", $item_id);
    if ($stmt->execute()) {
        echo "Recommended item added successfully.";
    } else {
        http_response_code(500);
        echo "Error adding recommended item.";
    }
    $stmt->close();
    $conn->close();
} else {
    http_response_code(405);
    echo "Method not allowed.";
}
