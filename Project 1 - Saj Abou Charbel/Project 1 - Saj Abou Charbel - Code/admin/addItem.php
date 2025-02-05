<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <title>Add Item</title>
</head>

<body>
    <?php include "navbar.php" ?>
    <div class="d-flex" id="wrapper">
        <?php
        include "sidebar.php";
        include "functions.php";
        ?>
        <div id="page-content-wrapper">
            <div class="container-fluid  border-top border-dark border-top-3  px-4">
                <div class="row mt-3">
                    <div class="col-12 col-sm-6 bg-white p-3">
                        <form enctype="multipart/form-data" id="addItemForm">
                            <div class="form-group mt-1">
                                <label for="itemName" class="me-2">Name:</label>
                                <input type="text" name="itemName" id="itemName" class="form-control" placeholder="Enter the item's Name">
                            </div>
                            <div class="form-group mt-1">
                                <label for="itemPrice" class="me-2">Price:</label>
                                <input type="text" name="itemPrice" id="itemPrice" class="form-control" placeholder="Enter the item's Price">
                            </div>
                            <div class="form-group mt-1">
                                <label for="itemImage" class="me-2">Image:</label>
                                <input type="file" name="itemImage" id="itemImage" class="form-control" accept="image/*">
                            </div>

                            <div class="form-group mt-1">
                                <label for="itemCategory" class="me-2">Category:</label>
                                <select id="itemCategory" name="itemCategory" class="w-100 text-center py-1 form-control">
                                    <?php
                                    $query = "SELECT * FROM CATEGORY";
                                    $statement = $connection->prepare($query);
                                    $statement->execute();
                                    $categRes = $statement->get_result();
                                    $statement->close();
                                    while ($row = $categRes->fetch_assoc()) {

                                    ?>
                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                    <?php
                                    }
                                    $connection->close();
                                    ?>
                                </select>
                            </div>

                            <div class="d-grid mt-2">
                                <button class="btn btn-danger btn-block">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.1.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function() {
            el.classList.toggle("toggled");
        }

        function addItem() {
            const userConfirmed = window.confirm("Are you sure you want to add this item ?");

            if (userConfirmed) {
                let form = document.getElementById("addItemForm");
                let formData = new FormData(form);

                $.ajax({
                    type: 'POST',
                    url: 'addItemProcess.php',
                    data: formData,
                    processData: false, // Important for file upload
                    contentType: false, // Important for file upload
                    success: function(response) {
                        console.log('Server response:', response);
                        try {
                            let jsonResponse = JSON.parse(response.trim());
                            if (jsonResponse.success) {
                                alert('Item Added Successfully');
                                window.location.reload();
                            } else {
                                alert('Operation Failed: ' + jsonResponse.error);
                                window.location.reload();
                            }
                        } catch (e) {
                            console.error('JSON parsing error:', e);
                            alert('Failed To Add Item! Error: Invalid JSON response');
                        }
                    },
                    error: function(error) {
                        console.error('Error Adding Item:', error);
                    }
                });
            } else {
                alert("Operation Cancelled.");
                window.location.reload();
            }
            return false;
        }

        document.getElementById("addItemForm").addEventListener("submit", function(event) {
            addItem();
        });

        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form');
            forms.forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                });
            });
        });
    </script>
</body>

</html>