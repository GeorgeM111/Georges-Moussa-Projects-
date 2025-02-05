<?php
include "../database/db.php";

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;
$filterStatus = isset($_GET['status']) ? trim($_GET['status']) : '';
$filterDining = isset($_GET['dining']) ? strtolower(trim($_GET['dining'])) : '';

$whereClauses = [];
$params = [];
$paramTypes = "";

if (!empty($filterStatus)) {
    $whereClauses[] = "o.STATUS = ?";
    $params[] = $filterStatus;
    $paramTypes .= "s";
}
if (!empty($filterDining)) {
    $whereClauses[] = $filterDining === "in" ? "i.ORDER_ID IS NOT NULL" : "od.ORDER_ID IS NOT NULL";
}

$whereSQL = count($whereClauses) > 0 ? "WHERE " . implode(" AND ", $whereClauses) : "";

$countQuery = "SELECT COUNT(*) AS total FROM orders o 
               LEFT JOIN order_in_dining i ON o.ID = i.ORDER_ID 
               LEFT JOIN order_out_dining od ON o.ID = od.ORDER_ID 
               $whereSQL";

if (count($params) > 0) {
    $stmt = $conn->prepare($countQuery);
    $stmt->bind_param($paramTypes, ...$params);
    $stmt->execute();
    $totalOrders = $stmt->get_result()->fetch_assoc()['total'];
    $stmt->close();
} else {
    $totalOrders = $conn->query($countQuery)->fetch_assoc()['total'];
}

$totalPages = ceil($totalOrders / $limit);

$query = "SELECT o.ID as id, o.STATUS as status, o.DATE_AND_TIME as date_and_time, o.TOTAL_PRICE as total_price,
          CASE WHEN i.ORDER_ID IS NOT NULL THEN 'In' WHEN od.ORDER_ID IS NOT NULL THEN 'Out' ELSE 'Unknown' END as dining_option
          FROM orders o 
          LEFT JOIN order_in_dining i ON o.ID = i.ORDER_ID 
          LEFT JOIN order_out_dining od ON o.ID = od.ORDER_ID 
          $whereSQL ORDER BY o.ID DESC LIMIT ? OFFSET ?";

$stmt = $conn->prepare($query);
if (count($params) > 0) {
    $paramTypes .= "ii";
    $params[] = $limit;
    $params[] = $offset;
    $stmt->bind_param($paramTypes, ...$params);
} else {
    $stmt->bind_param("ii", $limit, $offset);
}

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
