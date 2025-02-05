<?php
include "../database/database.php";

if (isset($_POST['itemPrice']) && isset($_POST['itemID'])) {
    $itemPrice = $_POST['itemPrice'];
    $itemID = $_POST['itemID'];
    $query = "UPDATE items SET PRICE = ? WHERE ID = ?;";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("si", $itemPrice, $itemID);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Use a different price.']);
    }
    $stmt->close();
} else if (isset($_POST['itemName']) && isset($_POST['itemID'])) {
    $itemName = $_POST['itemName'];
    $itemID = $_POST['itemID'];
    $query = "UPDATE items SET NAME = ? WHERE ID = ?;";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("si", $itemName, $itemID);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Use a different name.']);
    }
    $stmt->close();
    echo json_encode(['success' => true]);
} else if (isset($_POST['itemCategory']) && isset($_POST['itemID'])) {
    $itemCategory = $_POST['itemCategory'];
    $itemID = $_POST['itemID'];
    $query = "UPDATE items SET CATEGORY_ID = ? WHERE ID = ?;";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("ii", $itemCategory, $itemID);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Choose a different category.']);
    }
    $stmt->close();
    echo json_encode(['success' => true]);
} else if (isset($_POST['itemID']) && isset($_FILES['itemImage'])) {
    $itemID = $_POST['itemID'];
    $folder = "../customer/images/items/";
    if ($_FILES['itemImage']['error'] == 0) {
        $imageName = basename($_FILES['itemImage']['name']);
        $targetPath = $folder . $imageName;
        if (move_uploaded_file($_FILES['itemImage']['tmp_name'], $targetPath) == true) {
            $query = "UPDATE items SET IMAGE = ? WHERE ID = ?;";
            $stmt = $connection->prepare($query);
            $stmt->bind_param("si", $imageName, $itemID);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => 'Choose a different image.']);
            }
            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'error' => 'Failed To Move File']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'File Not Uploadded']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'An Unexpected Error Has Occured. Try again.']);
}

$connection->close();
