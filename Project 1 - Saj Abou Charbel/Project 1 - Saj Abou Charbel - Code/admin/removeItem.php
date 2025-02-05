<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <title>Remove Items</title>
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
                <div class="row g-3 my-2">
                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div>
                                <h3 class="fs-2">
                                    <?php
                                    printNumberOfItems($connection);
                                    ?>
                                </h3>
                                <p class="fs-5">Items</p>
                            </div>
                            <i class="fas fa-gift fs-1 text-danger border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>
                </div>

                <div class="row my-5">
                    <h3 class="fs-4 mb-3">Items</h3>
                    <?php printItemsForDelete($connection);
                    $connection->close();
                    ?>
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
        };

        function removeItem(ID) {
            const userConfirmed = window.confirm("Are you sure you want to remove the item?");

            if (userConfirmed) {
                let itemID = ID;
                $.ajax({
                    type: 'POST',
                    url: 'removeItemProcess.php',
                    data: {
                        itemID: itemID,
                    },
                    success: function(response) {
                        console.log('Server response:', response);
                        try {
                            let jsonResponse = JSON.parse(response.trim());
                            if (jsonResponse.success) {
                                alert('Item Removed Successfully');
                                window.location.reload();
                            } else {
                                alert('Operation Failed: ' + jsonResponse.error);
                                window.location.reload();
                            }
                        } catch (e) {
                            console.error('JSON parsing error:', e);
                            alert('Failed To Remove Item! Error: Invalid JSON response');
                        }
                    },
                    error: function(error) {
                        console.error('Error Removing Item:', error);
                    }
                });
            } else {
                alert("Operation Cancelled.");
                window.location.reload();
            }
            return false;
        }
    </script>
</body>

</html>