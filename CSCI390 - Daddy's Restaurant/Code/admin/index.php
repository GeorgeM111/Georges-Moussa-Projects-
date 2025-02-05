<?php
include "functions.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="css/style.css">
    <title>Dashboard</title>
    <style>
        #wrapper {
            overflow-x: hidden;
            background-image: linear-gradient(to right, #e0f7fa, #bceef4, #a4e6ef, #94d6f4, #91d5f4);
        }
    </style>
</head>

<body>
    <?php include "navbar.php"; ?>
    <div class="d-flex" id="wrapper">
        <?php include "sidebar.php"; ?>
        <div id="page-content-wrapper">
            <div class="container-fluid border-top border-dark border-top-3 px-4">
                <div class="row g-3 my-2">
                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2"><?php echo $itemCount; ?></h3>
                                <p class="fs-5">Items</p>
                            </div>
                            <i class="fa-solid fa-gift fa-2x text-primary"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2"><?php echo $orderCount; ?></h3>
                                <p class="fs-5">Orders</p>
                            </div>
                            <i class="fa-solid fa-hand-holding-usd fa-2x text-primary"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2"><?php echo $orderOutDiningCount; ?></h3>
                                <p class="fs-5">Out Dinings</p>
                            </div>
                            <i class="fa-solid fa-truck fa-2x text-primary"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2"><?php echo $orderInDiningCount; ?></h3>
                                <p class="fs-5">In Dinings</p>
                            </div>
                            <i class="fa-solid fa-utensils fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
                <div class="row my-5">
                    <h3 class="fs-4 mb-3">Recent 10 Orders</h3>
                    <div class="col">
                        <div class="table-responsive">
                            <table class="table bg-white rounded shadow-sm table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col" width="50">#</th>
                                        <th scope="col">Date and Time</th>
                                        <th scope="col">Total Price</th>
                                        <th scope="col">Dining Option</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "SELECT o.ID, o.DATE_AND_TIME, o.TOTAL_PRICE, o.STATUS,
                             CASE 
                               WHEN i.ORDER_ID IS NOT NULL THEN 'In'
                               WHEN od.ORDER_ID IS NOT NULL THEN 'Out'
                               ELSE 'Unknown'
                             END AS dining_option
                            FROM orders o
                            LEFT JOIN order_in_dining i ON o.ID = i.ORDER_ID
                            LEFT JOIN order_out_dining od ON o.ID = od.ORDER_ID
                            ORDER BY o.ID DESC
                            LIMIT 10";
                                    $result = $conn->query($query);
                                    if ($result) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<tr>';
                                            echo '<td>' . htmlspecialchars($row["ID"]) . '</td>';
                                            echo '<td>' . htmlspecialchars($row["DATE_AND_TIME"]) . '</td>';
                                            echo '<td>' . htmlspecialchars($row["TOTAL_PRICE"]) . ' $</td>';
                                            echo '<td>' . htmlspecialchars($row["dining_option"]) . ' Dining</td>';
                                            echo '<td>' . htmlspecialchars($row["STATUS"]) . '</td>';
                                            echo '<td><a href="orderDetails.php?orderID=' . urlencode($row["ID"]) . '&option='.urlencode($row["dining_option"]).'" class="btn btn-primary btn-sm">Details</a></td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="6" class="text-center">No orders found.</td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");
        if (toggleButton) {
            toggleButton.onclick = function() {
                el.classList.toggle("toggled");
            };
        }
    </script>
</body>

</html>