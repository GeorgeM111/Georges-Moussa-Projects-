<?php
require_once("../database/db.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $about1 = isset($_POST['about1']) ? trim($_POST['about1']) : "";
    $about2 = isset($_POST['about2']) ? trim($_POST['about2']) : "";
    $years = isset($_POST['years']) ? (int) $_POST['years'] : 0;
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : "";
    $email = isset($_POST['email']) ? trim($_POST['email']) : "";
    $facebook = isset($_POST['facebook']) ? trim($_POST['facebook']) : "";
    $instagram = isset($_POST['instagram']) ? trim($_POST['instagram']) : "";
    $kitchen_status = isset($_POST['kitchen_status']) ? trim($_POST['kitchen_status']) : "";
    $query = "UPDATE restaurant SET ABOUT1 = ?, ABOUT2 = ?, YEARS = ?, PHONE = ?, EMAIL = ?, FACEBOOK = ?, INSTAGRAM = ?, KITCHEN_STATUS = ?";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        http_response_code(500);
        echo "Database error: " . $conn->error;
        exit();
    }
    $stmt->bind_param("ssisssss", $about1, $about2, $years, $phone, $email, $facebook, $instagram, $kitchen_status);

    if ($stmt->execute()) {
        echo "Restaurant details updated successfully.";
    } else {
        http_response_code(500);
        echo "Error updating restaurant details.";
    }

    $stmt->close();
    $conn->close();
} else {
    http_response_code(405);
    echo "Method not allowed.";
}
