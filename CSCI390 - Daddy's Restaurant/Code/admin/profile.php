<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="css/style.css">
    <title>Edit Profile</title>
    <style>
        .custom-select {
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
        }

        .custom-select:focus {
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <?php include "navbar.php";

    $admin_id = $_SESSION['adminLoginCredentials']['username'];

    require_once("../database/db.php");

    $stmt = $conn->prepare("SELECT * FROM admin WHERE USERNAME = ?");
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();
    $stmt->close();
    ?>
    <div class="d-flex" id="wrapper">
        <?php include "sidebar.php"; ?>
        <div id="page-content-wrapper">
            <div class="container-fluid px-4 border-top border-dark border-top-3">
                <div class="container my-5">
                    <h2>Edit Profile</h2>
                    <form id="admin-form">
                        <div class="form-group mb-3">
                            <label for="username" class="form-label">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" value="<?php echo htmlspecialchars($admin['USERNAME']); ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="<?php echo htmlspecialchars($admin['EMAIL_ADDRESS']); ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone" class="form-label">Phone Number:</label>
                            <input type="tel" name="phone" id="phone" class="form-control" placeholder="00 000 000" pattern="\d{2} \d{3} \d{3}" value="<?php echo htmlspecialchars($admin['PHONE_NUMBER']); ?>" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="npassword" class="form-label">New Password:</label>
                            <input type="password" class="form-control" id="npassword" name="npassword" placeholder="Enter new password">
                        </div>
                        <div class="form-group mb-3">
                            <label for="cpassword" class="form-label">Confirm Password:</label>
                            <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Enter new password">
                        </div>
                        <div class="form-group mb-3">
                            <label for="opassword" class="form-label">Old Password:</label>
                            <input type="password" class="form-control" id="opassword" name="opassword" placeholder="Enter new password" required>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                    <div id="response-message" class="mt-3"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function() {
            el.classList.toggle("toggled");
        };
        $(document).ready(function() {
            $("#admin-form").submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    url: "update_admin.php",
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        $("#response-message").html('<div class="alert alert-success">' + response + '</div>');
                    },
                    error: function(xhr, status, error) {
                        $("#response-message").html('<div class="alert alert-danger">Error: ' + xhr.responseText + '</div>');
                    }
                });
            });
        });
    </script>
</body>

</html>