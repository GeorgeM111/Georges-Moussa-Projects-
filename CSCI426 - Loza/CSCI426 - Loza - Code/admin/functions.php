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

$sql = "SELECT count(*) as total FROM chocolates;";
$chocres = mysqli_query($conn, $sql);
if ($chocres) {
	$row = mysqli_fetch_assoc($chocres);
	$choc = $row['total'];
}

$sql = "SELECT count(*) as total FROM customers;";
$custres = mysqli_query($conn, $sql);
if ($custres) {
	$row = mysqli_fetch_assoc($custres);
	$customers = $row['total'];
}

$sql = "SELECT count(*) as total FROM customers WHERE STATUS ='UNBLOCKED';";
$custres = mysqli_query($conn, $sql);
if ($custres) {
	$row = mysqli_fetch_assoc($custres);
	$unBlockedCustomers = $row['total'];
}

$sql = "SELECT count(*) as total FROM customers WHERE STATUS ='BLOCKED';";
$custres = mysqli_query($conn, $sql);
if ($custres) {
	$row = mysqli_fetch_assoc($custres);
	$BlockedCustomers = $row['total'];
}

$sql = "SELECT count(*) as total FROM messages WHERE `ACTION`='Pending';";
$messageres = mysqli_query($conn, $sql);
if ($messageres) {
	$row = mysqli_fetch_assoc($messageres);
	$pendingMessages = $row['total'];
}

$sql = "SELECT count(*) as total FROM messages WHERE `ACTION`='Resolved';";
$messageres = mysqli_query($conn, $sql);
if ($messageres) {
	$row = mysqli_fetch_assoc($messageres);
	$resolvedMessages = $row['total'];
}

$sql = "SELECT count(*) as total FROM messages WHERE `ACTION`='Rejected';";
$messageres = mysqli_query($conn, $sql);
if ($messageres) {
	$row = mysqli_fetch_assoc($messageres);
	$rejectedMessages = $row['total'];
}

$sql = "SELECT SUM(PRICE) as total FROM order_details;";
$earnres = mysqli_query($conn, $sql);
if ($earnres) {
	$row = mysqli_fetch_assoc($earnres);
	$earnings = $row['total'];
}

function prepareChocolate($conn)
{
	$sql = "SELECT
    chocolates.id,
    weight,
    `desc`,
    datecreated,
    chocolates.price,
    name,
    COALESCE(count(od.quantity), 0) AS total
FROM
    chocolates 
LEFT JOIN
    order_details od ON chocolates.id = od.chocolate_id
GROUP BY
    chocolates.id, weight, `desc`,datecreated, chocolates.price, name
ORDER BY
    total DESC;
";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$i = 1;
		while ($row = $result->fetch_assoc()) {
			echo "<tr>
					<td><p>" . $i . "</p></td>
					<td><p>" . $row['name'] . "</p></td>
					<td><p>" . $row['price'] . "</p></td>
					<td><p>" . $row['desc'] . "</p></td>
					<td><p>" . $row['weight'] . "</p></td>
					<td><p>" . $row['total'] . "</p></td></tr>";
			$i++;
		}
	}
}

function printCategoryOptions($conn)
{
	$sql = "SELECT * FROM categories";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			echo '<option value=' . $row['name'] . '>' . $row['name'] . '</option>';
		}
	}
}
function printCustomers($conn)
{
	$sql = "SELECT * FROM customers";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$i = 1;
		while ($row = $result->fetch_assoc()) {
			$fullName = $row['fname'] . " " . $row['mname'] . " " . $row['fname'];

			$btnClass="cancel";
			$btnInnerHTML = "Block";
			if($row['Status'] == "Blocked"){
				$btnClass="setDone";
				$btnInnerHTML = "Unblock";
			}
			
			echo '<tr>
					<td><p>' . $i . '</p></td>
					<td><p>' . $fullName . '</p></td>
					<td><p>' . $row["address"] . '</p></td>
					<td><p>' . $row["Phone"] . '</p></td>
					<td><p>' . $row["email"] . '</p></td>
					<td><p><button onclick="openOrders('.$row['CID'].')" class="seeMore btn">View Orders</button></p></td>
					<td><button class="btn '.$btnClass.'" value="' . $row['CID'] . '">'.$btnInnerHTML.'</button</td>
					</tr>';
			$i++;
		}
	}
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
// onclick="window.location.href='sproduct.php?chocID=<?php echo $choc['id'] ';"
function printTotalChocolates($conn) {
    $sql = "SELECT COUNT(*) as total FROM CHOCOLATES";
    $result = $conn->query($sql);
    $total=0;
	while($row = $result->fetch_assoc()){
		$total = $row["total"];
	}
    echo $total;
}

function printMostSoldChocolate($conn) {
	$sql = "SELECT
    chocolates.id,
    weight,
    `desc`,
    datecreated,
    chocolates.price,
    name,
    COALESCE(count(od.quantity), 0) AS total
FROM
    chocolates 
LEFT JOIN
    order_details od ON chocolates.id = od.chocolate_id
GROUP BY
    chocolates.id, weight, `desc`,datecreated, chocolates.price, name
ORDER BY
    total DESC LIMIT 1;
";
    $result = $conn->query($sql);
    $chocolate="";
	while($row = $result->fetch_assoc()){
		$chocolate = $row["name"];
	}
    echo $chocolate;
}

function printLeastSoldChocolate($conn) {
	$sql = "SELECT
    chocolates.id,
    weight,
    `desc`,
    datecreated,
    chocolates.price,
    name,
    COALESCE(count(od.quantity), 0) AS total
FROM
    chocolates 
LEFT JOIN
    order_details od ON chocolates.id = od.chocolate_id
GROUP BY
    chocolates.id, weight, `desc`,datecreated, chocolates.price, name
ORDER BY
    total ASC LIMIT 1;
";
    $result = $conn->query($sql);
    $chocolate="";
	while($row = $result->fetch_assoc()){
		$chocolate = $row["name"];
	}
    echo $chocolate;
}

$sql = "SELECT COUNT(*) as totalUsers from users";
$result = $conn->query($sql);
$totalUsers= $result->fetch_assoc()['totalUsers'];

$sql = "SELECT COUNT(*) as totalAdmins from users where position='Admin'";
$result = $conn->query($sql);
$totalAdmins= $result->fetch_assoc()['totalAdmins'];

$sql = "SELECT COUNT(*) as totalAssistants from users where position='Assistant'";
$result = $conn->query($sql);
$totalAssistants= $result->fetch_assoc()['totalAssistants'];

