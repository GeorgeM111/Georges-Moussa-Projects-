<?php
	require_once "../Database/db.php";
	if(isset($_POST['setDone'])){
		$id =$_POST['id'];
		$sql="UPDATE `orders` SET `status` = 'Completed' WHERE `orders`.`orderid` = ?";
		$stmt=$conn->prepare($sql);
		$stmt->bind_param("i",$id);
		$stmt->execute();
		$stmt->close();
		die();
	;
	}
?>