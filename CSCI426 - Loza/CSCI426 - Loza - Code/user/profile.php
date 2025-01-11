<!DOCTYPE html>
<html lang="en">
<?php ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
 ?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="initial-scale=1, maximum-scale=1">
  <title>Loza Chocolatier</title>
  <link href="img/logo.png" rel="icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="style/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer">
  <link rel="stylesheet" href="style/animate.css">
</head>

<body>
  <?php
  include "header.php";
  include "../Database/db.php";
  if (!isset($_SESSION['loginCredentials'])) {
    header("Location: home.php");
  }
  include "updateProfile_backend/updateProfile_view.php";
  ?>
  <div class="container-fluid px-0 mx-0">
    <?php
    if (isset($_SESSION['sentMessage'])) {
      echo '
          <script>
              document.addEventListener("DOMContentLoaded", function() {
                  alert("' . $_SESSION['sentMessage'] . '");
              });
          </script>
          ';
      unset($_SESSION['sentMessage']);
    }
    ?>
    <div class="container-fluid pb-3" id="body">
      <h1 class="py-3 italiana-regular text-bold text-center fs-3 wow slideInUp"><?php echo $_SESSION['loginCredentials']['Name'] ?>'s Profile</h1>
      <div class="border border-2 pb-3 mx-2 border-dark wow fadeInDown">
        <form class="row g-3 px-2" action="updateProfile_backend/updateProfile_server.php" method="post" enctype="multipart/form-data" autocomplete="off">
          <div class="col-md-6 wow fadeInRight" data-wow-delay="1s">
            <label for="phNb" class="form-label">Phone Number</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
              <input type="text" class="form-control" name="phNb" id="phNb" aria-describedby="phNb" value="<?php echo $_SESSION['loginCredentials']['Phone'] ?>">
            </div>
            <?php printRegisteredPhoneNumber();
            printInvalidPhoneNumber();
            ?>
          </div>
          <div class="col-md-6 wow fadeInLeft" data-wow-delay="0.5s">
            <label for="email" class="form-label">Email</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
              <input type="email" class="form-control" name="email" id="email" aria-describedby="email" value="<?php echo $_SESSION['loginCredentials']['Email'] ?>">
            </div>
            <?php printRegisteredEmail();
            printInvalidEmail();
            ?>
          </div>
          <div class="col-md-6 wow fadeInRight" data-wow-delay="0.5s">
            <label for="address" class="form-label">Address</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span>
              <input type="text" class="form-control" name="address" id="address" aria-describedby="address" value="<?php echo $_SESSION['loginCredentials']['Address'] ?>">
            </div>
          </div>
          <div class="col-md-6 wow fadeInLeft" data-wow-delay="0.5s">
            <label for="company" class="form-label">Company</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa-solid fa-building"></i></span>
              <input type="text" class="form-control" name="company" id="company" aria-describedby="company" value="<?php echo $_SESSION['loginCredentials']['Company'] ?>">
            </div>
          </div>
          <div class="col-md-12 wow fadeIn" data-wow-delay="0.5s">
            <label for="0password" class="form-label">Old Password</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
              <input type="password" class="form-control" name="opassword" id="opassword" aria-describedby="opassword">
            </div>
            <?php printbadOldPass(); ?>
          </div>
          <div class="col-md-6 wow fadeInRight" data-wow-delay="0.5s">
            <label for="password" class="form-label">New Password</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
              <input type="password" class="form-control" name="password" id="password" aria-describedby="password">
            </div>
            <?php printInvalidPassword();
            printunchangedPass(); ?>
          </div>
          <div class="col-md-6 wow fadeInLeft" data-wow-delay="0.5s">
            <label for="cpassword" class="form-label">Confirm New Password</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
              <input type="password" class="form-control" name="cpassword" id="cpassword" aria-describedby="cpassword">
            </div>
            <?php
            printbadNewPass();
            ?>
          </div>
          <div class="wow fadeIn  text-danger" data-wow-delay="0.5s">
            <small><i class="fa-solid fa-triangle-exclamation text-brown"></i> Password must have at least 8 characters , 1 lowecase, 1 uppercase, 1 special character, 1 digit, should have no spaces and should not exceed 16 characters.</small><br>
            <small><i class="fa-solid fa-triangle-exclamation text-brown"></i> Username & Email should be unique (Not registered before).</small><br>
            <small><i class="fa-solid fa-triangle-exclamation text-brown"></i> Username should have at least 8 characters (maximum 12 characters), 1 lowercase , 1 uppercase, 1 digit and no spaces.</small><br>
          </div>
          <div class="col-12 wow fadeIn" data-wow-delay="0.5s">
            <button type="submit" class="btn btn-brown text-white">Edit Profile</button>
          </div>
          <?php alertProfileUpdated(); ?>
        </form>
      </div>
      <h1 class="py-3 italiana-regular text-bold text-center fs-3 wow slideInUp">Contact Us</h1>
      <div class="border border-2 pb-3 mx-2 border-dark wow fadeInDown">
        <form class="row g-3 px-2" action="contact.php" method="post" enctype="multipart/form-data" autocomplete="off">
          <div class="col-md-12">
            <label for="phNb" class="form-label">Subject</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fa-solid fa-envelope-open-text"></i></span>
              <input type="text" class="form-control" name="subject" id="subject" aria-describedby="subject" required>
            </div>
          </div>
          <div class="col-md-12">
            <label for="context" class="form-label">Context</label>
            <textarea name="context" id="context" class="w-100" rows="4" cols="50" required></textarea>
          </div>
          <div class="col-12 wow fadeIn text-center">
            <button type="submit" class="btn btn-brown text-white">Submit</button>
          </div>
        </form>
      </div>
      <h1 class="py-3 italiana-regular text-bold text-center fs-3 wow slideInUp"><?php echo $_SESSION['loginCredentials']['Name'] ?>'s Recent Messages</h1>
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>Message ID</th>
              <th>Subject</th>
              <th>Status</th>
              <th>Details</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = "SELECT * FROM messages WHERE CUSTOMER_ID = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $_SESSION['loginCredentials']['id']);
            $stmt->execute();
            $messageres = $stmt->get_result();
            $stmt->close();
            while ($row = $messageres->fetch_assoc()) : ?>
              <tr>
                <td><?php echo $row['ID'] ?></td>
                <td><?php echo $row['SUBJECT'] ?></td>
                <td><?php echo $row['ACTION'] ?></td>
                <td><button class="btn btn-brown text-white" onclick="openSeeMore(<?php echo $row['ID'] ?>)">Details</button></td>
              </tr>
            <?php endwhile;
            ?>
          </tbody>
        </table>

      </div>
    </div>
  </div>
  <?php include "footer.php" ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      new WOW({
        resetOnScroll: true
      }).init();
    });

    function openSeeMore(messageID) {
      window.location.href = 'messageDetails.php?messageID=' + messageID;
    }
  </script>
</body>

</html>