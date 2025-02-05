<?php include "../database/db.php";

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

$totalQuery = "SELECT COUNT(*) AS total FROM customer";
$totalResult = $conn->query($totalQuery);
$totalRow = $totalResult->fetch_assoc();
$totalPages = ceil($totalRow['total'] / $limit);

$query = "SELECT 
            ID AS id, 
            `FULL NAME` AS full_name, 
            ADDRESS AS address, 
            PHONE_NUMBER AS phone_number, 
            EMAIL_ADDRESS AS email,
            STATUS AS status
          FROM customer 
          LIMIT ? OFFSET ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $limit, $offset);
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
?>
