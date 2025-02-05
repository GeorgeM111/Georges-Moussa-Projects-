<?php
include "../database/database.php";
if (isset($_POST['itemID'], $_POST['stockToBeModified'])) {
    $itemID = $_POST['itemID'];
    $stock = $_POST['stockToBeModified'];
    $query = "UPDATE items SET stock = ? WHERE ID = ?;";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("si", $stock, $itemID);
    $stmt->execute();
    $stmt->close();
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Internal Server Error, Please Try Again']);
}
