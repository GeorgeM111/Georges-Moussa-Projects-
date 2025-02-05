<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css" />
    <title>User Management</title>
    <style>
        .custom-select {
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
        }

        .custom-select:focus {
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        }

        .page-btn.active {
            background-color: #0d6efd;
            color: white;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php include "navbar.php"; ?>
    <div class="d-flex" id="wrapper">
        <?php include "sidebar.php"; ?>
        <div id="page-content-wrapper">
            <div class="container-fluid border-top border-dark border-top-3 px-4">
                <div class="row my-4">
                    <div class="col-md-3">
                        <div class="card shadow-sm">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h3 class="fs-2 pe-5" id="total"></h3>
                                    <p class="fs-5"><small>Overall Users</small></p>
                                </div>
                                <div>
                                    <i class="fa-solid fa-user-group fa-2x text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow-sm">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h3 class="fs-2" id="unblocked"></h3>
                                    <p class="fs-5"><small>Eligible Users</small></p>
                                </div>
                                <div>
                                    <i class="fa-solid fa-user-shield fa-2x text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow-sm">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h3 class="fs-2" id="blocked"></h3>
                                    <p class="fs-5"><small>Blocked Users</small></p>
                                </div>
                                <div>
                                    <i class="fa-solid fa-user-xmark fa-2x text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow-sm">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <h3 class="fs-2" id="deleted"></h3>
                                    <p class="fs-5"><small>Deleted Users</small></p>
                                </div>
                                <div>
                                    <i class="fa-solid fa-user-slash fa-2x text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-5">
                    <h3 class="fs-4 mb-3">Registered Users</h3>
                    <div class="col">
                        <table class="table bg-white rounded shadow-sm table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">PhoneNumber</th>
                                    <th scope="col">Email Address</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                            </tbody>
                        </table>
                        <div class="pagination d-flex justify-content-center" id="pagination-controls">
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

        toggleButton.onclick = function() {
            el.classList.toggle("toggled");
        };
        var currentPage = 1;

        function loadUserCounts() {
            $.ajax({
                url: "fetch_user_counts.php",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    if (response.data) {
                        $("#total").text(response.data.total);
                        $("#unblocked").text(response.data.unblocked);
                        $("#blocked").text(response.data.blocked);
                        $("#deleted").text(response.data.deleted);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error);
                }
            });
        }

        function loadUsers(page) {
            currentPage = page;
            $.ajax({
                url: "fetch_users.php",
                type: "GET",
                data: {
                    page: page
                },
                dataType: "json",
                success: function(response) {
                    if (!response.data || response.data.length === 0) {
                        $("#table-body").html("<tr><td colspan='6' class='text-center'>No data available</td></tr>");
                        return;
                    }
                    $("#table-body").empty();
                    $.each(response.data, function(index, user) {
                        let address = user.address ? user.address : "Not Set";
                        let styleClass = user.address ? "" : 'class="text-danger fw-bold text-uppercase"';
                        let button = "";
                        if (user.status === "Unblocked") {
                            button = `<td><button class="btn btn-danger action-btn" data-id="${user.id}" data-action="block">Block Access</button></td>`;
                        } else if (user.status === "Blocked") {
                            button = `<td><button class="btn btn-success action-btn" data-id="${user.id}" data-action="unblock">Unblock Access</button></td>`;
                        } else if (user.status === "Deleted") {
                            button = `<td><button class="btn btn-secondary action-btn" data-id="${user.id}" data-action="reactivate">Reactivate</button></td>`;
                        }

                        $("#table-body").append(`
              <tr>
                  <td>${user.id}</td>
                  <td>${user.full_name}</td>
                  <td ${styleClass}>${address}</td>
                  <td>${user.phone_number}</td>
                  <td>${user.email}</td>
                  ${button}
              </tr>
            `);
                    });
                    $("#pagination-controls").empty();
                    for (let i = 1; i <= response.totalPages; i++) {
                        $("#pagination-controls").append(`
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
            loadUsers(1);
            loadUserCounts();
            $(document).on("click", ".page-btn", function() {
                const page = $(this).data("page");
                loadUsers(page);
            });

            $(document).on("click", ".action-btn", function() {
                const operationConfirmed = window.confirm("Are you sure you want to proceed with this operation?");
                if (operationConfirmed) {
                    const id = $(this).data("id");
                    const action = $(this).data("action");
                    let url = "";
                    if (action === "block") {
                        url = "block.php";
                    } else if (action === "reactivate") {
                        url = "reactivate.php"
                    } else if (action === "unblock") {
                        url = "unblock.php"
                    }
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            id: id
                        },
                        success: function(response) {
                            loadUsers(currentPage);
                            loadUserCounts();
                            alert("Operation Successful");
                        },
                        error: function(xhr, status, error) {
                            console.error("AJAX Error on " + action + ":", error);
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>