<?php
include("functions.php");
$active="home";
?>
<!DOCTYPE html>
<html lang="en">

<head>
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
        <div class="container-fluid px-4">
        <div class="row g-3 my-2 ms-1 me-3">
                <div class="col-md-4">
                    <div class="p-3 bg-light-brown shadow-sm d-flex justify-content-around align-items-center rounded">
                        <div>
                            <h3 class="fs-4">
							<?php printTotalChocolates($conn); ?>
                            </h3>
                            <p class="fs-6">Total Chocolates</p>
                        </div>
                        <i class="fa-solid fa-shop fs-1 primary-text border rounded-pill bg-white p-3"></i>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 bg-light-brown shadow-sm d-flex justify-content-around align-items-center rounded">
                        <div>
                            <h6 class="fs-6">
                                <?php printMostSoldChocolate($conn) ?>
                            </h6>
                            <p class="fs-6">Most Sold Chocolate</p>
                        </div>
                        <i class="fa-solid fa-arrow-trend-up fs-1 primary-text border rounded-pill bg-white p-3"></i>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 bg-light-brown shadow-sm d-flex justify-content-around align-items-center rounded">
                        <div>
                            <h3 class="fs-6">
                            <?php printLeastSoldChocolate($conn) ?>
                            </h3>
                            <p class="fs-6">Least Sold Chocolate</p>
                        </div>
                        <i class="fa-solid fa-arrow-trend-down fs-1 primary-text border rounded-pill bg-white p-3"></i>
                    </div>
                </div>
        </div>
        <div class="mb-0 me-3">
						<h4 class="bg-light-brown text-white ms-4">&nbsp; Pending Orders </h4>
					</div>
			 <div class="table-responsive ms-4">
					<table class="table table-hover table-bordered">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Price</th>
								<th>Description</th>
								<th>Weight</th>
								<th class="text-nowrap">Total Orders</th>
							</tr>
						</thead>
						<tbody>
                            <?php prepareChocolate($conn) ?>
						</tbody>
					</table>
			 </div>
    </div>

<script>
  function selectedCategory(){
  let categorySelected=document.getElementById("categorySelected");
  let selectElement=document.getElementById("selectElement");
  selectedCategory.value=selectElement.value;
}
$(document).ready(function(){
  $(document).on('click', '.add', function(){
    alert("Chocolate added!");
    // Any additional code for adding chocolate goes here
  });
});
</script>
		<script src="index.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>