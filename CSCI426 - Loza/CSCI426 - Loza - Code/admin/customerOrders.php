<?php
include "../Database/db.php";
$CID = $_GET['CID'];
$sql = "SELECT * FROM ORDERS WHERE customer_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $CID);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

$sql2 = "SELECT COUNT(*) as total FROM ORDERS WHERE customer_id = ?";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("i", $CID);
$stmt2->execute();
$result2 = $stmt2->get_result();
$stmt2->close();
$countOrders = $result2->fetch_assoc();

$sql3 = "SELECT CONCAT(fname,' ',mname,' ',lname) as fullName from customers WHERE CID = ?";
$stmt3 = $conn->prepare($sql3);
$stmt3->bind_param("i", $CID);
$stmt3->execute();
$result3 = $stmt3->get_result();
$stmt3->close();
$customerName = $result3->fetch_assoc();
$name = $customerName['fullName'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loza Chocolatier| Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include("sideBar.php"); ?>
    <div class="main position-absolute vh-100 bg-white">
        <?php include("topBar.php"); ?>
        <div class="row g-3 my-2 ms-1 me-3">
            <div class="col-md-4">
                <div class="p-3 bg-light-brown shadow-sm d-flex justify-content-around align-items-center rounded">
                    <div>
                        <h3 class="fs-2">
                            <?php echo $countOrders['total'] ?>
                        </h3>
                        <p class="fs-6">Orders</p>
                    </div>
                    <i class="fa-solid fa-users-line fs-1 primary-text border rounded-pill bg-white p-3"></i>
                </div>
            </div>

            <div class="table me-5">
                <div class="mb-0 me-3">
                    <h4 class="bg-light-brown text-white ms-2">&nbsp; <?php echo $name . '\'s Orders'; ?></h4>
                </div>
                <div class="table-responsive ms-2 me-3">
                    <table class="table-css">
                        <thead>
                            <tr>
                                <th>
                                    <p>#</p>
                                </th>

                                <th>
                                    <p>Date</p>
                                </th>
                                <th>
                                    <p>Total Price</p>
                                </th>
                                <th>
                                    <p>Items</p>
                                </th>
                                <th>
                                    <p>Status</p>
                                </th>
                                <th>
                                    <p>Details</p>
                                </th>
                            </tr>
                        </thead>
                        <?php if ($countOrders['total'] > 0) { ?>
                            <tbody>
                                <?php
                                while ($row = $result->fetch_assoc()) :
                                    $query = "SELECT SUM(price) as total,COUNT(DISTINCT chocolate_id) as items FROM ORDER_DETAILS WHERE ORDER_ID = ?";
                                    $statement = $conn->prepare($query);
                                    $statement->bind_param("i", $row['orderid']);
                                    $statement->execute();
                                    $detailsRes = $statement->get_result();
                                    $statement->close();
                                    $details = $detailsRes->fetch_assoc();
                                ?>
                                    <tr>
                                        <td><?php echo $row['orderid'] ?></td>
                                        <td><?php echo $row['created_at'] ?></td>
                                        <td><?php echo $details['total'] ?></td>
                                        <td><?php echo $details['items'] ?></td>
                                        <td><?php echo $row['status'];
                                            if ($row['status'] == "Cancel") echo "ed"; ?></td>
                                        <td><button class="btn cancel text-white" onclick="openSeeMore(<?php echo $row['orderid'] ?>)">Details</button></td>
                                    </tr>
                                <?php
                                endwhile;
                                ?>
                            </tbody>
                        <?php } else {
                            echo '<tr>
                            <td></td>
	                        <td></td>
	                        <td></td>
	                        <td class="text-nowrap">No Orders From This Customer Yet</td>
	                        <td></td>
	                        <td></td>
	                        </tr>';
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <button class="btn seeMore ms-3 mb-4" onclick="goBack()">Go Back</button>
    </div>
    <script>
        function openSeeMore(orderID) {
            window.location.href = 'orderDetails.php?orderID=' + orderID;
        }

        function goBack() {
            window.history.back();
        }
    </script>
    <script src="index.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>