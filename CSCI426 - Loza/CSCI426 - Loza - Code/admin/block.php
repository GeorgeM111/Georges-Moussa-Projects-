<?php
	require_once "../Database/db.php";
	if(isset($_POST['cancel'])){
		$id =$_POST['id'];
		
		$sql="UPDATE `customers` SET `status` = 'Blocked' WHERE `customers`.`CID` = ?";
		$stmt=$conn->prepare($sql);
		$stmt->bind_param("i",$id);
		$stmt->execute();
		$stmt->close();
	}
?>