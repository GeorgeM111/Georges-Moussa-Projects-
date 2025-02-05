<?php
include "../database/db.php";

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

if ($search !== "") {
    $searchParam = "%" . $search . "%";
    $stmt = $conn->prepare("SELECT COUNT(*) AS total FROM ITEM WHERE NAME LIKE ? OR DESCRIPTION LIKE ?");
    $stmt->bind_param("ss", $searchParam, $searchParam);
    $stmt->execute();
    $totalItems = $stmt->get_result()->fetch_assoc()['total'];
    $stmt->close();
    $query = "SELECT ID AS id, NAME AS name, DESCRIPTION AS description, CATEGORY_ID AS category_id, IMAGE AS image, PRICE AS price FROM ITEM WHERE NAME LIKE ? OR DESCRIPTION LIKE ? LIMIT ? OFFSET ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssii", $searchParam, $searchParam, $limit, $offset);
} else {
    $totalItems = $conn->query("SELECT COUNT(*) AS total FROM ITEM")->fetch_assoc()['total'];
    $query = "SELECT ID AS id, NAME AS name, DESCRIPTION AS description, CATEGORY_ID AS category_id, IMAGE AS image, PRICE AS price FROM ITEM LIMIT ? OFFSET ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $limit, $offset);
}

$totalPages = ceil($totalItems / $limit);
$stmt->execute();
$result = $stmt->get_result();
$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode(['data' => $data, 'totalPages' => $totalPages]);
