<?php
	include "../Database/db.php";
	
	if(isset($_POST['pending']) || isset($_POST['done']) || isset($_POST['cancel'])){
		if(isset($_POST['pending'])){
			$sql = "SELECT * FROM orders,customers Where orders.status = 'Pending' and customer_id=customers.CID;";
		}
		
		if(isset($_POST['done'])){
			$sql = "SELECT * FROM orders,customers Where orders.status = 'Completed' and customer_id=customers.CID";
		}
		
		if(isset($_POST['cancel'])){
			$sql = "SELECT * FROM orders,customers Where orders.status = 'Cancel' and customer_id=customers.CID";
		}
		
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				$i=1;
				while ($row = $result->fetch_assoc()){
					$fullName = $row['fname'] . " " . $row['mname'] . " " . $row['lname'];
					echo "<tr>
								<td><p>" . $i . "</p></td>
								<td><p>" . $row['orderid'] . "</p></td>
								<td><p>" . $fullName . "</p></td>
								<td><p>" . $row['created_at'] . "</p></td>
								";
								
					
					if(isset($_POST['pending'])){
			$text = '<td><p class="text-nowrap"><button id="seeMore" class="btn seeMore" onclick="openSeeMore('.$row['orderid'].')">Details</button> 
					 <button class="btn  setDone" id="setDone" value="' . $row['orderid'] . '">Set Done</button>  <button class="btn  cancel" id="cancel" value="' . $row['orderid'] . '">Cancel</button></p></td>';								
								
		}
		
		if((isset($_POST['done'])) || (isset($_POST['cancel']))) {
			$text = '<td><p><button id="seeMore" class="btn  seeMore" onclick="openSeeMore('.$row['orderid'].')">Details</button>';
					
		}
					$itemSQL = "SELECT COUNT(*) AS total, sum(quantity*price) as quantities FROM order_details WHERE order_details.order_id =? ";
					$stmt=$conn->prepare($itemSQL);
					$stmt->bind_param("i",$row['orderid']);
					$stmt->execute();
					$items= $stmt->get_result();
					if ($items) {
					$rowItem = $items->fetch_assoc();
					}
	?>

								<td><p><?php echo $rowItem['total'];?></p></td>
								<td><p><?php echo $rowItem['quantities'];?> </p></td>
								<td>
								<?php if(!$row['PAID_PRICE']){ ?>
                               <div class="d-flex justify-content-center align-items-center">
							   <input type="number" min="1" class="w-50 arial quantity-input" value="<?php echo $rowItem['quantities']; ?>" id="<?php echo $row['orderid'] ?>">
							   <button class="btn submitPrice ms-1" <?php echo 'value="' . $row['orderid'] . '"'; ?>>Submit</button>
							   </div>
                                <?php }else{
									echo "<p>".$row['PAID_PRICE']."</p>";}?>
							</td>
								<?php echo $text;?>
									
									
						  </tr>

				<?php	$i++;
				}
			}
			?>
		<?php
	}
?>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>

function openSeeMore(orderID){
    window.location.href = 'orderDetails.php?orderID=' + orderID;
}


</script>