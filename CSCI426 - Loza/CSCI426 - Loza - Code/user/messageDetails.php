<!DOCTYPE html>
<html lang="en">
<?php
ini_set('display_errors', '1');
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
  <link rel="stylesheet" href="style/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer">
  <link rel="stylesheet" href="style/animate.css">
</head>

<body>
  <?php
  include "header.php";
  include "../Database/db.php";
  $messageID = $_GET['messageID'];
  $sql = "SELECT
    m.subject AS SUBJECT,
    c.email AS Email,
    CONCAT(c.fname, ' ', c.mname, ' ', c.lname) AS Name
FROM
    messages m
JOIN
    customers c ON m.customer_id = c.cid WHERE m.ID = ?
    ;";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i",$messageID);
  $stmt->execute();
  $res=$stmt->get_result()->fetch_assoc();
  $stmt->close();
  $subject = $res['SUBJECT'];
  $fullName = $res['Name'];
  $email = $res['Email'];
  if(!isset($_SESSION['loginCredentials'])){
    header("Location: home.php");
  }
  ?>
  <div class="container-fluid px-0 mx-0">
    <div class="container-fluid pb-3" id="body">
      <h1 class="py-3 italiana-regular text-bold text-center fs-3 wow slideInUp"><?php echo $subject ?></h1>
        <?php
        $sql = "SELECT * FROM   context,messages WHERE MESSAGE_ID= ? AND messages.ID = MESSAGE_ID";
        $stmt= $conn->prepare($sql);
        $stmt->bind_param("i",$messageID);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        
        $sql2 = "SELECT * FROM replies,messages WHERE MESSAGE_ID= ? AND messages.ID = MESSAGE_ID";
        $stmt2= $conn->prepare($sql2);
        $stmt2->bind_param("i",$messageID);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        $stmt2->close();
        ?>
        <div class="border border-2 pb-3 mx-2 border-dark wow fadeInDown text-center">
        <?php
                    while ($row = $result->fetch_assoc()) {
                        echo '
                    <h3 class="fs-5 text-capitalize mb-0 pb-0">From : ' . $fullName . '</h3>
                    <small class="text-secondary">' . $email . '</small>
                    <div class="mt-0 my-3">
                    <p class="my-2">' . $row['CONTEXT'] . '</p>
                    </div>
                    ';
                    }
                    while($row2 = $result2->fetch_assoc()){
                        $query = "SELECT username,email FROM USERS WHERE id=?";
                        $statement = $conn->prepare($query);
                        $statement->bind_param("i",$row2['USER_ID']);
                        $statement->execute();
                        $resUser=$statement->get_result();
                        $statement->close();
                        $statement = null;
                        $user =$resUser->fetch_assoc();
                        if($user){
                        echo '
                    <h3 class="fs-5  mb-0 pb-0">From : ' . $user['email'] . '</h3>
                    <div class="mt-0 my-3">
                    <p class="my-2">' . $row2['REPLY'] . '</p>
                    </div>
                    ';
                        }
                    }
                    ?>
  </div><p class="text-end mt-3 me-3"><button class="btn btn-warning" onclick="goBack()">Go Back</button></p>
  </div>
  </div>
  <?php include "footer.php" ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
  <script>
             function goBack(){
        window.location.href = "profile.php";
      }
    document.addEventListener('DOMContentLoaded', function() {
      new WOW({
        resetOnScroll: true
      }).init();
    });
  </script>
</body>

</html>