<?php
	include "../Database/db.php";
		
        $sql = "SELECT * FROM messages,customers Where  customer_id=customers.CID  ORDER BY MESSAGES.ID DESC;";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					$fullName = $row['fname'] . " " . $row['mname'] . " " . $row['lname'];
					$details = '<td><p><button id="seeMore" class="btn seeMore" onclick="openDetails(' . $row['ID'] . ', \'' . $fullName . '\', \'' . $row['email'] . '\', \'' . $row['ACTION'] . '\')">Details</button></p></td>';
					echo "<tr>
								<td><p>" . $row['ID'] . "</p></td>
								<td><p>" . $fullName. "</p></td>
								<td><p>" . $row['email'] . "</p></td>
								<td><p>" .$row['SUBJECT'] . "</p></td>
								$details";
								$action;
					if($row['ACTION'] == "Pending"){
						$action = '<td><p> 
				 <button class="btn  setDone" id="setDone" value="' . $row['ID'] . '">Resolve</button>  <button class="btn  cancel" id="cancel" value="' . $row['ID'] . '">Reject</button></p></td>';							
					}
					if($row['ACTION'] == "Resolved"){
						$action = '<td><p> 
				 <button class="btn  resolved text-white" disabled>Resolved</button></p></td>';							
					}
					if($row['ACTION'] == "Rejected"){
						$action = '<td><p> 
				 <button class="btn  rejected" disabled>Rejected</button></p></td>';							
					}
					echo $action;
					$i++;
				}
			}	
								
	?>
									
									
						  </tr>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>

function openDetails(messageId, fullName, email, action) {
    window.location.href = 'messageDetails.php?messageId=' + messageId + '&fullName=' + fullName + '&email=' + email + '&action=' + action;
}



</script>