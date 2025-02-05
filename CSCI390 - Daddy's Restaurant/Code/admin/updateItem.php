<?php
include "../database/db.php";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $itemID = isset($_POST['itemID']) ? (int) $_POST['itemID'] : 0;
    if ($itemID <= 0) {
        http_response_code(400);
        echo "Invalid item ID.";
        exit();
    }

    $name = isset($_POST['name']) ? trim($_POST['name']) : "";
    $price = isset($_POST['price']) ? (float) $_POST['price'] : 0;
    $description = isset($_POST['description']) ? trim($_POST['description']) : "";
    $category = isset($_POST['category']) ? (int) $_POST['category'] : 0;
    $availability = isset($_POST['availability']) ? trim($_POST['availability']) : "";

    if (empty($name) || empty($price) || empty($description) || $category <= 0 || empty($availability)) {
        http_response_code(400);
        echo "Please fill in all required fields.";
        exit();
    }

    $imageName = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "../customer/images/itemsImg/";
        $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $newFileName = uniqid("item_", true) . "." . $imageFileType;
        $targetFile = $targetDir . $newFileName;
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowedTypes)) {
            http_response_code(400);
            echo "Invalid image file type.";
            exit();
        }

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            http_response_code(500);
            echo "Error uploading image.";
            exit();
        }
        $imageName = $newFileName;
    }
    if ($imageName !== null) {
        $query = "UPDATE ITEM SET NAME = ?, PRICE = ?, DESCRIPTION = ?, CATEGORY_ID = ?, IMAGE = ?, Avaliablity = ? WHERE ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sdsissi", $name, $price, $description, $category, $imageName, $availability, $itemID);
    } else {
        $query = "UPDATE ITEM SET NAME = ?, PRICE = ?, DESCRIPTION = ?, CATEGORY_ID = ?, Avaliablity = ? WHERE ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sdsisi", $name, $price, $description, $category, $availability, $itemID);
    }

    if ($stmt->execute()) {
        echo "Item updated successfully.";
    } else {
        http_response_code(500);
        echo "Error updating item.";
    }
    $stmt->close();
    $conn->close();
} else {
    http_response_code(405);
    echo "Method not allowed.";
}
