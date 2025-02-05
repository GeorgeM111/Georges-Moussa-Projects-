<?php
include "../database/database.php";
if (isset($_POST['itemID'])) {
    $itemID = $_POST['itemID'];
    $query = "DELETE FROM items WHERE ID = ?;";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $itemID);
    $stmt->execute();
    $stmt->close();
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Internal Server Error, Please Try Again']);
}
