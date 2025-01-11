<?php
include 'functions.php';
$active='home';
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
        <div class="container-fluid px-4">
            <div class="row g-3 my-2">
                <div class="col-md-3">
                    <div class="p-3 bg-light-brown shadow-sm d-flex justify-content-around align-items-center rounded">
                        <div>
                            <h3 class="fs-2">
                            <?php echo $cancelOrders+$doneOrders+$pendingOrders; ?>
                            </h3>
                            <p class="fs-6">Orders</p>
                        </div>
                        <i class="fa-solid fa-truck-fast fs-1 primary-text border rounded-pill bg-white p-3"></i>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="p-3 bg-light-brown shadow-sm d-flex justify-content-around align-items-center rounded">
                        <div>
                            <h3 class="fs-2">
                                <?php echo $pendingOrders; ?>
                            </h3>
                            <p class="fs-6">Pending Orders</p>
                        </div>
                        <i class="fa-solid fa-clock fs-1 primary-text border rounded-pill bg-white p-3"></i>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="p-3 bg-light-brown shadow-sm d-flex justify-content-around align-items-center rounded">
                        <div>
                            <h3 class="fs-2">
                                <?php echo $doneOrders;?>
                            </h3>
                            <p class="fs-6">Done Orders</p>
                        </div>
                        <i class="fa-solid fa-circle-check fs-1 primary-text border rounded-pill bg-white p-3"></i>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="p-3 bg-light-brown shadow-sm d-flex justify-content-around align-items-center rounded">
                        <div>
                            <h3 class="fs-2">
                                <?php
                                 echo $cancelOrders;
                                ?>
                            </h3>
                            <p class="fs-6">Denied Orders</p>
                        </div>
                        <i class="fa-solid fa-circle-xmark fs-1 primary-text border rounded-pill bg-white p-3"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-5 mx-4"> 
                    <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="fs-4 mb-3">Recent Orders</h3>
                    <a href="pendingOrders.php" class="btn bg-light-brown view text-white me-4">View All</a>
                    </div>
                        <table class="table bg-white rounded shadow-sm  table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="50">#</th>
                                    <th scope="col">Date And Time</th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php printRecentOrders($conn); ?>
                            </tbody>
                        </table>
                </div>
    </div>

                                
    <script>
    function openSeeMore(orderID){
    window.location.href = 'orderDetails.php?orderID=' + orderID;
}
    </script>
    <script src="index.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
</body>

</html>