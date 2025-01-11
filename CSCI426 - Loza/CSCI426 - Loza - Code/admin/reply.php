<?php 
include "../Database/db.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['reply']) && isset($_POST['MID']) && isset($_POST['FN']) && isset($_POST['EM']) && isset($_POST['AC'])){
        $reply = $_POST['reply'];
        $MID = $_POST['MID'];
        $sql = "INSERT INTO REPLIES (REPLY,MESSAGE_ID,USER_ID) VALUES(?,?,?)";
        $stmt = $conn->prepare($sql);
        session_start();
        $stmt->bind_param("sii",$reply,$MID,$_SESSION['adminLoginCredentials']['ID']);
        session_write_close();
        $stmt->execute();
        $stmt->close();
        $stmt = null;
        $sql= null;

        $fullName = $_POST['FN'];
        $action =$_POST['AC'];
        $email =$_POST['EM'];
    $redirectUrl = "messageDetails.php?messageId=$MID&fullName=$fullName&email=$email&action=$action";
header("Location: $redirectUrl");
exit;

        header("Location: messageDetails.php");
    }else {
        header("Location: messageDetails.php");
        die();
    }
}else {
    header("Location: messageDetails.php");
    die();
}


?>