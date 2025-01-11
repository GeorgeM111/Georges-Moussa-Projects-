<?php
include "../Database/db.php";
$orderID = $_GET['orderID'];
$sql = "SELECT * FROM order_details, chocolates WHERE order_details.order_id = '$orderID' AND order_details.chocolate_id = chocolates.id";
$totalPrice="SELECT SUM(ORDER_dETAILS.PRICE) as total,COUNT(chocolate_id) as chocs FROM order_details, chocolates WHERE order_details.order_id = $orderID AND order_details.chocolate_id = chocolates.id GROUP BY order_details.order_id";
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
<?php

$result = $conn->query($sql);
$totalres=$conn->query($totalPrice);
$row = $totalres->fetch_assoc();
if ($result->num_rows > 0) {
?>

<?php include("sideBar.php"); ?>
    <div class="main position-absolute vh-100 bg-white">
        <?php include("topBar.php"); ?>	
		<div class="row g-3 my-2 ms-1">
                <div class="col-md-4">
                    <div class="p-3 bg-light-brown shadow-sm d-flex justify-content-around align-items-center rounded">
                        <div>
                            <h3 class="fs-2">
							 <?php echo number_format($row['total'], 2, '.', '');?>
                            </h3>
                            <p class="fs-6">Total Price</p>
                        </div>
                        <i class="fa-solid fa-dollar-sign fs-1 primary-text border rounded-pill bg-white p-3 px-4"></i>
                    </div>
                </div>

				<div class="col-md-4">
                    <div class="p-3 bg-light-brown shadow-sm d-flex justify-content-around align-items-center rounded">
                        <div>
                            <h3 class="fs-2">
							 <?php echo $row['chocs'] ;?>
                            </h3>
                            <p class="fs-6">Type<?php if($row['chocs'] > 1)echo "s"; ?> Of Chocolate</p>
                        </div>
                        <i class="fa-solid fa-tags fs-1 primary-text border rounded-pill bg-white p-3"></i>
                    </div>
                </div>
		</div>	
		<div class="table me-5">
					<div class="mb-0 me-3 ms-3">
						<h4 class="bg-light-brown text-white">&nbsp; Order : <?php echo $orderID;?> </h4>
					</div>
					<div class="table-responsive ms-3 me-3">
					<table class="table-css">
						<tr>
							<th>Chocolate Name</th>
							<th>ID</th>
							<th>Price</th>
							<th>Quantity</th>
							<th>Cover</th>
							<th>Weight</th>
						</tr>
						<?php 
						while ($row = $result->fetch_assoc()) {
						?>
							<tr>
								<td><?php echo $row['name']; ?></td>
								<td><?php echo $row['chocolate_id']; ?></td>
								<td><?php echo $row['price']; ?></td>
								<td><?php echo $row['quantity']; ?></td>
								<td><?php echo $row['cover']; ?></td>
								<td><?php echo $row['weight']; ?></td>
							</tr>
						<?php
						}}
						?>
					</table>
					</div>
    				</div>
				<button class="btn seeMore ms-3" onclick="goBack()">Go Back</button>
		 </div>

		 <script>
						function goBack() {
				window.history.back();
			}
		 </script>
	<script src="index.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>