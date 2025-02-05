<?php
require_once "../database/db.php";
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
    <title>Menu Management</title>
    <style>
        .form-section {
            margin-bottom: 40px;
        }

        .table-section {
            margin-top: 40px;
        }

        .pagination {
            margin-top: 20px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php include "navbar.php"; ?>
    <div class="d-flex" id="wrapper">
        <?php include "sidebar.php"; ?>
        <div id="page-content-wrapper">
            <div class="container-fluid px-4 border-top border-dark border-top-3">
                <div class="container-fluid">
                    <h1 class="mb-4 pt-3">Menu Management</h1>
                    <div class="form-section border p-4 rounded shadow-sm">
                        <h3>Add New Item</h3>
                        <form id="add-item-form" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="item-name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="item-name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="item-price" class="form-label">Price</label>
                                <input type="number" step="0.01" class="form-control" id="item-price" name="price" required>
                            </div>
                            <div class="mb-3">
                                <label for="item-description" class="form-label">Description</label>
                                <textarea class="form-control" id="item-description" name="description" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="item-image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="item-image" name="image" accept="image/*" required>
                            </div>
                            <div class="mb-3">
                                <label for="item-category" class="form-label">Category</label>
                                <select class="form-select" id="item-category" name="category_id" required>
                                    <option value="">Select Category</option>
                                    <?php
                                    $catQuery = "SELECT * FROM category";
                                    $catResult = $conn->query($catQuery);
                                    while ($cat = $catResult->fetch_assoc()) {
                                        echo '<option value="' . $cat['id'] . '">' . htmlspecialchars($cat['name']) . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="item-availability" class="form-label">Availability</label>
                                <select class="form-select" id="item-availability" name="avaliablity" required>
                                    <option value="Available" selected>Available</option>
                                    <option value="Unavailable">Unavailable</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Add Item</button>
                        </form>
                        <div id="item-response" class="mt-3"></div>
                    </div>
                    <div class="form-section border p-4 rounded shadow-sm">
                        <h3>Add New Category</h3>
                        <form id="add-category-form">
                            <div class="mb-3">
                                <label for="category-name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="category-name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="category-description" class="form-label">Description</label>
                                <textarea class="form-control" id="category-description" name="description" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Add Category</button>
                        </form>
                        <div id="category-response" class="mt-3"></div>
                    </div>
                    <div class="form-section border p-4 rounded shadow-sm">
                        <h3>Add New Ingredient</h3>
                        <form id="add-ingredient-form">
                            <div class="mb-3">
                                <label for="ingredient-name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="ingredient-name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="ingredient-price" class="form-label">Price</label>
                                <input type="number" step="0.01" class="form-control" id="ingredient-price" name="price" required>
                            </div>
                            <button type="submit" class="btn btn-success">Add Ingredient</button>
                        </form>
                        <div id="ingredient-response" class="mt-3"></div>
                    </div>
                    <div class="table-section border p-4 rounded shadow-sm">
                        <h3>Categories</h3>
                        <div id="categories-table"></div>
                        <div id="categories-pagination" class="pagination"></div>
                    </div>
                    <div class="table-section border p-4 rounded shadow-sm">
                        <h3>Ingredients</h3>
                        <div id="ingredients-table"></div>
                        <div id="ingredients-pagination" class="pagination"></div>
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

        $("#add-item-form").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "add_item.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $("#item-response").html('<div class="alert alert-success">' + response + '</div>');
                    $("#add-item-form")[0].reset();
                    loadItems(1);
                },
                error: function(xhr) {
                    $("#item-response").html('<div class="alert alert-danger">Error: ' + xhr.responseText + '</div>');
                }
            });
        });
        $("#add-category-form").submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "add_category.php",
                type: "POST",
                data: formData,
                success: function(response) {
                    $("#category-response").html('<div class="alert alert-success">' + response + '</div>');
                    $("#add-category-form")[0].reset();
                    loadCategories(1);
                },
                error: function(xhr) {
                    $("#category-response").html('<div class="alert alert-danger">Error: ' + xhr.responseText + '</div>');
                }
            });
        });
        $("#add-ingredient-form").submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: "add_ingredient.php",
                type: "POST",
                data: formData,
                success: function(response) {
                    $("#ingredient-response").html('<div class="alert alert-success">' + response + '</div>');
                    $("#add-ingredient-form")[0].reset();
                    loadIngredients(1);
                },
                error: function(xhr) {
                    $("#ingredient-response").html('<div class="alert alert-danger">Error: ' + xhr.responseText + '</div>');
                }
            });
        });

        function loadItems(page) {
            $.ajax({
                url: "fetch_items_admin.php",
                type: "GET",
                data: {
                    page: page
                },
                dataType: "json",
                success: function(response) {
                    var html = '<table class="table table-striped"><thead><tr><th>ID</th><th>Name</th><th>Price</th><th>Category</th><th>Availability</th><th>Action</th></tr></thead><tbody>';
                    $.each(response.data, function(i, item) {
                        html += '<tr>';
                        html += '<td>' + item.ID + '</td>';
                        html += '<td>' + item.NAME + '</td>';
                        html += '<td>' + item.PRICE + '</td>';
                        html += '<td>' + item.CATEGORY_ID + '</td>';
                        html += '<td>' + item.Avaliablity + '</td>';
                        html += '<td>';
                        html += '<a href="editItem.php?itemID=' + item.ID + '" class="btn btn-primary btn-sm me-2">Edit</a>';
                        html += '<button class="btn btn-danger btn-sm" onclick="deleteItem(' + item.ID + ')">Delete</button>';
                        html += '</td></tr>';
                    });
                    html += '</tbody></table>';
                    $("#items-table").html(html);
                    var paginationHtml = '';
                    for (var i = 1; i <= response.totalPages; i++) {
                        paginationHtml += '<button class="btn btn-secondary mx-1 page-btn" onclick="loadItems(' + i + ')">' + i + '</button>';
                    }
                    $("#items-pagination").html(paginationHtml);
                },
                error: function(xhr) {
                    $("#items-table").html("Error loading items: " + xhr.responseText);
                }
            });
        }

        function loadCategories(page) {
            $.ajax({
                url: "fetch_categories.php",
                type: "GET",
                data: {
                    page: page
                },
                dataType: "json",
                success: function(response) {
                    var html = '<table class="table table-striped"><thead><tr><th>ID</th><th>Name</th><th>Description</th><th>Action</th></tr></thead><tbody>';
                    $.each(response.data, function(i, category) {
                        html += '<tr>';
                        html += '<td>' + category.id + '</td>';
                        html += '<td>' + category.name + '</td>';
                        html += '<td>' + category.description + '</td>';
                        html += '<td>';
                        html += '<a href="editCategory.php?categoryID=' + category.id + '" class="btn btn-primary btn-sm me-2">Edit</a>';
                        html += '<button class="btn btn-danger btn-sm" onclick="deleteCategory(' + category.id + ')">Delete</button>';
                        html += '</td></tr>';
                    });
                    html += '</tbody></table>';
                    $("#categories-table").html(html);

                    var paginationHtml = '';
                    for (var i = 1; i <= response.totalPages; i++) {
                        paginationHtml += '<button class="btn btn-secondary mx-1 page-btn" onclick="loadCategories(' + i + ')">' + i + '</button>';
                    }
                    $("#categories-pagination").html(paginationHtml);
                },
                error: function(xhr) {
                    $("#categories-table").html("Error loading categories: " + xhr.responseText);
                }
            });
        }

        function loadIngredients(page) {
            $.ajax({
                url: "fetch_ingredients.php",
                type: "GET",
                data: {
                    page: page
                },
                dataType: "json",
                success: function(response) {
                    var html = '<table class="table table-striped"><thead><tr><th>ID</th><th>Name</th><th>Price</th><th>Action</th></tr></thead><tbody>';
                    $.each(response.data, function(i, ingredient) {
                        html += '<tr>';
                        html += '<td>' + ingredient.ID + '</td>';
                        html += '<td>' + ingredient.NAME + '</td>';
                        html += '<td>' + ingredient.PRICE + '</td>';
                        html += '<td>';
                        html += '<a href="editIngredient.php?ingredientID=' + ingredient.ID + '" class="btn btn-primary btn-sm me-2">Edit</a>';
                        html += '<button class="btn btn-danger btn-sm" onclick="deleteIngredient(' + ingredient.ID + ')">Delete</button>';
                        html += '</td></tr>';
                    });
                    html += '</tbody></table>';
                    $("#ingredients-table").html(html);

                    var paginationHtml = '';
                    for (var i = 1; i <= response.totalPages; i++) {
                        paginationHtml += '<button class="btn btn-secondary mx-1 page-btn" onclick="loadIngredients(' + i + ')">' + i + '</button>';
                    }
                    $("#ingredients-pagination").html(paginationHtml);
                },
                error: function(xhr) {
                    $("#ingredients-table").html("Error loading ingredients: " + xhr.responseText);
                }
            });
        }

        function deleteItem(id) {
            if (confirm("Are you sure you want to delete this item?")) {
                $.ajax({
                    url: "delete_item.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        alert(response);
                        loadItems(1);
                    },
                    error: function(xhr) {
                        alert("Error: " + xhr.responseText);
                    }
                });
            }
        }

        function deleteCategory(id) {
            if (confirm("Are you sure you want to delete this category?")) {
                $.ajax({
                    url: "delete_category.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        alert(response);
                        loadCategories(1);
                    },
                    error: function(xhr) {
                        alert("Error: " + xhr.responseText);
                    }
                });
            }
        }

        function deleteIngredient(id) {
            if (confirm("Are you sure you want to delete this ingredient?")) {
                $.ajax({
                    url: "delete_ingredient.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        alert(response);
                        loadIngredients(1);
                    },
                    error: function(xhr) {
                        alert("Error: " + xhr.responseText);
                    }
                });
            }
        }
        $(document).ready(function() {
            loadItems(1);
            loadCategories(1);
            loadIngredients(1);
        });
    </script>
</body>

</html>