<?php

declare(strict_types=1);
include "../database/db.php";
require_once "../backend/config_session.php";
if (isset($_POST['total']) && is_numeric($_POST['total'])) {
    $total = $_POST['total'];

    date_default_timezone_set('Asia/Beirut');

    $OIDsql = "SELECT * FROM orders ORDER BY ID DESC LIMIT 1";
    $OIDstmt = $conn->prepare($OIDsql);
    if (!$OIDstmt) {
        error_log("Database preparation failed: " . $conn->error);
        die("An error occurred while processing your request.");
    }

    if (!$OIDstmt->execute()) {
        error_log("Database execution failed: " . $OIDstmt->error);
        die("An error occurred while processing your request.");
    }
    $OIDresult = $OIDstmt->get_result();
    $OIDstmt->close();
    $orderid = $OIDresult->fetch_assoc()['ID'];
    $orderid++;
    $orderSQL = "INSERT INTO orders (ID,STATUS,DATE_AND_TIME,TOTAL_PRICE) VALUES (?,'Pending',NOW(),?)";
    $orderSTMT = $conn->prepare($orderSQL);
    $orderSTMT->bind_param("id", $orderid, $total);
    if (!$orderSTMT) {
        error_log("Database preparation failed: " . $conn->error);
        die("An error occurred while processing your request.");
    }

    if (!$orderSTMT->execute()) {
        error_log("Database execution failed: " . $orderSTMT->error);
        die("An error occurred while processing your request.");
    }
    $orderSTMT->close();
    $ingredientIds = [];
    foreach ($_SESSION['cart'] as $item) {
        if (!empty($item['removedIngredients'])) {
            $ingredientIds = array_merge($ingredientIds, $item['removedIngredients']);
        }
        if (!empty($item['addedIngredients'])) {
            $ingredientIds = array_merge($ingredientIds, $item['addedIngredients']);
        }
    }

    $ingredientIds = array_unique($ingredientIds);
    if (!empty($ingredientIds)) {
        $placeholders = implode(',', array_fill(0, count($ingredientIds), '?'));
        $sql = "SELECT ID, NAME FROM INGREDIENT WHERE ID IN ($placeholders)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(str_repeat('i', count($ingredientIds)), ...$ingredientIds);
        if (!$stmt) {
            error_log("Database preparation failed: " . $conn->error);
            die("An error occurred while processing your request.");
        }

        if (!$stmt->execute()) {
            error_log("Database execution failed: " . $stmt->error);
            die("An error occurred while processing your request.");
        }
        $result = $stmt->get_result();
        $stmt->close();

        $ingredientMap = [];
        while ($row = $result->fetch_assoc()) {
            $ingredientMap[$row['ID']] = $row['NAME'];
        }
    }

    foreach ($_SESSION['cart'] as $item) {
        $request = "No Special Request.";
        if (!empty($item['request'])) {
            $request = $item['request'];
        }
        $finalRequest = "A - Special Request:<br>&emsp;- " . $request . "<br>";
        if (!empty($item['removedIngredients'])) {
            $finalRequest .= "B - Removed Ingredients:<br>";
            foreach ($item['removedIngredients'] as $index => $ingredientId) {
                if (!$ingredientId) {
                    $finalRequest .= "&emsp;- None removed.<br>";
                    continue;
                }
                if (isset($ingredientMap[$ingredientId])) {
                    $finalRequest .= "&emsp;" . ($index + 1) . ". " . $ingredientMap[$ingredientId] . "<br>";
                }
            }
        }
        if (!empty($item['addedIngredients'])) {
            $finalRequest .= "C - Added Ingredients:<br>";
            foreach ($item['addedIngredients'] as $index => $ingredientId) {
                if (!$ingredientId) {
                    $finalRequest .= "&emsp;- None added.";
                    continue;
                }
                if (isset($ingredientMap[$ingredientId])) {
                    $finalRequest .= "&emsp;" . ($index + 1) . ". " . $ingredientMap[$ingredientId] . "<br>";
                }
            }
        }
        $detailsSQL = "INSERT INTO order_details (ORDER_ID,ITEM_ID,QUANTITY,REQUEST,FINAL_PRICE) VALUES(?,?,?,?,?)";
        $detailsStmt = $conn->prepare($detailsSQL);
        $detailsStmt->bind_param("iiisd", $orderid, $item['id'], $item['quantity'], $finalRequest, $item['price']);
        if (!$detailsStmt) {
            error_log("Database preparation failed: " . $conn->error);
            die("An error occurred while processing your request.");
        }

        if (!$detailsStmt->execute()) {
            error_log("Database execution failed: " . $detailsStmt->error);
            die("An error occurred while processing your request.");
        }
        $detailsStmt->close();
    }

    unset($_SESSION['cart']);
    if (isset($_POST['addressVal']) && isset($_POST['dineOutOptions'])) {
        $option = $_POST['dineOutOptions'];
        $outDinerId = $_SESSION['loginCredentials']['id'];
        $sql = "INSERT INTO ORDER_OUT_DINING (ORDER_ID,CUSTOMER_ID,OPTION) VALUES (?,?,?);";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis", $orderid, $outDinerId, $option);
        if (!$stmt) {
            error_log("Database preparation failed: " . $conn->error);
            die("An error occurred while processing your request.");
        }

        if (!$stmt->execute()) {
            error_log("Database execution failed: " . $stmt->error);
            die("An error occurred while processing your request.");
        }
        $stmt->close();
        if (!isset($_SESSION['loginCredentials']['address']) || $address !== $_SESSION['loginCredentials']['address']) {
            $addressVal = htmlspecialchars($_POST['addressVal'], ENT_QUOTES, 'UTF-8');
            addAddress($conn, $_SESSION['loginCredentials']['id'], $addressVal);
        }
        header("Location: orders.php");
    } else if (isset($_POST['tableNumber']) && is_numeric($_POST['tableNumber'])) {
        $tableNumber = $addressVal = htmlspecialchars($_POST['tableNumber'], ENT_QUOTES, 'UTF-8');
        $sql = "INSERT INTO ORDER_IN_DINING (ORDER_ID,TABLE_NUMBER) VALUES (?,?);";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $orderid, $tableNumber);
        if (!$stmt) {
            error_log("Database preparation failed: " . $conn->error);
            die("An error occurred while processing your request.");
        }

        if (!$stmt->execute()) {
            error_log("Database execution failed: " . $stmt->error);
            die("An error occurred while processing your request.");
        }
        $stmt->close();
        $_SESSION['orderPlacedSuccessfully'] = "Order #$orderid has been successfully placed!";
        header("Location: menu.php");
    } else {
        echo "An internal server error has occurred. Please try again. If the error persists, kindly contact us immediately.";
    }

    session_write_close();
} else {
    die("Invalid total value.");
}

function addAddress(object $conn, int $outDinerId, string $address)
{
    $sql = "UPDATE CUSTOMER SET ADDRESS = ? WHERE ID = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        error_log("Database preparation failed: " . $conn->error);
        die("An error occurred while updating the address.");
    }
    $stmt->bind_param("si", $address, $outDinerId);
    if (!$stmt->execute()) {
        error_log("Database execution failed: " . $stmt->error);
        die("An error occurred while updating the address.");
    }
    $stmt->close();
}
