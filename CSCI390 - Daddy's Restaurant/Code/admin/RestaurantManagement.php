<?php
require_once("../database/db.php");
$query = "SELECT * FROM restaurant LIMIT 1";
$result = $conn->query($query);
$restaurant = $result->fetch_assoc();

$queryFeatured = "SELECT f.ID as featured_id, f.ITEM_ID, i.NAME as item_name 
                  FROM featured f 
                  LEFT JOIN ITEM i ON f.ITEM_ID = i.ID";
$resultFeatured = $conn->query($queryFeatured);
$featuredItems = [];
while ($row = $resultFeatured->fetch_assoc()) {
    $featuredItems[] = $row;
}
$queryRecommended = "SELECT r.ID as recommended_id, r.ITEM_ID, i.NAME as item_name 
                     FROM recommended r 
                     LEFT JOIN ITEM i ON r.ITEM_ID = i.ID";
$resultRecommended = $conn->query($queryRecommended);
$recommendedItems = [];
while ($row = $resultRecommended->fetch_assoc()) {
    $recommendedItems[] = $row;
}
$queryAllItems = "SELECT * FROM ITEM";
$resultAllItems = $conn->query($queryAllItems);
$allItems = [];
while ($row = $resultAllItems->fetch_assoc()) {
    $allItems[] = $row;
}
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
    <title>Restaurant Management</title>
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
            <div class="container-fluid px-4 border-top border-dark border-top-3">
                <h3 class="fs-4 pt-3 mb-4">Edit Restaurant Details</h3>
                <div class="bg-white p-4 rounded shadow-sm mb-5">
                    <form id="restaurant-form">
                        <div class="mb-3">
                            <label for="about1" class="form-label">About (Part 1)</label>
                            <textarea class="form-control" id="about1" name="about1" rows="3"><?php echo htmlspecialchars($restaurant['ABOUT1']); ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="about2" class="form-label">About (Part 2)</label>
                            <textarea class="form-control" id="about2" name="about2" rows="3"><?php echo htmlspecialchars($restaurant['ABOUT2']); ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="years" class="form-label">Years</label>
                            <input type="number" class="form-control" id="years" name="years" value="<?php echo htmlspecialchars($restaurant['YEARS']); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($restaurant['PHONE']); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($restaurant['EMAIL']); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="facebook" class="form-label">Facebook</label>
                            <input type="text" class="form-control" id="facebook" name="facebook" value="<?php echo htmlspecialchars($restaurant['FACEBOOK']); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="instagram" class="form-label">Instagram</label>
                            <input type="text" class="form-control" id="instagram" name="instagram" value="<?php echo htmlspecialchars($restaurant['INSTAGRAM']); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="kitchen_status" class="form-label">Kitchen Status</label>
                            <select class="form-select" id="kitchen_status" name="kitchen_status">
                                <option value="Busy" <?php echo ($restaurant['KITCHEN_STATUS'] == 'Busy') ? "selected" : ""; ?>>Busy</option>
                                <option value="Open" <?php echo ($restaurant['KITCHEN_STATUS'] == 'Open') ? "selected" : ""; ?>>Open</option>
                                <option value="Closed" <?php echo ($restaurant['KITCHEN_STATUS'] == 'Closed') ? "selected" : ""; ?>>Closed</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Save Restaurant Details</button>
                    </form>
                    <div id="restaurant-response" class="mt-3"></div>
                </div>
                <h3 class="fs-4 mb-4">Edit Featured Items</h3>
                <div class="bg-white p-4 rounded shadow-sm mb-5">
                    <h5>Current Featured Items</h5>
                    <ul id="featured-list" class="list-group mb-3">
                        <?php if (count($featuredItems) > 0): ?>
                            <?php foreach ($featuredItems as $f): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <?php echo htmlspecialchars($f['item_name']); ?>
                                    <button class="btn btn-danger btn-sm" onclick="removeFeatured(<?php echo $f['featured_id']; ?>)">Remove</button>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="list-group-item">No featured items yet.</li>
                        <?php endif; ?>
                    </ul>
                    <h5>Add Featured Item</h5>
                    <div class="input-group">
                        <select class="form-select" id="new-featured-item">
                            <option value="">Select an item</option>
                            <?php foreach ($allItems as $item): ?>
                                <option value="<?php echo $item['ID']; ?>"><?php echo htmlspecialchars($item['NAME']); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button class="btn btn-primary" id="add-featured-btn">Add</button>
                    </div>
                    <div id="featured-response" class="mt-3"></div>
                </div>
                <h3 class="fs-4 mb-4">Edit Recommended Items</h3>
                <div class="bg-white p-4 rounded shadow-sm mb-5">
                    <h5>Current Recommended Items</h5>
                    <ul id="recommended-list" class="list-group mb-3">
                        <?php if (count($recommendedItems) > 0): ?>
                            <?php foreach ($recommendedItems as $r): ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <?php echo htmlspecialchars($r['item_name']); ?>
                                    <button class="btn btn-danger btn-sm" onclick="removeRecommended(<?php echo $r['recommended_id']; ?>)">Remove</button>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="list-group-item">No recommended items yet.</li>
                        <?php endif; ?>
                    </ul>
                    <h5>Add Recommended Item</h5>
                    <div class="input-group">
                        <select class="form-select" id="new-recommended-item">
                            <option value="">Select an item</option>
                            <?php foreach ($allItems as $item): ?>
                                <option value="<?php echo $item['ID']; ?>"><?php echo htmlspecialchars($item['NAME']); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button class="btn btn-primary" id="add-recommended-btn">Add</button>
                    </div>
                    <div id="recommended-response" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");
        if (toggleButton) {
            toggleButton.onclick = function() {
                el.classList.toggle("toggled");
            };
        }

        $(document).ready(function() {
            $("#restaurant-form").submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: "update_restaurant.php",
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        $("#restaurant-response").html('<div class="alert alert-success">' + response + '</div>');
                    },
                    error: function(xhr, status, error) {
                        $("#restaurant-response").html('<div class="alert alert-danger">Error: ' + xhr.responseText + '</div>');
                    }
                });
            });
            $("#add-featured-btn").click(function() {
                var newItemId = $("#new-featured-item").val();
                if (newItemId == "") {
                    $("#featured-response").html('<div class="alert alert-warning">Please select an item to add.</div>');
                    return;
                }
                $.ajax({
                    url: "add_featured.php",
                    type: "POST",
                    data: {
                        item_id: newItemId
                    },
                    success: function(response) {
                        $("#featured-response").html('<div class="alert alert-success">' + response + '</div>');
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        $("#featured-response").html('<div class="alert alert-danger">Error: ' + xhr.responseText + '</div>');
                    }
                });
            });
            $("#add-recommended-btn").click(function() {
                var newItemId = $("#new-recommended-item").val();
                if (newItemId == "") {
                    $("#recommended-response").html('<div class="alert alert-warning">Please select an item to add.</div>');
                    return;
                }
                $.ajax({
                    url: "add_recommended.php",
                    type: "POST",
                    data: {
                        item_id: newItemId
                    },
                    success: function(response) {
                        $("#recommended-response").html('<div class="alert alert-success">' + response + '</div>');
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        $("#recommended-response").html('<div class="alert alert-danger">Error: ' + xhr.responseText + '</div>');
                    }
                });
            });
        });

        function removeFeatured(id) {
            if (confirm("Are you sure you want to remove this featured item?")) {
                $.ajax({
                    url: "delete_featured.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        alert(response);
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        alert("Error: " + xhr.responseText);
                    }
                });
            }
        }

        function removeRecommended(id) {
            if (confirm("Are you sure you want to remove this recommended item?")) {
                $.ajax({
                    url: "delete_recommended.php",
                    type: "POST",
                    data: {
                        id: id
                    },
                    success: function(response) {
                        alert(response);
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        alert("Error: " + xhr.responseText);
                    }
                });
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>