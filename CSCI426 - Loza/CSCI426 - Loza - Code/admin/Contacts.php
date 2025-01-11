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
<?php include("sideBar.php"); ?>
    <div class="main position-absolute vh-100 bg-white">
        <?php include("topBar.php"); ?>		
			 <div class="row g-3 my-2 ms-1 me-3">
                <div class="col-md-4">
                    <div class="p-3 bg-light-brown shadow-sm d-flex justify-content-around align-items-center rounded">
                        <div>
                            <h3 class="fs-2" id="pendingMessages">
								<?php echo $pendingMessages; ?>
                            </h3>
                            <p class="fs-6">Pending Messages</p>
                        </div>
                        <i class="fa-solid fa-comment-dots fs-1 primary-text border rounded-pill bg-white p-3"></i>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 bg-light-brown shadow-sm d-flex justify-content-around align-items-center rounded">
                        <div>
                            <h3 class="fs-2" id="resolvedMessages">
                            <?php echo $resolvedMessages; ?>
                            </h3>
                            <p class="fs-6">Resolved Messages</p>
                        </div>
                        <i class="fa-solid fa-comments fs-1 primary-text border rounded-pill bg-white p-3"></i>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 bg-light-brown shadow-sm d-flex justify-content-around align-items-center rounded">
                        <div>
                            <h3 class="fs-2" id="rejectedMessages">
                            <?php echo $rejectedMessages; ?>
                            </h3>
                            <p class="fs-6">Rejected Messages</p>
                        </div>
                        <i class="fa-solid fa-comment-slash fs-1 primary-text border rounded-pill bg-white p-3"></i>
                    </div>
                </div>
        </div>
		<div class="table me-5">
					<div class="mb-0 me-3">
						<h4 class="bg-light-brown text-white ms-2">&nbsp; Messages </h4>
					</div>
					<div class="table-responsive ms-2 me-3">
					<table class="table-css">
						<thead>
							<tr>
								<th>
									<p>#</p>
								</th>

								<th>
									<p>Full Name</p>
								</th>
								<th>
									<p>Email</p>
								</th>
								<th>
									<p>Subject</p>
								</th>
								<th>
									<p>Message</p>
								</th>
								<th>
									<p>Action</p>
								</th>
								
							</tr>
						</thead>
						<tbody id="messageTable">
											
						</tbody>
					</table>
					</div>
				</div>
		 </div>

    <script src="index.js"></script>
    <script src="jquery-3.1.1.js" type="text/javascript"></script>
    <script>
$(document).ready(function() {
			LoadMessages();

			$(document).on('click', '.setDone', function() {
				$id = $(this).val();

				$.ajax({
					type: "POST",
					url: "resolve.php",
					data: {
						id: $id,
						setDone: 1,
					},
					success: function() {
						alert("Selected Message Resolved !");
						let pendingMessagesElement = document.getElementById("pendingMessages");
						pendingMessagesElement.innerHTML =  parseInt(pendingMessagesElement.innerHTML) - 1;
						let resolvedMessagesElement = document.getElementById("resolvedMessages");
						resolvedMessagesElement.innerHTML = parseInt(resolvedMessagesElement.innerHTML) + 1;
						LoadMessages();
					}
				});
			});

			$(document).on('click', '.cancel', function() {
				$id = $(this).val();

				$.ajax({
					type: "POST",
					url: "reject.php",
					data: {
						id: $id,
						cancel: 1,
					},
					success: function() {
						alert("Selected Message Rejected !");
						let pendingMessagesElement = document.getElementById("pendingMessages");
						pendingMessagesElement.innerHTML = parseInt(pendingMessagesElement.innerHTML) - 1;
						let rejectedMessagesElement = document.getElementById("rejectedMessages");
						rejectedMessagesElement.innerHTML = parseInt(rejectedMessagesElement.innerHTML) + 1;
						LoadMessages();
					}
				});
			});
		});


		function LoadMessages() {
			$.ajax({
				url: 'loadMessages.php',
				type: 'POST',
				async: false,
				success: function(response) {
					$('#messageTable').html(response);
				}
			});
		}
	</script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>