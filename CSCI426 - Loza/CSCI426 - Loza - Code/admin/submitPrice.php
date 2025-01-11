<?php
	require_once "../Database/db.php";
	if(isset($_POST['price'])){
		$id =$_POST['id'];
        $paid = $_POST['paid'];
		$sql="UPDATE `orders` SET `PAID_PRICE` = ? WHERE `orders`.`orderid` = ?";
		$stmt=$conn->prepare($sql);
		$stmt->bind_param("id",$paid,$id);
		$stmt->execute();
		$stmt->close();
		die();
	;
	}
?>