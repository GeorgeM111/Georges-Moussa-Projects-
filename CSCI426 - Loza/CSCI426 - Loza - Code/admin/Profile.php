<!DOCTYPE html>
<html lang="en">
<?php
include "../Database/db.php";
?>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Loza Chocolatier| Admin Dashboard</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer">
	<link rel="stylesheet" href="style.css">
</head>

<body>

	<?php include("sideBar.php");
		  include "updateProfile_backend/updateProfile_view.php";
	 ?>
	<div class="main position-absolute vh-100 bg-white">
		<?php include("topBar.php"); ?>
		<div class="container-fluid px-4 pb-5">
			<div class="row g-3 my-2 ">
				<div class="col-md-4">
					<div class="p-3 bg-light-brown shadow-sm d-flex justify-content-around align-items-center rounded">
						<div>
							<p class="fs-4">Last Update</p>
							<h3 class="fs-6">
								<?php
								$sql = "SELECT  last_date,position from users where username = ?";
								$stmt = $conn->prepare($sql);
								$stmt->bind_param("s",$_SESSION['adminLoginCredentials']['Username']);
								$stmt->execute();
								$result = $stmt->get_result();
								$stmt->execute(); 
								$row = $result->fetch_assoc();
								echo $row["last_date"];
								?>
							</h3>
						</div>
						<i class="fa-solid fa-clock fs-1 primary-text border rounded-pill bg-white p-3"></i>
					</div>
				</div>

				<div class="col-md-4">
					<div class="p-3 bg-light-brown shadow-sm d-flex justify-content-around align-items-center rounded">
						<div>
							<p class="fs-4">Position</p>
							<h3 class="fs-6">
								<?php echo $row["position"]; ?>
							</h3>
						</div>
						<i class="fa-solid fa-user-secret fs-1 primary-text border rounded-pill bg-white p-3"></i>
					</div>
				</div>
			</div>
			<div class="border border-3 border-light-brown py-3 px-3">
				<legend class="text-center h4-light-brown">Account Settings</legend>
				<form action="updateProfile_backend/updateProfile_server.php" method="post" enctype="multipart/form-data">
					<div class="mb-3 mt-3">
						<label for="username" class="form-label">Username: </label>
						<input type="text" class="form-control" id="username" placeholder="Enter username" value="<?php echo $_SESSION['adminLoginCredentials']['Username'] ?>" name="username">
						<?php printTakenUsername();
							  printInvalidUsername();
						 ?>														
					</div>
					<div class="mb-3">
						<label for="email" class="form-label">Email:</label>
						<input type="email" class="form-control" id="email" placeholder="Enter email" value="<?php echo $_SESSION['adminLoginCredentials']['Email'] ?>" name="email">
						<?php printTakenEmail(); ?>	
					</div>
					<div class="mb-3">
						<label for="pwd" class="form-label">Old Password:</label>
						<input type="password" class="form-control" id="pwd" placeholder="Enter old password" name="oPswd">
						<?php printbadOldPass(); ?>
					</div>
					<div class="mb-3">
						<label for="pwd" class="form-label">New Password:</label>
						<input type="password" class="form-control" id="pwd" placeholder="Enter new password (Optional)" name="nPswd">
						<?php printunchangedPass();
							printInvalidPassword();
						 ?>
					</div>
					<div class="mb-3">
						<label for="pwd" class="form-label">Confirm Password:</label>
						<input type="password" class="form-control" id="cpwd" placeholder="Re-enter new password (Required for New Password)" name="cPswd">
						<?php printbadNewPass(); ?>
					</div>
					<button type="submit" class="btn seeMore">Submit</button>
					<?php alertProfileUpdated(); ?>
				</form>
			</div>
			<div class="border border-3 border-light-brown py-3 px-3 mt-3">
	<p><i class="fa-solid fa-triangle-exclamation text-brown"></i> You can update  your username and email without setting a new password.</p>
	<p><i class="fa-solid fa-triangle-exclamation text-brown"></i> The new password can't be the same as your most recent password.</p>
    <p><i class="fa-solid fa-triangle-exclamation text-brown"></i> Password must have at least 8 characters , 1 lowecase, 1 uppercase, 1 special character, 1 digit, should have no spaces and should not exceed 16 characters.</p>
    <p><i class="fa-solid fa-triangle-exclamation text-brown"></i> Username & Email should be unique (Not registered before).</p>
    <p><i class="fa-solid fa-triangle-exclamation text-brown"></i> Username should have at least 8 characters (maximum 12 characters), 1 lowercase , 1 uppercase, 1 digit and no spaces.</p>
  </div>
		</div>
	</div>




	<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="index.js"></script>
	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>