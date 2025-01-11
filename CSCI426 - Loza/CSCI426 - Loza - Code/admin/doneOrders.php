<?php
require_once "functions.php";
/*
session_start();
if (!isset($_SESSION['email'])) {
	header("Location: index.php");
}

$email = $_SESSION['email'];
$password = $_SESSION['password'];
$name = $_SESSION['name'];
*/
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
<div class="container-fluid px-4 pb-5">
		<div class="row g-3 my-2 ms-1">
                <div class="col-md-4">
                    <div class="p-3 bg-light-brown shadow-sm d-flex justify-content-around align-items-center rounded">
                        <div>
                            <h3 class="fs-2" id="pendingOrdersCount">
                                <?php
								echo $doneOrders;
								 ?>
                            </h3>
                            <p class="fs-5">Done Orders</p>
                        </div>
                        <i class="fa-regular fa-circle-check fs-1 primary-text border rounded-pill bg-white p-3"></i>
                    </div>
                </div>
		</div>
<div class="table me-5">
					<div class="mb-0 me-3 ms-3">
						<h4 class="bg-light-brown text-white"> &nbsp; Done Orders</h4>
					</div>
					<div class="table-responsive ms-3 me-3">
					<table class="table-css">
                    <thead>
						<tr>
							<th>
								<p>#</p>
							</th>
							<th>
								<p>Order ID</p>
							</th>
							<th>
								<p>Customer</p>
							</th>
							<th>
								<p>Date Created</p>
							</th>
							<th>
								<p> Items</p>
							</th>
							<th>
								<p>Total Price</p>
							</th>
							<th>
								<p>Paid Price</p>
							</th>
							<th>
								<p>Actions</p>
							</th>
						</tr>
					</thead>
						<tbody id='myTable'>
						
						</tbody>
					</table>
				</div>
			</div>
</div>
</div>


	<script src="jquery-3.1.1.js" type="text/javascript"> </script>  
	<script>
	$(document).ready(function(){
		LoadPendingOrders();

		$(document).on('click', '.submitPrice', function() {
				$id = $(this).val();
				$paidPrice = parseInt(document.getElementById($id).value);
				$.ajax({
					type: "POST",
					url: "submitPrice.php",
					data: {
						id: $id,
						price: 1,
						paid: $paidPrice,
					},
					success: function() {
						alert("Paid Price Set Successfully !");
						LoadPendingOrders();
					}
				});
			});
	});
			
		
	function LoadPendingOrders(){
		$.ajax({
			url: 'LoadOrders.php',
			type: 'POST',
			async: false,
			data:{
				done: 1
			},
			success: function(response){
				$('#myTable').html(response);
			}
		});
	}
	</script>
	    <script src="index.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>