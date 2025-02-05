<?php
require_once("../database/db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    if ($id <= 0) {
        http_response_code(400);
        echo "Invalid id.";
        exit();
    }
    $stmt = $conn->prepare("DELETE FROM featured WHERE ID = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "Featured item removed successfully.";
    } else {
        http_response_code(500);
        echo "Error removing featured item.";
    }
    $stmt->close();
    $conn->close();
} else {
    http_response_code(405);
    echo "Method not allowed.";
}
