<!DOCTYPE html>
<html lang="en">
<?php ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
 ?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <title>Loza Chocolatier</title>
    <link href="img/logo.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="style/animate.css">
</head>
<!-- Order ID, Date, Status, Total Price -->
<body>
    <?php
    include "header.php";
    if(!isset($_SESSION['loginCredentials'])){
        header("Location: home.php");
      }
    include "../Database/db.php";
    $sql = "SELECT * FROM orders WHERE CUSTOMER_ID = ? ORDER BY ORDERID DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$_SESSION['loginCredentials']['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    ?>
    <div class="container-xxl py-5">
    <div class="container">
    <h1 class="pb-0 italiana-regular text-bold text-center fs-3 wow slideInUp"><?php echo $_SESSION['loginCredentials']['Name'] ?>'s Order History</h1>
    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Date</th>
                                    <th>Total Price</th>
                                    <th>Items</th>
                                    <th>Status</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            while($row = $result->fetch_assoc()):
                            $query = "SELECT SUM(price) as total,COUNT(DISTINCT chocolate_id) as items FROM order_details WHERE ORDER_ID = ?";
                            $statement = $conn->prepare($query);
                            $statement->bind_param("i",$row['orderid']);
                            $statement->execute();
                            $detailsRes=$statement->get_result();
                            $statement->close();
                            $details = $detailsRes->fetch_assoc();
                            ?>
                            <tr>
                                <td><?php echo $row['orderid'] ?></td>
                                <td><?php echo $row['created_at'] ?></td>
                                <td><?php echo $details['total'] ?></td>
                                <td><?php echo $details['items'] ?></td>
                                <td><?php echo $row['status']; if($row['status'] == "Cancel") echo "ed"; ?></td>
                                <td><button class="btn btn-brown text-white" onclick="openSeeMore(<?php echo $row['orderid'] ?>)">Details</button></td>
                            </tr>
                            
                            <?php endwhile;  ?>
                            </tbody>
                        </table>
    </div>
    
    </div>
    </div>


    <?php
    include "footer.php";
    ?>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script>
            document.addEventListener('DOMContentLoaded', function() {
            new WOW({
                resetOnScroll: true
            }).init();
        });

        function openSeeMore(orderID){
       window.location.href = 'orderDetails.php?orderID=' + orderID;
       }

    </script>
</body>

</html>