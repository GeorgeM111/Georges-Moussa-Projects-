<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <title>Edit Item</title>
</head>

<body>
    <?php include "navbar.php" ?>
    <div class="d-flex" id="wrapper">
        <?php
        include "sidebar.php";
        include "functions.php";
        if (isset($_GET['token'])) {
            $token = $_GET['token'];
            $sql = "SELECT * FROM ITEMS WHERE ID = ?";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("i", $token);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
        } else {
            header("Location: editItem.php");
            die();
        }
        ?>
        <div id="page-content-wrapper">
            <div class="container-fluid  border-top border-dark border-top-3  px-4">
                <?php if ($result->num_rows == 1) {
                    $item = $result->fetch_assoc();
                    $sql2 = "SELECT name FROM CATEGORY WHERE id = ?";
                    $stmt2 = $connection->prepare($sql2);
                    $stmt2->bind_param("i", $item['CATEGORY_ID']);
                    $stmt2->execute();
                    $result2 = $stmt2->get_result();
                    $stmt2->close();
                    $categoryRow = $result2->fetch_assoc();
                    $category = $categoryRow['name'];
                ?>
                    <div class="row g-3 my-2">
                        <table class="table bg-white rounded shadow-sm  table-hover">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Category</th>
                                </tr>
                            </thead>
                            <tr>
                                <td>
                                    <img class="flex-shrink-0 img-fluid rounded" src="../customer/images/items/<?php echo $item['IMAGE']; ?>" alt="Product Image" style="width: 80px;">
                                </td>
                                <td>
                                    <?php echo $item['NAME']; ?>
                                </td>
                                <td>
                                    <?php echo $item['PRICE']; ?>
                                </td>
                                <td>
                                    <?php echo $category; ?>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="row my-5">
                        <div class="col-12 col-sm-6 mb-3">
                            <h3 class="fs-4 ">Edit Image</h3>
                            <div class="bg-white  px-5 py-3">
                                <form enctype="multipart/form-data" id="editImageForm">
                                    <h3 class="text-center">Image</h3>
                                    <div class="border border-1 p-2">
                                        <input type="file" id="itemImage" name="itemImage" accept="image/*">
                                        <input type="hidden" id="itemID" name="itemID" value="<?php echo $item['ID'] ?>">
                                    </div>
                                    <div class="d-grid mt-2">
                                        <button class="btn btn-danger btn-block" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 mb-3">
                            <h3 class="fs-4 ">Edit Name</h3>
                            <div class="bg-white px-5 py-3">
                                <form onsubmit="return editName(<?php echo $item['ID']; ?>)">
                                    <h3 class="text-center">Name</h3>
                                    <div class="border border-1 p-2">
                                        <input type="text" placeholder="Enter a new Name" class="w-100" value="<?php echo $item['NAME']; ?>" id="itemName">
                                    </div>
                                    <div class="d-grid mt-2">
                                        <button class="btn btn-danger btn-block" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 mb-3">
                            <h3 class="fs-4 ">Edit Price</h3>
                            <div class="bg-white  px-5 py-3">
                                <form onsubmit="return editPrice(<?php echo $item['ID']; ?>)">
                                    <h3 class="text-center">Price</h3>
                                    <div class="border border-1 p-2">
                                        <input type="text" placeholder="Enter a new Price" class="w-100" value="<?php echo $item['PRICE']; ?>" id="itemPrice">
                                    </div>
                                    <div class="d-grid mt-2">
                                        <button class="btn btn-danger btn-block" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 mb-3">
                            <h3 class="fs-4 ">Edit Category</h3>
                            <div class="bg-white px-5 py-3">
                                <form onsubmit="return editCategory(<?php echo $item['ID']; ?>)">
                                    <h3 class="text-center">Category</h3>
                                    <div class="border border-1 p-2">
                                        <select id="itemCategory" class="w-100 text-center py-1">
                                            <?php
                                            $query = "SELECT * FROM CATEGORY";
                                            $statement = $connection->prepare($query);
                                            $statement->execute();
                                            $categRes = $statement->get_result();
                                            $statement->close();
                                            while ($row = $categRes->fetch_assoc()) {
                                                $selected = "";
                                                if ($row['id'] === $item['CATEGORY_ID']) {
                                                    $selected = "selected";
                                                }
                                            ?>
                                                <option value="<?php echo $row['id'] ?>" <?php echo $selected; ?>><?php echo $row['name'] ?></option>
                                            <?php
                                            }
                                            $connection->close();
                                            ?>
                                        </select>
                                    </div>
                                    <div class="d-grid mt-2">
                                        <button class="btn btn-danger btn-block" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
<?php
                } else {
                    echo "An Unexpected Error Has Occured, please go back to the previous page and try again !";
                } ?>

<script src="js/jquery-3.1.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function() {
        el.classList.toggle("toggled");
    }

    document.addEventListener('DOMContentLoaded', function() {
        const forms = document.querySelectorAll('form');
        forms.forEach(function(form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
            });
        });
    });

    function editPrice(ID) {
        const userConfirmed = window.confirm("Are you sure you want to update the price?");

        if (userConfirmed) {
            let itemPrice = document.getElementById("itemPrice").value;
            let itemID = ID;
            $.ajax({
                type: 'POST',
                url: 'editItemProcess.php',
                data: {
                    itemID: itemID,
                    itemPrice: itemPrice,
                },
                success: function(response) {
                    console.log('Server response:', response);
                    try {
                        let jsonResponse = JSON.parse(response.trim());
                        if (jsonResponse.success) {
                            alert('Price Updated Successfully');
                            window.location.reload();
                        } else {
                            alert('Operation Failed: ' + jsonResponse.error);
                            window.location.reload();
                        }
                    } catch (e) {
                        console.error('JSON parsing error:', e);
                        alert('Failed To Update Price! Error: Invalid JSON response');
                    }
                },
                error: function(error) {
                    console.error('Error Updating Price:', error);
                }
            });
        } else {
            alert("Operation Cancelled.");
            window.location.reload();
        }
        return false;
    }

    function editName(ID) {
        const userConfirmed = window.confirm("Are you sure you want to update the name?");

        if (userConfirmed) {
            let itemName = document.getElementById("itemName").value;
            let itemID = ID;
            $.ajax({
                type: 'POST',
                url: 'editItemProcess.php',
                data: {
                    itemID: itemID,
                    itemName: itemName,
                },
                success: function(response) {
                    console.log('Server response:', response);
                    try {
                        let jsonResponse = JSON.parse(response.trim());
                        if (jsonResponse.success) {
                            alert('Name Updated Successfully');
                            window.location.reload();
                        } else {
                            alert('Operation Failed: ' + jsonResponse.error);
                            window.location.reload();
                        }
                    } catch (e) {
                        console.error('JSON parsing error:', e);
                        alert('Failed To Update Name! Error: Invalid JSON response');
                    }
                },
                error: function(error) {
                    console.error('Error Updating Name:', error);
                }
            });
        } else {
            alert("Operation Cancelled.");
            window.location.reload();
        }
        return false;
    }

    function editCategory(ID) {
        const userConfirmed = window.confirm("Are you sure you want to update the category?");

        if (userConfirmed) {
            let itemCategory = document.getElementById("itemCategory").value;
            let itemID = ID;
            $.ajax({
                type: 'POST',
                url: 'editItemProcess.php',
                data: {
                    itemID: itemID,
                    itemCategory: itemCategory,
                },
                success: function(response) {
                    console.log('Server response:', response);
                    try {
                        let jsonResponse = JSON.parse(response.trim());
                        if (jsonResponse.success) {
                            alert('Category Updated Successfully');
                            window.location.reload();
                        } else {
                            alert('Operation Failed: ' + jsonResponse.error);
                            window.location.reload();
                        }
                    } catch (e) {
                        console.error('JSON parsing error:', e);
                        alert('Failed To Update Category! Error: Invalid JSON response');
                    }
                },
                error: function(error) {
                    console.error('Error Updating Category:', error);
                }
            });
        } else {
            alert("Operation Cancelled.");
            window.location.reload();
        }
        return false;
    }

    function editImage() {
        const userConfirmed = window.confirm("Are you sure you want to update the image?");

        if (userConfirmed) {
            let form = document.getElementById("editImageForm");
            let formData = new FormData(form);

            $.ajax({
                type: 'POST',
                url: 'editItemProcess.php',
                data: formData,
                processData: false, // Important for file upload
                contentType: false, // Important for file upload
                success: function(response) {
                    console.log('Server response:', response);
                    try {
                        let jsonResponse = JSON.parse(response.trim());
                        if (jsonResponse.success) {
                            alert('Image Updated Successfully');
                            window.location.reload();
                        } else {
                            alert('Operation Failed: ' + jsonResponse.error);
                            window.location.reload();
                        }
                    } catch (e) {
                        console.error('JSON parsing error:', e);
                        alert('Failed To Update Image! Error: Invalid JSON response');
                    }
                },
                error: function(error) {
                    console.error('Error Updating Image:', error);
                }
            });
        } else {
            alert("Operation Cancelled.");
            window.location.reload();
        }
        return false;
    }

    document.getElementById("editImageForm").addEventListener("submit", function(event) {
        editImage();
    });
</script>
</body>

</html>