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
    <title>Orders Management</title>
    <style>
        .custom-select {
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
        }

        .page-btn.active {
            background-color: #0d6efd;
            color: white;
        }

        .custom-select:focus {
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        }

        #wrapper {
            overflow-x: hidden;
            background-image: linear-gradient(to right, #e0f7fa, #bceef4, #a4e6ef, #94d6f4, #91d5f4);
        }

        .secondary-bg {
            background-color: #94d6f4;
        }

        .list-group-item.active {
            background-color: transparent;
            color: blue;
            font-weight: bold;
            border: none;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<?php include "../database/db.php" ?>

<body>
    <?php include "navbar.php"; ?>
    <div class="d-flex" id="wrapper">
        <?php include "sidebar.php"; ?>
        <div id="page-content-wrapper">
            <div class="container-fluid px-4 border-top border-dark border-top-3">
                <div class="row g-3 my-2">
                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2">
                                    <?php
                                    $query = "SELECT * FROM orders";
                                    $result = $conn->query($query)->fetch_all();
                                    echo count($result);
                                    ?>
                                </h3>
                                <p class="fs-5">Orders</p>
                            </div>
                            <i class="fa-solid fa-hand-holding-usd fa-2x text-primary"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2">
                                    <?php
                                    $query = "SELECT * FROM order_out_dining";
                                    $result = $conn->query($query)->fetch_all();
                                    echo count($result);
                                    ?>
                                </h3>
                                <p class="fs-5"><small>Out Dinings</small></p>
                            </div>
                            <i class="fa-solid fa-truck fa-2x text-primary"></i>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2">
                                    <?php
                                    $query = "SELECT * FROM order_in_dining";
                                    $result = $conn->query($query)->fetch_all();
                                    echo count($result);
                                    ?>
                                </h3>
                                <p class="fs-5">In Dinings</p>
                            </div>
                            <i class="fa-solid fa-utensils fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-3">
                        <select class="form-select" id="dining-filter">
                            <option value="">All Dining Options</option>
                            <option value="in">In Dining</option>
                            <option value="out">Out Dining</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" id="status-filter">
                            <option value="">All Statuses</option>
                            <option value="Pending">Pending</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Ready">Ready</option>
                            <option value="Picked Up">Picked Up</option>
                            <option value="Canceled">Canceled</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-primary" id="filter-btn">Filter Orders</button>
                    </div>
                </div>
                <div class="row my-5">
                    <h3 class="fs-4 mb-3">Orders</h3>
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
                                <tbody id="orders-table-body">
                                </tbody>
                            </table>
                        </div>
                        <div class="pagination d-flex justify-content-center" id="orders-pagination-controls">
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

        var currentOrdersPage = 1;

        function loadOrders(page) {
            currentOrdersPage = page;
            var statusFilter = $("#status-filter").val();
            var diningFilter = $("#dining-filter").val();

            $.ajax({
                url: "fetch_orders.php",
                type: "GET",
                data: {
                    page: page,
                    status: statusFilter,
                    dining: diningFilter
                },
                dataType: "json",
                success: function(response) {
                    if (!response.data || response.data.length === 0) {
                        $("#orders-table-body").html("<tr><td colspan='7' class='text-center'>No orders available</td></tr>");
                        $("#orders-pagination-controls").empty();
                        return;
                    }
                    $("#orders-table-body").empty();
                    $.each(response.data, function(index, order) {
                        var statusOptions = "";
                        var currentStatus = order.status;
                        if (currentStatus === "Pending") {
                            statusOptions += '<option value="Pending" selected>Pending</option>';
                            statusOptions += '<option value="In Progress">In Progress</option>';
                            statusOptions += '<option value="Canceled">Canceled</option>';
                        } else if (currentStatus === "In Progress") {
                            statusOptions += '<option value="In Progress" selected>In Progress</option>';
                            statusOptions += '<option value="Ready">Ready</option>';
                            statusOptions += '<option value="Canceled">Canceled</option>';
                        } else if (currentStatus === "Ready") {
                            statusOptions += '<option value="Ready" selected>Ready</option>';
                            statusOptions += '<option value="Picked Up">Picked Up</option>';
                        } else if (currentStatus === "Picked Up") {
                            statusOptions += '<option value="Picked Up" selected>Picked Up</option>';
                        } else if (currentStatus === "Canceled") {
                            statusOptions += '<option value="Canceled" selected>Canceled</option>';
                        }
                        var dropdownDisabled = (currentStatus === "Picked Up" || currentStatus === "Canceled") ? 'disabled' : '';

                        var row = `
              <tr>
                <td>${order.id}</td>
                <td>${order.date_and_time}</td>
                <td>${order.total_price} $</td>
                <td>${order.dining_option} Dining</td>
                <td>
                  <select class="form-select status-dropdown" data-order-id="${order.id}" ${dropdownDisabled}>
                    ${statusOptions}
                  </select>
                </td>
                <td><button class="btn btn-primary" onclick="openDetails(${order.id},'${order.dining_option}')">Details</button></td>
              </tr>
            `;
                        $("#orders-table-body").append(row);
                    });
                    $("#orders-pagination-controls").empty();
                    for (let i = 1; i <= response.totalPages; i++) {
                        $("#orders-pagination-controls").append(`
              <button class="btn btn-secondary mx-1 page-btn ${i === page ? 'active' : ''}" data-page="${i}">${i}</button>
            `);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error);
                }
            });
        }

        $(document).ready(function() {
            loadOrders(1);
            $(document).on("click", ".page-btn", function() {
                var page = $(this).data("page");
                loadOrders(page);
            });
            $("#filter-btn").on("click", function() {
                loadOrders(1);
            });
            $(document).on("change", ".status-dropdown", function() {
                var orderId = $(this).data("order-id");
                var newStatus = $(this).val();
                $.ajax({
                    url: "update_order.php",
                    type: "POST",
                    data: {
                        order_id: orderId,
                        new_status: newStatus
                    },
                    success: function(response) {
                        loadOrders(currentOrdersPage);
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error on status update:", error);
                    }
                });
            });
        });

        function openDetails(orderID, option) {
            window.location.href = 'orderDetails.php?orderID=' + orderID + '&option=' + option;
        }

        function deleteOrder(orderID) {
            if (confirm("Are you sure you want to delete this order?")) {
                $.ajax({
                    url: "delete_order.php",
                    type: "POST",
                    data: {
                        order_id: orderID
                    },
                    success: function(response) {
                        loadOrders(currentOrdersPage);
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error on delete:", error);
                    }
                });
            }
        }
    </script>
</body>

</html>