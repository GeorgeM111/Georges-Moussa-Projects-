<?php
header('Content-Type: application/json');

include "../database/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $orderID = intval($_POST['orderID']);
    $query = "SELECT `STATUS` FROM orders WHERE `ID` = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $orderID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
        echo json_encode(["success" => true, "status" => $order['STATUS']]);
    } else {
        echo json_encode(["success" => false, "message" => "Order not found"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
}
