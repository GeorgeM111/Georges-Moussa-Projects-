<?php
include "../database/db.php";

$customerQuery = "SELECT COUNT(*) as total FROM customer";
$customerStmt = $conn->prepare($customerQuery);
$customerStmt->execute();
$customerResult = $customerStmt->get_result()->fetch_assoc();
$customerStmt->close();
$customerCount = $customerResult['total'];

$blockedCustomerQuery = "SELECT COUNT(*) as blocked FROM customer WHERE STATUS = 'Blocked'";
$blockedCustomerStmt = $conn->prepare($blockedCustomerQuery);
$blockedCustomerStmt->execute();
$blockedCustomerResult = $blockedCustomerStmt->get_result()->fetch_assoc();
$blockedCustomerStmt->close();
$blockedCustomerCount = $blockedCustomerResult['blocked'];

$deletedCustomerQuery = "SELECT COUNT(*) as deleted FROM customer WHERE STATUS = 'Deleted'";
$deletedCustomerStmt = $conn->prepare($deletedCustomerQuery);
$deletedCustomerStmt->execute();
$deletedCustomerResult = $deletedCustomerStmt->get_result()->fetch_assoc();
$deletedCustomerStmt->close();
$deletedCustomerCount = $deletedCustomerResult['deleted'];

$unblockedCustomerQuery = "SELECT COUNT(*) as unblocked FROM customer WHERE STATUS = 'Unblocked'";
$unblockedCustomerStmt = $conn->prepare($unblockedCustomerQuery);
$unblockedCustomerStmt->execute();
$unblockedCustomerResult = $unblockedCustomerStmt->get_result()->fetch_assoc();
$unblockedCustomerStmt->close();
$unblockedCustomerCount = $unblockedCustomerResult['unblocked'];

$data = [
    "total" => $customerCount,
    "unblocked" => $unblockedCustomerCount,
    "blocked" => $blockedCustomerCount,
    "deleted" => $deletedCustomerCount,
];

header('Content-Type: application/json');
echo json_encode(['data' => $data]);
