<?php
header('Content-Type: application/json');

include "../database/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $orderID = intval($_POST['orderID']);
    $sql = "UPDATE orders SET STATUS = 'Canceled' WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $orderID);
    $stmt->execute();
    $stmt->close();
    echo json_encode(['success' => true]);
}
