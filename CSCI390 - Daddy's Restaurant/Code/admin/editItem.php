<?php
include "../database/db.php";
if (!isset($_GET['itemID']) || empty($_GET['itemID'])) {
    echo "No item selected.";
    exit();
}
$itemID = (int) $_GET['itemID'];

$stmt = $conn->prepare("SELECT * FROM ITEM WHERE ID = ?");
$stmt->bind_param("i", $itemID);
$stmt->execute();
$result = $stmt->get_result();
$item = $result->fetch_assoc();
$stmt->close();

if (!$item) {
    echo "Item not found.";
    exit();
}

$categories = [];
$query = "SELECT * FROM category";
$res = $conn->query($query);
while ($row = $res->fetch_assoc()) {
    $categories[] = $row;
}

$addable = [];
$stmt = $conn->prepare("SELECT a.INGREDIENT_ID, i.NAME FROM Addable a JOIN ingredient i ON a.INGREDIENT_ID = i.ID WHERE a.ITEM_ID = ?");
$stmt->bind_param("i", $itemID);
$stmt->execute();
$resAddable = $stmt->get_result();
while ($row = $resAddable->fetch_assoc()) {
    $addable[] = $row;
}
$stmt->close();

$removable = [];
$stmt = $conn->prepare("SELECT r.INGREDIENT_ID, i.NAME FROM Removable r JOIN ingredient i ON r.INGREDIENT_ID = i.ID WHERE r.ITEM_ID = ?");
$stmt->bind_param("i", $itemID);
$stmt->execute();
$resRemovable = $stmt->get_result();
while ($row = $resRemovable->fetch_assoc()) {
    $removable[] = $row;
}
$stmt->close();

$allIngredients = [];
$query = "SELECT * FROM ingredient";
$resAll = $conn->query($query);
while ($row = $resAll->fetch_assoc()) {
    $allIngredients[] = $row;
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
    <title>Edit Item</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php include "navbar.php"; ?>
    <div class="d-flex" id="wrapper">
        <?php include "sidebar.php"; ?>
        <div id="page-content-wrapper">
            <div class="container-fluid px-4 border-top border-dark border-top-3">
                <div id="response-message" class="mt-3"></div>
                <h2>Edit Item - <?php echo htmlspecialchars($item['NAME']); ?></h2>
                <form id="edit-item-form" enctype="multipart/form-data">
                    <input type="hidden" name="itemID" value="<?php echo $itemID; ?>">
                    <div class="mb-3">
                        <label for="name" class="form-label">Item Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($item['NAME']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price ($)</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($item['PRICE']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required><?php echo htmlspecialchars($item['DESCRIPTION']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="category" name="category" required>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?php echo $cat['id']; ?>" <?php echo ($cat['id'] == $item['CATEGORY_ID']) ? "selected" : ""; ?>>
                                    <?php echo htmlspecialchars($cat['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="availability" class="form-label">Availability</label>
                        <select class="form-select" id="availability" name="availability" required>
                            <option value="Available" <?php echo ($item['Avaliablity'] == "Available") ? "selected" : ""; ?>>Available</option>
                            <option value="Unavailable" <?php echo ($item['Avaliablity'] == "Unavailable") ? "selected" : ""; ?>>Unavailable</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Item Image</label>
                        <?php if (!empty($item['IMAGE'])): ?>
                            <div class="mb-2">
                                <img src="../customer/images/itemsImg/<?php echo htmlspecialchars($item['IMAGE']); ?>" alt="Current Image" style="width:100px;">
                            </div>
                        <?php endif; ?>
                        <input type="file" class="form-control" id="image" name="image">
                        <div class="form-text">Leave empty to keep the current image.</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="items.php" class="btn btn-secondary">Cancel</a>
                </form>

                <div class="mt-5">
                    <h3>Manage Addable Ingredients</h3>
                    <div id="addable-list" class="mb-3">
                        <ul class="list-group">
                            <?php if (count($addable) > 0): ?>
                                <?php foreach ($addable as $a): ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?php echo htmlspecialchars($a['NAME']); ?>
                                        <button class="btn btn-danger btn-sm" onclick="removeAddable(<?php echo $itemID; ?>, <?php echo $a['INGREDIENT_ID']; ?>)">Remove</button>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li class="list-group-item">No addable ingredients yet.</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="mb-3">
                        <label for="new-addable" class="form-label">Add New Addable Ingredient:</label>
                        <div class="input-group">
                            <select id="new-addable" class="form-select">
                                <option value="">Select an ingredient</option>
                                <?php foreach ($allIngredients as $ing): ?>
                                    <?php
                                    $already = false;
                                    foreach ($addable as $a) {
                                        if ($a['INGREDIENT_ID'] == $ing['ID']) {
                                            $already = true;
                                            break;
                                        }
                                    }
                                    if ($already) continue;
                                    ?>
                                    <option value="<?php echo $ing['ID']; ?>"><?php echo htmlspecialchars($ing['NAME']); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button class="btn btn-primary" onclick="addAddable(<?php echo $itemID; ?>)">Add</button>
                        </div>
                    </div>
                    <div id="addable-response"></div>
                </div>
                <div class="mt-5">
                    <h3>Manage Removable Ingredients</h3>
                    <div id="removable-list" class="mb-3">
                        <ul class="list-group">
                            <?php if (count($removable) > 0): ?>
                                <?php foreach ($removable as $r): ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <?php echo htmlspecialchars($r['NAME']); ?>
                                        <button class="btn btn-danger btn-sm" onclick="removeRemovable(<?php echo $itemID; ?>, <?php echo $r['INGREDIENT_ID']; ?>)">Remove</button>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li class="list-group-item">No removable ingredients yet.</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="mb-3">
                        <label for="new-removable" class="form-label">Add New Removable Ingredient:</label>
                        <div class="input-group">
                            <select id="new-removable" class="form-select">
                                <option value="">Select an ingredient</option>
                                <?php foreach ($allIngredients as $ing): ?>
                                    <?php
                                    $already = false;
                                    foreach ($removable as $r) {
                                        if ($r['INGREDIENT_ID'] == $ing['ID']) {
                                            $already = true;
                                            break;
                                        }
                                    }
                                    if ($already) continue;
                                    ?>
                                    <option value="<?php echo $ing['ID']; ?>"><?php echo htmlspecialchars($ing['NAME']); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button class="btn btn-primary" onclick="addRemovable(<?php echo $itemID; ?>)">Add</button>
                        </div>
                    </div>
                    <div id="removable-response"></div>
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
            $("#edit-item-form").submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "updateItem.php",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $("#response-message").html('<div class="alert alert-success">' + response + '</div>');
                    },
                    error: function(xhr, status, error) {
                        $("#response-message").html('<div class="alert alert-danger">Error: ' + xhr.responseText + '</div>');
                    }
                });
            });
        });

        function addAddable(itemID) {
            var ingredientID = $("#new-addable").val();
            if (ingredientID == "") {
                alert("Please select an ingredient to add.");
                return;
            }
            $.ajax({
                url: "add_addable.php",
                type: "POST",
                data: {
                    item_id: itemID,
                    ingredient_id: ingredientID
                },
                success: function(response) {
                    $("#addable-response").html('<div class="alert alert-success">' + response + '</div>');
                    location.reload();
                },
                error: function(xhr) {
                    $("#addable-response").html('<div class="alert alert-danger">Error: ' + xhr.responseText + '</div>');
                }
            });
        }

        function removeAddable(itemID, ingredientID) {
            if (confirm("Are you sure you want to remove this addable ingredient?")) {
                $.ajax({
                    url: "delete_addable.php",
                    type: "POST",
                    data: {
                        item_id: itemID,
                        ingredient_id: ingredientID
                    },
                    success: function(response) {
                        alert(response);
                        location.reload();
                    },
                    error: function(xhr) {
                        alert("Error: " + xhr.responseText);
                    }
                });
            }
        }

        function addRemovable(itemID) {
            var ingredientID = $("#new-removable").val();
            if (ingredientID == "") {
                alert("Please select an ingredient to add.");
                return;
            }
            $.ajax({
                url: "add_removable.php",
                type: "POST",
                data: {
                    item_id: itemID,
                    ingredient_id: ingredientID
                },
                success: function(response) {
                    $("#removable-response").html('<div class="alert alert-success">' + response + '</div>');
                    location.reload();
                },
                error: function(xhr) {
                    $("#removable-response").html('<div class="alert alert-danger">Error: ' + xhr.responseText + '</div>');
                }
            });
        }

        function removeRemovable(itemID, ingredientID) {
            if (confirm("Are you sure you want to remove this removable ingredient?")) {
                $.ajax({
                    url: "delete_removable.php",
                    type: "POST",
                    data: {
                        item_id: itemID,
                        ingredient_id: ingredientID
                    },
                    success: function(response) {
                        alert(response);
                        location.reload();
                    },
                    error: function(xhr) {
                        alert("Error: " + xhr.responseText);
                    }
                });
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>