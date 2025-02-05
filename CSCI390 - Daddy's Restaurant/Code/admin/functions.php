<?php include "../database/db.php";

$itemsQuery = "SELECT * FROM ITEM";
$itemsStmt = $conn->prepare($itemsQuery);
$itemsStmt->execute();
$itemsResult = $itemsStmt->get_result();
$itemsStmt->close();

$itemCount = count($itemsResult->fetch_all());

$ordersQuery = "SELECT * FROM orders";
$ordersStmt = $conn->prepare($ordersQuery);
$ordersStmt->execute();
$ordersResult = $ordersStmt->get_result();
$ordersStmt->close();

$orderCount = count($ordersResult->fetch_all());


$orderOutDiningQuery = "SELECT * FROM order_out_dining";
$orderOutDiningStmt = $conn->prepare($orderOutDiningQuery);
$orderOutDiningStmt->execute();
$orderOutDiningResult = $orderOutDiningStmt->get_result();
$orderOutDiningStmt->close();

$orderOutDiningCount = count($orderOutDiningResult->fetch_all());


$orderInDiningQuery = "SELECT * FROM order_in_dining";
$orderInDiningStmt = $conn->prepare($orderInDiningQuery);
$orderInDiningStmt->execute();
$orderInDiningResult = $orderInDiningStmt->get_result();
$orderInDiningStmt->close();

$orderInDiningCount = count($orderInDiningResult->fetch_all());