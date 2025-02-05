<?php
include "../database/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = isset($_POST['order_id']) ? (int)$_POST['order_id'] : 0;
    $new_status = isset($_POST['new_status']) ? $_POST['new_status'] : '';

    if ($order_id <= 0 || empty($new_status)) {
        http_response_code(400);
        echo "Invalid parameters.";
        exit();
    }
    $stmt = $conn->prepare("SELECT STATUS FROM orders WHERE ID = ?");
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 0) {
        http_response_code(404);
        echo "Order not found.";
        exit();
    }
    $row = $result->fetch_assoc();
    $current_status = $row['STATUS'];
    $stmt->close();
    $allowed = false;
    if ($current_status === "Pending") {
        if ($new_status === "Pending" || $new_status === "In Progress" || $new_status === "Canceled") {
            $allowed = true;
        }
    } elseif ($current_status === "In Progress") {
        if ($new_status === "In Progress" || $new_status === "Ready") {
            $allowed = true;
        }
    } elseif ($current_status === "Ready") {
        if ($new_status === "Ready" || $new_status === "Picked Up") {
            $allowed = true;
        }
    } elseif ($current_status === "Picked Up" || $current_status === "Canceled") {
        $allowed = false;
    }

    if (!$allowed) {
        http_response_code(403);
        echo "Invalid status transition.";
        exit();
    }
    $stmt = $conn->prepare("UPDATE orders SET STATUS = ? WHERE ID = ?");
    $stmt->bind_param("si", $new_status, $order_id);
    if ($stmt->execute()) {
        echo "Order status updated successfully.";
    } else {
        http_response_code(500);
        echo "Failed to update order status.";
    }
    $stmt->close();
    $conn->close();
} else {
    http_response_code(405);
    echo "Method not allowed.";
}
