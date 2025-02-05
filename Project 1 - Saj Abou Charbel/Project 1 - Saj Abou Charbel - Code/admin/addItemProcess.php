<?php
include "../database/database.php";
if (isset($_POST['itemName']) && isset($_POST['itemPrice']) && isset($_POST['itemCategory']) && isset($_FILES['itemImage'])) {
    $itemName = $_POST['itemName'];
    $itemPrice = $_POST['itemPrice'];
    $itemCategory = $_POST['itemCategory'];
    $folder = "../customer/images/items/";
    if ($_FILES['itemImage']['error'] == 0) {
        $imageName = basename($_FILES['itemImage']['name']);
        $targetPath = $folder . $imageName;
        if (move_uploaded_file($_FILES['itemImage']['tmp_name'], $targetPath) == true) {
            $query = "INSERT INTO items (NAME,PRICE,IMAGE,CATEGORY_ID) VALUES (?,?,?,?)";
            $stmt = $connection->prepare($query);
            $stmt->bind_param("sssi", $itemName, $itemPrice, $imageName, $itemCategory);
            $stmt->execute();
            $stmt->close();
            $connection->close();
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed To Move File']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'File Not Uploadded']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'An Unexpected Error Has Occured. Try again.']);
}
