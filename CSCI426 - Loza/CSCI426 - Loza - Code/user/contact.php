<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['context']) && isset($_POST['subject'])){
         //Create The MESSAGE
        $subject = $_POST['subject'];
        $context = $_POST['context'];
        $action = "Pending";
        include "../Database/db.php";
        //mysqli_insert_id didnt work
        $sql = "SELECT 	ID FROM messages ORDER BY ID DESC LIMIT 1";
        $result = $conn->query($sql);
        $messageId = 1;
        if($result->num_rows>0){
        $messageId =$result->fetch_assoc()['ID'] + 1;
        }
        $sql = "INSERT INTO messages (ID,SUBJECT,CUSTOMER_ID,ACTION) VALUES(?,?,?,?)";
        $stmt = $conn->prepare($sql);
        session_start();
        $stmt->bind_param("isis",$messageId,$subject,$_SESSION['loginCredentials']['id'],$action);
        session_write_close();
        $stmt->execute();
        $stmt = null;
        $sql ="INSERT INTO context (CONTEXT,MESSAGE_ID) VALUES (?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si",$context,$messageId,);
        $stmt->execute();
        $stmt = null;
        $conn = null;
        session_start();
        $_SESSION['sentMessage'] = "Message Sent Successfully";
        session_write_close();
        header("Location: profile.php");
    }else{
        header("Location: profile.php");
        die();
    }
}else{
    header("Location: profile.php");
    die();
}