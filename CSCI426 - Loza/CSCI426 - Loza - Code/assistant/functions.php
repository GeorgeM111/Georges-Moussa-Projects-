<?php
include "../Database/db.php";

$sql = "SELECT count(*) as total FROM orders WHERE status = 'Pending';";
$pendingres = mysqli_query($conn, $sql);
if ($pendingres) {
	$row = mysqli_fetch_assoc($pendingres);
	$pendingOrders = $row['total'];
}

$sql = "SELECT count(*) as total FROM orders WHERE status = 'Completed';";
$doneres = mysqli_query($conn, $sql);
if ($doneres) {
	$row = mysqli_fetch_assoc($doneres);
	$doneOrders = $row['total'];
}

$sql = "SELECT count(*) as total FROM orders WHERE status = 'Cancel';";
$cancelres = mysqli_query($conn, $sql);
if ($cancelres) {
	$row = mysqli_fetch_assoc($cancelres);
	$cancelOrders = $row['total'];
}
function printRecentOrders($conn)
{
	$sql = 'SELECT order_id,orders.status,created_at,CONCAT(fname," ",mname," ",lname) as CNAME ,total.price FROM ORDERS,CUSTOMERS,(SELECT SUM(PRICE) AS price,order_id  FROM orders,ORDER_DETAILS WHERE ORDERID=ORDER_ID GROUP BY order_id) as total WHERE (total.order_id = ORDERID  AND CUSTOMER_ID = CID)  ORDER BY order_id DESC LIMIT 6;';
	$result = $conn->query($sql);
	if ($result->num_rows <= 0)
		echo '<tr>
	<td></td>
	<td></td>
	<td class="text-nowrap">No Orders Yet</td>
	<td></td>
	<td></td>
	</tr>';
	else {
		$orders = [];
		while ($row = $result->fetch_assoc()) {
			$orders[] = $row;
		}
		foreach ($orders as $row) {
			$str = "";
			if ($row['status'] == "Cancel")
				$str = "ed";
			echo '
		<tr>
		<td>' . $row['order_id'] . '</td>
		<td>' . $row['CNAME'] . '</td>
		<td>' . $row['price'] . '</td>
		<td><span class="status ' . strtolower($row['status']) . 'ed">' . $row['status'] . $str . '</span></td>
		<td><button id="seeMore" class="btn seeMore" onclick="openSeeMore(' . $row['order_id'] . ')">Details</button></td>
	</tr>';
		}
	}
}