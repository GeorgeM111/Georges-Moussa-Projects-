<?php
	require_once "../Database/db.php";
	if(isset($_POST['cancel'])){
		$id =$_POST['id'];	
		$sql="UPDATE `MESSAGES` SET `ACTION` = 'Rejected' WHERE `MESSAGES`.`ID` = ?";
		$stmt=$conn->prepare($sql);
		$stmt->bind_param("i",$id);
		$stmt->execute();
		$stmt->close();
	}
?>