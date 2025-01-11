<?php
	require_once "../Database/db.php";
	if(isset($_POST['setDone'])){
		$id =$_POST['id'];
		$sql="UPDATE `MESSAGES` SET `ACTION` = 'Resolved' WHERE `MESSAGES`.`ID` = ?";
		$stmt=$conn->prepare($sql);
		$stmt->bind_param("i",$id);
		$stmt->execute();
		$stmt->close();
		die();
	;
	}
?>