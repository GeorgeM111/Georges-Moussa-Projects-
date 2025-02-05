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

    <div class="container-fluid">
        <div class="mx-auto d-block mt-3">
            <h1 class="pacifico text-center">Orders History</h1>
            <hr>
        </div>

        <?php
        date_default_timezone_set('Asia/Beirut');
        $currentTime = time();
        $ordersQuery = "SELECT O.DATE_AND_TIME,O.TOTAL_PRICE,O.STATUS,O.ID  FROM orders as O, order_out_dining as OOD WHERE O.ID = OOD.ORDER_ID AND customer_id = ?";
        $stmt = $conn->prepare($ordersQuery);
        $stmt->bind_param("i", $_SESSION['loginCredentials']['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        ?>
        <div class="row my-5 w-75 d-block mx-auto">
            <h2 class="fs-3 mb-3 text-decoration-underline">Placed Orders</h2>
            <div class="col">
                <?php
                if ($result->num_rows > 0) { ?>
                    <table class="table border border-5 table-bordered bg-white rounded shadow-sm table-hover">
                        <thead>
                            <tr>
                                <th scope="col" width="50">#</th>
                                <th scope="col">Date And Time</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                                <th scope="col">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($order = $result->fetch_assoc()) {
                                $orderTime = strtotime($order['DATE_AND_TIME']);
                                $timeSinceOrder = $currentTime - $orderTime;
                                $isCancelable = $timeSinceOrder <= 30 && $order['STATUS'] == "Pending";
                                $timeRemaining = max(0, 30 - $timeSinceOrder);
                            ?>
                                <tr>
                                    <td><?php echo $order['ID']; ?></td>
                                    <td><?php echo $order['DATE_AND_TIME']; ?></td>
                                    <td><?php echo $order['TOTAL_PRICE'] . " $"; ?></td>
                                    <td><?php echo $order['STATUS']; ?></td>
                                    <td>
                                        <?php if ($isCancelable) : ?>
                                            <button class="btn btn-danger cancel-btn" id="<?php echo $order['ID'] ?>" data-time-remaining="<?php echo $timeRemaining; ?>" data-order-id="<?php echo $order['ID']; ?>">Cancel (<?php echo $timeRemaining; ?>s)</button>
                                        <?php else : ?>
                                            <button class="btn btn-secondary" disabled>Cancel (Call Us)</button>
                                        <?php endif; ?>
                                    </td>
                                    <td><button class="btn btn-success" onclick="window.location.href='orderDetails.php?OID=<?php echo $order['ID'] ?>'">Details</button></td>
                                </tr>
                            <?php
                            } ?>
                        </tbody>
                    </table>
                <?php
                } else { ?>
                    <h5 class="text-center text-danger">No Orders Found</h5>
                <?php }
                ?>

            </div>
        </div>
    </div>

    <?php include("footer.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.cancel-btn').each(function() {
                let button = $(this);
                let timeRemaining = parseInt(button.data('time-remaining'));
                let orderID = button.data('order-id');
                let countdownInterval;

                function startCountdown() {
                    countdownInterval = setInterval(function() {
                        if (timeRemaining > 0) {
                            button.text(`Cancel (${timeRemaining}s)`);
                            timeRemaining--;
                        } else {
                            button.text('Cancel (Call Us)');
                            button.removeClass('btn-danger').addClass('btn-secondary');
                            button.prop('disabled', true);
                            clearInterval(countdownInterval);
                        }
                    }, 1000);
                }

                startCountdown();

                let statusCheckInterval = setInterval(function() {
                    $.ajax({
                        url: "check_order_status.php",
                        type: "POST",
                        data: {
                            orderID: orderID,
                        },
                        success: function(response) {
                            try {
                                let parsedResponse = typeof response === "string" ? JSON.parse(response) : response;

                                if (parsedResponse.success && parsedResponse.status !== 'Pending' && parsedResponse.status !== 'Canceled') {
                                    alert("The order is being processed. To cancel, please call us.");
                                    clearInterval(statusCheckInterval);
                                    setTimeout(function() {
                                        window.location.reload();
                                    }, 5000);
                                }
                            } catch (e) {
                                console.error("Failed to parse response:", e);
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Failed to check order status:", status, error);
                        }
                    });
                }, 1000);

                button.on('click', function() {
                    if (!button.prop('disabled')) {
                        $.ajax({
                            url: "cancel_order.php",
                            type: "POST",
                            data: {
                                orderID: orderID,
                            },
                            success: function(response) {
                                try {
                                    let parsedResponse = typeof response === "string" ? JSON.parse(response) : response;

                                    if (parsedResponse.success) {
                                        alert("Order Canceled Successfully");
                                        window.location.reload();
                                    } else {
                                        alert("Failed to cancel order, try again.");
                                    }
                                } catch (e) {
                                    console.error("Failed to parse response:", e);
                                    alert("An error occurred while processing the request.");
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error("Failed to cancel order:", status, error);
                                alert("An error has occurred, please try again or call us.");
                            }
                        });
                    }
                });
            });
        });
    </script>



</body>

</html>