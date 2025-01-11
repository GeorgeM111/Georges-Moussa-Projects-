<?php
include "../Database/db.php";
$messageId = $_GET['messageId'];
$fullName = $_GET['fullName'];
$email = $_GET['email'];
$action = $_GET['action'];
$sql = "SELECT * FROM CONTEXT,MESSAGES WHERE MESSAGE_ID= ? AND MESSAGES.ID = MESSAGE_ID";
$stmt= $conn->prepare($sql);
$stmt->bind_param("i",$messageId);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

$sql2 = "SELECT * FROM REPLIES,MESSAGES WHERE MESSAGE_ID= ? AND MESSAGES.ID = MESSAGE_ID";
$stmt2= $conn->prepare($sql2);
$stmt2->bind_param("i",$messageId);
$stmt2->execute();
$result2 = $stmt2->get_result();
$stmt2->close();
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
</head>

<body>
    <?php
    if ($result->num_rows > 0) {
    ?>

        <?php include("sideBar.php"); ?>
        <div class="main position-absolute vh-100 bg-white">
            <?php include("topBar.php"); ?>
            <div class="container-fluid px-4 pb-5">
                <div class="mb-0 me-3 ms-3">
                </div>
                <div class="border border-3 border-light-brown py-3 px-3 mt-2">
                    <h3 class="text-center h4-light-brown text-capitalize">Message From <?php echo $fullName; ?> </h3>
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

                    <div class="row">
                        <?php
                        $buttonHtml;
                        $buttonClass;
                        $buttonDisabled;
                        if ($action === "Pending") {
                            $buttonHtml = "Reply";
                            $buttonClass = "seeMore";
                            $buttonDisabled = "";
                        }
                        if ($action === "Resolved") {
                            $buttonHtml = "Resolved";
                            $buttonClass = "resolved text-white";
                            $buttonDisabled = "disabled";
                        }
                        if ($action === "Rejected") {
                            $buttonHtml = "Rejected";
                            $buttonClass = "resolved text-white";
                            $buttonDisabled = "disabled";
                        }
                        ?>
                        <div class="col">
                            <button type="button" <?php echo $buttonDisabled ?> onclick="showReply()" class="btn <?php echo $buttonClass; ?>">
                                <?php echo $buttonHtml ?>
                            </button>
                        </div>

                        <div class=" col d-flex justify-content-end">
                            <button class="btn seeMore ms-3" type="button" onclick="goBack()">Go Back</button>
                        </div>
                    </div>
                    <div class="row mx-3 mt-3" id="replyBox" style="display:none">
                        <form action="reply.php" method="post">
                            <textarea name="reply" class="w-100 pb-5 text-start"></textarea>
                            <input type="hidden" value="<?php echo $messageId ?>"  name="MID">
                            <input type="hidden" value="<?php echo $fullName ?>"  name="FN">
                            <input type="hidden" value="<?php echo $email ?>"  name="EM">
                            <input type="hidden" value="<?php echo $action ?>"  name="AC">
                            <button type="submit" class="btn setDone">Reply</button>
                        </form>
                    </div>
                </div>

            </div>

        <?php
    }
        ?>
        </div>

        <script>
            function goBack() {
                window.location.href="Contacts.php";
            }
            let hidden = true;

            function showReply() {
                let replyBox = document.getElementById("replyBox");
                if (hidden) {
                    replyBox.style.display = "block";
                    hidden = false;
                } else {
                    replyBox.style.display = "none";
                    hidden = true;
                }
            }
        </script>
        <script src="index.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>