<?php
require_once("../database/db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = isset($_POST['name']) ? trim($_POST['name']) : "";
    $price = isset($_POST['price']) ? (float)$_POST['price'] : 0;
    $description = isset($_POST['description']) ? trim($_POST['description']) : "";
    $category_id = isset($_POST['category_id']) ? (int)$_POST['category_id'] : 0;
    $avaliablity = isset($_POST['avaliablity']) ? trim($_POST['avaliablity']) : "Available";
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = "../customer/images/itemsImg/";
        $imageFileType = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $newFileName = uniqid("item_", true) . "." . $imageFileType;
        $targetFile = $targetDir . $newFileName;
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowedTypes)) {
            http_response_code(400);
            echo "Invalid image type.";
            exit();
        }
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            http_response_code(500);
            echo "Error uploading image.";
            exit();
        }
        $image = $newFileName;
    } else {
        http_response_code(400);
        echo "Image is required.";
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO item (NAME, PRICE, DESCRIPTION, CATEGORY_ID, IMAGE, Avaliablity) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sdsiss", $name, $price, $description, $category_id, $image, $avaliablity);
    if ($stmt->execute()) {
        echo "Item added successfully.";
    } else {
        http_response_code(500);
        echo "Error adding item.";
    }
    $stmt->close();
    $conn->close();
} else {
    http_response_code(405);
    echo "Method not allowed.";
}
