<?php
require_once "functions.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loza Chocolatier| Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="style.css">
	<style>

	</style>
</head>

<body>
<?php include("sideBar.php");
      include "addUser_backend/addUser_view.php";
?>
    <div class="main position-absolute vh-100 bg-white">
        <?php include("topBar.php"); ?>		
        <div class="container-fluid px-4 pb-5">
        <div class="row g-3 my-2 ms-1 me-3">
                <div class="col-md-4">
                    <div class="p-3 bg-light-brown shadow-sm d-flex justify-content-around align-items-center rounded">
                        <div>
                            <h3 class="fs-2">
                              <?php echo $totalUsers ?>
                            </h3>
                            <p class="fs-6">Total Users</p>
                        </div>
                        <i class="fa-solid fa-user-shield fs-1 primary-text border rounded-pill bg-white p-3"></i>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 bg-light-brown shadow-sm d-flex justify-content-around align-items-center rounded">
                        <div>
                            <h3 class="fs-2">
                                <?php echo $totalAdmins ?>
                            </h3>
                            <p class="fs-6">Total Admins</p>
                        </div>
                        <i class="fa-solid fa-user-secret fs-1 primary-text border rounded-pill bg-white p-3"></i>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 bg-light-brown shadow-sm d-flex justify-content-around align-items-center rounded">
                        <div>
                            <h3 class="fs-2">
                            <?php echo $totalAssistants ?>
                            </h3>
                            <p class="fs-6">Total Assistants</p>
                        </div>
                        <i class="fa-solid fa-user-tie fs-1 primary-text border rounded-pill bg-white p-3"></i>
                    </div>
                </div>
        </div> 
        <div class="border border-3 border-light-brown py-3 px-3">
				<legend class="text-center  h4-light-brown">Add User</legend>
			<form class="row g-3" action="addUser_backend/addUser_server.php" method="post" enctype="multipart/form-data" autocomplete="off">
  <div class="col-md-6">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name="username" placeholder="Enter a username" value="<?php printUsername(); ?>">
    <?php printTakenUsername();
          printEmptyUsername();
          printInvalidUsername(); ?>
  </div>
  <div class="col-md-6">
    <label for="email" class="form-label">Email</label>
    <div class="input-group">
      <span class="input-group-text">@</span>
      <input type="text" class="form-control" name="email" id="email" aria-describedby="email" required value="<?php printEmail(); ?>">
    </div>
    <?php printTakenEmail();
          printInvalidEmail();
    ?>
  </div>
  <div class="col-md-6">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="pswd" placeholder="Enter a password">
    <?php printInvalidPassword(); ?>
  </div>
  <div class="col-md-6">
    <label for="cpassword" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="cpassword" name="cpswd" placeholder="Re-enter the password">
    <?php printPasswordsMismatch(); ?>
  </div>
  <div class="col-md-4">
    <label for="position" class="form-label">Position</label>
    <select id="position" class="form-select" name="position">
      <option>Admin</option>
      <option selected>Assistant</option>
    </select>
  </div>
  <div class="col-12">
    <button type="submit" class="btn seeMore">Create User</button>
  </div>
</form>
<?php printSuccessMessage() ?>
        </div>
        <div class="border border-3 border-light-brown py-3 px-3 mt-3">
        <p><i class="fa-solid fa-triangle-exclamation text-brown"></i> Password must have at least 8 characters , 1 lowecase, 1 uppercase, 1 special character, 1 digit, should have no spaces and should not exceed 16 characters.</p>
    <p><i class="fa-solid fa-triangle-exclamation text-brown"></i> Username & Email should be unique (Not registered before).</p>
    <p><i class="fa-solid fa-triangle-exclamation text-brown"></i> Username should have at least 8 characters (maximum 12 characters), 1 lowercase , 1 uppercase, 1 digit and no spaces.</p>
  </div>
        </div>
    </div>
        </div>
		 </div>
	<script src="index.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>