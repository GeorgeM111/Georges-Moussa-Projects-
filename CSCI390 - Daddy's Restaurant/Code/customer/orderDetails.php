<!DOCTYPE html>
<html lang="en">
<?php require_once "../backend/config_session.php"; ?>

<head>
    <meta charset="utf-8">
    <title>Daddy's Restaurant</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="images/logo.jpg" rel="icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php include("navBar.php"); ?>
    <?php
    date_default_timezone_set('Asia/Beirut');

    $orderID = isset($_GET['OID']) ? intval($_GET['OID']) : 0;

    $ordersQuery = "SELECT DATE_AND_TIME, TOTAL_PRICE, STATUS FROM orders WHERE ID = ?";
    $stmt = $conn->prepare($ordersQuery);
    $stmt->bind_param("i", $orderID);
    $stmt->execute();
    $orderResult = $stmt->get_result();
    $orderPermissionQuery = "SELECT CUSTOMER_ID FROM orders as O,`order_out_dining` as OOD WHERE O.ID = OOD.ORDER_ID AND O.ID = ? ";
    $stmtPermission = $conn->prepare($orderPermissionQuery);
    $stmtPermission->bind_param("i", $orderID);
    $stmtPermission->execute();
    $permissionResult = $stmtPermission->get_result();
    $stmtPermission->close();
    $permission = $permissionResult->fetch_assoc();
    if ($permission) {
        $CID = $permission['CUSTOMER_ID'];
    } else {
        $CID = -1;
    }

    if ($orderResult->num_rows > 0 && $CID == $_SESSION['loginCredentials']['id']) {
        $order = $orderResult->fetch_assoc();
    ?>
        <div class="container-fluid">
            <div class="mx-auto d-block mt-3">
                <h1 class="text-center pacifico text-decoration-underline">Order #<?php echo htmlspecialchars($orderID) ?></h1>
            </div>

            <?php
            $orderDetailsQuery = "SELECT OD.ITEM_ID, OD.QUANTITY, OD.REQUEST, OD.FINAL_PRICE, I.NAME, I.DESCRIPTION, I.IMAGE 
                                  FROM order_details AS OD 
                                  INNER JOIN item AS I ON OD.ITEM_ID = I.ID 
                                  WHERE OD.ORDER_ID = ?";
            $stmtDetails = $conn->prepare($orderDetailsQuery);
            $stmtDetails->bind_param("i", $orderID);
            $stmtDetails->execute();
            $orderDetailsResult = $stmtDetails->get_result();

            if ($orderDetailsResult->num_rows > 0) {
            ?>
                <div class="order-summary my-4" align="center">
                    <h3>Order Summary</h3>
                    <p><strong>Date and Time:</strong> <?php echo htmlspecialchars($order['DATE_AND_TIME']); ?></p>
                    <p><strong>Total Price:</strong> $<?php echo htmlspecialchars($order['TOTAL_PRICE']); ?></p>
                    <p><strong>Status:</strong> <?php echo htmlspecialchars($order['STATUS']); ?></p>
                </div>
                <div class="order-details my-4" align="center">
                    <h3>Order Items</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Item Name</th>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Request</th>
                                    <th>Final Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($item = $orderDetailsResult->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td><img src="images/itemsImg/<?php echo htmlspecialchars($item['IMAGE']); ?>" alt="<?php echo htmlspecialchars($item['NAME']); ?>" class="img-fluid" style="width: 100px;"></td>
                                        <td><?php echo htmlspecialchars($item['NAME']); ?></td>
                                        <td><?php echo htmlspecialchars($item['DESCRIPTION']); ?></td>
                                        <td><?php echo htmlspecialchars($item['QUANTITY']); ?></td>
                                        <td><?php echo $item['REQUEST']; ?></td>
                                        <td>$<?php echo htmlspecialchars($item['FINAL_PRICE']); ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php
            } else {
                echo "<p>No items found for this order.</p>";
            }
            ?>
        </div>
    <?php
    } else {
        echo "<div class='container'><p class='text-center'>Order not found or you do not have permission to view it.</p></div>";
    }
    ?>

    <?php include("footer.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>

</html>