<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <title>Home</title>
</head>


<body>
    <?php include "navbar.php" ?>
    <div class="d-flex" id="wrapper">
        <?php
        include "sidebar.php";
        ?>
        <div id="page-content-wrapper">
            <div class="container-fluid  border-top border-dark border-top-3  px-4">

                <div class="d-flex justify-content-center align-items-center mt-5">
                    <div class="row">
                        <div class="col-12 col-sm-6 mb-3">
                            <a href="addItem.php" class="text-decoration-none text-dark">
                                <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                                    <div>
                                        <h3 class="fs-2">Add Items</h3>
                                        <p></p>
                                    </div>
                                    <i class="fas fa-shopping-cart fs-1 text-danger border rounded-full secondary-bg p-3"></i>
                                </div>
                            </a>
                        </div>
                        <div class="col-12 col-sm-6 mb-3">
                            <a href="editItem.php" class="text-decoration-none text-dark">
                                <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                                    <div>
                                        <h3 class="fs-2">Edit Items</h3>
                                        <p></p>
                                    </div>
                                    <i class="fas fa-table-list fs-1 text-danger border rounded-full secondary-bg p-3"></i>
                                </div>
                            </a>
                        </div>
                        <div class="col-12 col-sm-6 mb-3">
                            <a href="removeItem.php" class="text-decoration-none text-dark">
                                <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                                    <div>
                                        <h3 class="fs-2">Remove Items</h3>
                                        <p></p>
                                    </div>
                                    <i class="fas fa-trash fs-1 text-danger border rounded-full secondary-bg p-3"></i>
                                </div>
                            </a>
                        </div>
                        <div class="col-12 col-sm-6 mb-3">
                            <a href="stock.php" class="text-decoration-none text-dark">
                                <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                                    <div>
                                        <h3 class="fs-2">Manage Stock</h3>
                                        <p></p>
                                    </div>
                                    <i class="fas fa-chart-line fs-1 text-danger border rounded-full secondary-bg p-3"></i>
                                </div>
                            </a>
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
    </script>
</body>

</html>