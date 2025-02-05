<?php
include "../database/db.php";

if (!isset($_GET['orderID']) || empty($_GET['orderID'])) {
    echo "Order ID not specified.";
    exit();
}
if (!isset($_GET['option']) || empty($_GET['option'])) {
    echo "Dining Option not specified.";
    exit();
}
$option = $_GET['option'];
$orderID = (int) $_GET['orderID'];

$query = "SELECT 
            od.ORDER_ID, 
            od.ITEM_ID, 
            od.QUANTITY, 
            od.REQUEST, 
            od.FINAL_PRICE,
            i.NAME AS item_name
          FROM order_details od
          LEFT JOIN ITEM i ON od.ITEM_ID = i.ID
          WHERE od.ORDER_ID = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $orderID);
$stmt->execute();
$result = $stmt->get_result();

$orderDetails = array();
while ($row = $result->fetch_assoc()) {
    $orderDetails[] = $row;
}
$stmt->close();

$sql = "SELECT * from orders where ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $orderID);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
$order = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">

<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="css/style.css" />
<title>User Management</title>
<style>
    .custom-select {
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px;
        font-size: 16px;
    }

    .custom-select:focus {
        outline: none;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
    }

    .page-btn.active {
        background-color: #0d6efd;
        color: white;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<body>

    <?php include "navbar.php"; ?>
    <div class="d-flex" id="wrapper">
        <?php include "sidebar.php"; ?>
        <div id="page-content-wrapper">
            <div class="container-fluid px-4 border-top border-dark border-top-3">
                <h2 class="mb-4 pt-3">Order Details for Order #<?php echo $orderID; ?></h2>
                <ul>
                    <li>Date & Time of Placement: <?php echo $order['DATE_AND_TIME'] ?></li>
                    <li>Status: <?php echo $order['STATUS'] ?></li>
                    <li>Total Price: <?php echo $order['TOTAL_PRICE'] ?> $</li>
                    <li>Dining Option: <?php echo $option ?> Dining</li>
                    <?php
                    if ($option == "In") {
                        $sql = "SELECT TABLE_NUMBER FROM order_in_dining where ORDER_ID = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $orderID);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();
                        $row = $result->fetch_assoc();
                        $tableNb = $row['TABLE_NUMBER'];
                    ?>
                        <li>Table Number: <?php echo $tableNb ?></li>
                    <?PHP
                    } else if ($option == "Out") {
                        $sql = "SELECT CUSTOMER_ID,OPTION FROM order_out_dining where ORDER_ID = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $orderID);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();
                        $row = $result->fetch_assoc();
                        $customerID = $row['CUSTOMER_ID'];
                        $dineOutOption = $row['OPTION']; ?>
                        <li>Dine Out Option: <?php echo $dineOutOption ?></li>
                        <?php
                        $sql = "SELECT ADDRESS,`FULL NAME`,PHONE_NUMBER FROM customer where ID = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $customerID);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $stmt->close();
                        $row = $result->fetch_assoc();
                        $custName = $row['FULL NAME'];
                        $custAddress = $row['ADDRESS'];
                        $custPhNb = $row['PHONE_NUMBER']; ?>
                        <li>Customer Name: <?php echo $custName ?></li>
                        <li>Customer Address: <?php echo $custAddress ?></li>
                        <li>Customer Phone Number: <?php echo $custPhNb ?></li>
                    <?PHP $conn->close();
                    } else {
                        echo "Invalid Dining Option";
                    }
                    ?>
                </ul>
                <?php if (count($orderDetails) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>Item ID</th>
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                    <th>Request</th>
                                    <th>Final Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($orderDetails as $detail): ?>
                                    <tr>
                                        <td><?php echo $detail['ITEM_ID']; ?></td>
                                        <td><?php echo ($detail['item_name']) ? $detail['item_name'] : "N/A"; ?></td>
                                        <td><?php echo $detail['QUANTITY']; ?></td>
                                        <td><?php echo $detail['REQUEST']; ?></td>
                                        <td><?php echo $detail['FINAL_PRICE']; ?> $</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info" role="alert">
                        No order details found for this order.
                    </div>
                <?php endif; ?>

                <a href="ordersManagement.php" class="btn btn-primary mt-3">Back to Orders</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>