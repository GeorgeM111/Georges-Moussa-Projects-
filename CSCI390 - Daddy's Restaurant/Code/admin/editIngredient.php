<?php
require_once("../database/db.php");
if (!isset($_GET['ingredientID']) || empty($_GET['ingredientID'])) {
    echo "No ingredient selected.";
    exit();
}

$ingredientID = (int) $_GET['ingredientID'];
$stmt = $conn->prepare("SELECT * FROM ingredient WHERE ID = ?");
$stmt->bind_param("i", $ingredientID);
$stmt->execute();
$result = $stmt->get_result();
$ingredient = $result->fetch_assoc();
$stmt->close();

if (!$ingredient) {
    echo "Ingredient not found.";
    exit();
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
    <title>Edit Ingredient</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php include "navbar.php"; ?>
    <div class="d-flex" id="wrapper">
        <?php include "sidebar.php"; ?>
        <div id="page-content-wrapper">
            <div class="container-fluid px-4 border-top border-dark border-top-3">
                <div class="container mt-4">
                    <h2>Edit Ingredient - <?php echo htmlspecialchars($ingredient['NAME']); ?></h2>
                    <div id="response-message" class="mt-3"></div>
                    <form id="edit-ingredient-form">
                        <input type="hidden" name="ingredientID" value="<?php echo $ingredientID; ?>">

                        <div class="mb-3">
                            <label for="name" class="form-label">Ingredient Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($ingredient['NAME']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price ($)</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($ingredient['PRICE']); ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <a href="menuManagement.php" class="btn btn-secondary">Cancel</a>
                    </form>
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
            $("#edit-ingredient-form").submit(function(e) {
                e.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: "update_ingredient.php",
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        $("#response-message").html('<div class="alert alert-success">' + response + '</div>');
                    },
                    error: function(xhr) {
                        $("#response-message").html('<div class="alert alert-danger">Error: ' + xhr.responseText + '</div>');
                    }
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>