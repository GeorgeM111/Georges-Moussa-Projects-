<!DOCTYPE html>
<html lang="en">
<?php require_once "../backend/config_session.php"; ?>

<head>
    <meta charset="utf-8">
    <title>Daddy's Restaurant</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <link href="images/logo.jpg" rel="icon">
    <meta content="" name="description">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php include("navBar.php");
    if (!isset($_SESSION['loginCredentials'])) {
        header("Location: home.php");
    }

    ?>

    <div class="container-fluid">
        <div class="mx-auto d-block">
            <h1 class="pacifico text-center mt-3">Profile</h1>
        </div>
        <div class="container">
            <div class="row mt-3">
                <div class="col-12 col-sm-12 col-md-4 mb-3">
                    <div class="border border-1 border-dark p-3">
                        <h3 class=" text-center"><span class="border-bottom border-dark">Edit Email</span></h3>
                        <form onsubmit="return updateEmail()">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter email" value="<?php echo $_SESSION['loginCredentials']['email'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="emailPassword">Password:</label>
                                <input type="password" class="form-control" id="emailPassword" placeholder="Enter password">
                            </div>
                            <br>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-block btn-warning">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4 mb-3">
                    <div class="border border-1 border-dark p-3">
                        <h3 class=" text-center"><span class="border-bottom border-dark">Edit Phone Number</span></h3>
                        <form onsubmit="return updatePhone()">
                            <div class="form-group">
                                <label for="phone">Phone Number:</label>
                                <input type="tel" placeholder="Format : 00 000 000" class="form-control" id="phone" name="phoneNumber" pattern="\d{2} \d{3} \d{3}" required value="<?php echo $_SESSION['loginCredentials']['phoneNumber'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="phonePassword">Password:</label>
                                <input type="password" class="form-control" id="phonePassword" placeholder="Enter password">
                            </div>
                            <br>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-block btn-warning">Submit</button>
                            </div>
                        </form>


                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4 mb-3">
                    <div class="border border-1 border-dark p-3">
                        <h3 class=" text-center"><span class="border-bottom border-dark">Edit Address</span></h3>
                        <form onsubmit="return updateAddress()">
                            <div class="form-group">
                                <label for="address">Address:</label>
                                <input type="text" class="form-control" id="address" placeholder="Enter address" value="<?php if (isset($_SESSION['loginCredentials']['address'])) {
                                                                                                                            echo  $_SESSION['loginCredentials']['address'];
                                                                                                                        } ?>">
                            </div>
                            <div class="form-group">
                                <label for="addressPassword">Password:</label>
                                <input type="password" class="form-control" id="addressPassword" placeholder="Enter password">
                            </div>
                            <br>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-block btn-warning">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4 mb-3">
                    <div class="border border-1 border-dark p-3">
                        <h3 class=" text-center"><span class="border-bottom border-dark">Change Password</span></h3>
                        <form onsubmit="return changePassword()">
                            <div class="form-group">
                                <label for="oldPassword">Old Password:</label>
                                <input type="password" class="form-control" id="oldPassword" placeholder="Enter your old password">
                            </div>
                            <div class="form-group">
                                <label for="newPassword">New Password:</label>
                                <input type="password" class="form-control" id="newPassword" placeholder="Enter a new password">
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword">Confirm Password:</label>
                                <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm new password">
                            </div>
                            <br>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-block btn-warning">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-4 mb-3">
                    <div class="border border-1 border-dark p-3">
                        <h3 class=" text-center"><span class="border-bottom border-dark">Delete Account</span></h3>
                        <form onsubmit="return deleteProfile()">
                            <div class="form-group mb-2">
                                <label for="deletePassword">Password:</label>
                                <input type="password" class="form-control" id="deletePassword" placeholder="Enter your  password" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="cDeletePassword">Confirm Password:</label>
                                <input type="password" class="form-control" id="cDeletePassword" placeholder="Re-enter your  password" required>
                            </div>
                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input" id="deleteBox" required>
                                <label for="deleteBox" class="form-check-label pb-1">I understand that this action will result in my account deletion</label>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-block btn-danger">Delete Account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("footer.php") ?>
    <script src="javascript/jquery-3.1.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateEmail() {
            const userConfirmed = window.confirm("Are you sure you want to change your email?");

            if (userConfirmed) {
                let email = document.getElementById("email").value;
                let emailPassword = document.getElementById("emailPassword").value;
                $.ajax({
                    type: 'POST',
                    url: 'updateProfile.php',
                    data: {
                        email: email,
                        emailPassword: emailPassword,
                    },
                    success: function(response) {
                        console.log('Server response:', response);
                        try {
                            let jsonResponse = JSON.parse(response.trim());
                            if (jsonResponse.success) {
                                alert('Email Updated Successfully');
                                window.location = 'profile.php';
                            } else {
                                alert('Operation Failed: ' + jsonResponse.error);
                                window.location = 'profile.php';
                            }
                        } catch (e) {
                            console.error('JSON parsing error:', e);
                            alert('Failed To Update Email! Error: Invalid JSON response');
                        }
                    },
                    error: function(error) {
                        console.error('Error Updating Email:', error);
                    }
                });
                return false;
            } else {
                alert("Operation Cancelled.");
            }
        }

        function updatePhone() {
            const userConfirmed = window.confirm("Are you sure you want to change your phone number?");

            if (userConfirmed) {
                let phone = document.getElementById("phone").value;
                let phonePassword = document.getElementById("phonePassword").value;
                event.preventDefault();
                $.ajax({

                    type: 'POST',
                    url: 'updateProfile.php',
                    data: {
                        phone: phone,
                        phonePassword: phonePassword,
                    },
                    success: function(response) {
                        console.log('Server response:', response);
                        try {
                            let jsonResponse = JSON.parse(response.trim());
                            if (jsonResponse.success) {
                                alert('Phone Number Updated Successfully');
                                window.location = 'profile.php';
                            } else {
                                alert('Failed To Update Phone Number! Error: ' + jsonResponse.error);
                                window.location = 'profile.php';
                            }
                        } catch (e) {
                            console.error('JSON parsing error:', e);
                            alert('Failed To Update Phone Number! Error: Invalid JSON response');
                        }
                    },
                    error: function(error) {
                        console.error('Error Updating Phone Number:', error);
                    }
                });
                return false;
            } else {
                alert("Operation Cancelled.");
            }
        }

        function updateAddress() {
            const userConfirmed = window.confirm("Are you sure you want to change your address?");
            if (userConfirmed) {
                let address = document.getElementById("address").value;
                let addressPassword = document.getElementById("addressPassword").value;

                $.ajax({
                    type: 'POST',
                    url: 'updateProfile.php',
                    data: {
                        address: address,
                        addressPassword: addressPassword,
                    },
                    success: function(response) {
                        console.log('Server response:', response);
                        try {
                            let jsonResponse = JSON.parse(response.trim());
                            if (jsonResponse.success) {
                                alert('Address Updated Successfully');
                                window.location = 'profile.php';
                            } else {
                                alert('Operation Failed: ' + jsonResponse.error);
                                window.location = 'profile.php';
                            }
                        } catch (e) {
                            console.error('JSON parsing error:', e);
                            alert('Failed To Update Address! Error: Invalid JSON response');
                        }
                    },
                    error: function(error) {
                        console.error('Error Updating Address:', error);
                    }
                });
                return false;
            } else {
                alert("Operation Cancelled.");
            }
        }

        function changePassword() {
            const userConfirmed = window.confirm("Are you sure you want to change your password?");

            if (userConfirmed) {
                let oldPassword = document.getElementById("oldPassword").value;
                let newPassword = document.getElementById("newPassword").value;
                let confirmPassword = document.getElementById("confirmPassword").value;
                event.preventDefault();
                $.ajax({

                    type: 'POST',
                    url: 'updateProfile.php',
                    data: {
                        oldPassword: oldPassword,
                        newPassword: newPassword,
                        confirmPassword: confirmPassword,
                    },
                    success: function(response) {
                        console.log('Server response:', response);
                        try {
                            let jsonResponse = JSON.parse(response.trim());
                            if (jsonResponse.success) {
                                alert('Password Changed Successfully');
                                window.location = 'profile.php';
                            } else {
                                alert('Failed To Change Password! Error: ' + jsonResponse.error);
                                window.location = 'profile.php';
                            }
                        } catch (e) {
                            console.error('JSON parsing error:', e);
                            alert('Failed To Change Password! Error: Invalid JSON response');
                        }
                    },
                    error: function(error) {
                        console.error('Error Changing Password:', error);
                    }
                });
                return false;
            } else {
                alert("Operation Cancelled.");
            }
        }

        function deleteProfile() {
            const userConfirmed = window.confirm("Are you sure you want to delete your profile?");

            if (userConfirmed) {
                let deletePassword = document.getElementById("deletePassword").value;
                let cDeletePassword = document.getElementById("cDeletePassword").value;
                let understand = document.getElementById("deleteBox").checked ? "on" : "off";
                $.ajax({
                    type: 'POST',
                    url: 'deleteProfile.php',
                    data: {
                        understand: understand,
                        deletePassword: deletePassword,
                        cDeletePassword: cDeletePassword,
                    },
                    success: function(response) {
                        console.log('Server response:', response);
                        try {
                            let jsonResponse = JSON.parse(response.trim());
                            if (jsonResponse.success) {
                                alert('Account Deleted Successfully');
                                window.location = 'home.php';
                            } else {
                                alert('Operation Failed: ' + jsonResponse.error);
                                window.location = 'profile.php';
                            }
                        } catch (e) {
                            console.error('JSON parsing error:', e);
                            alert('Failed To Delete Account! Error: Invalid JSON response');
                            window.location = 'profile.php';
                        }
                    },
                    error: function(error) {
                        console.error('Error Deleting Account:', error);
                    }
                });
                return false;
            } else {
                alert("Profile Deletion Cancelled.");
            }
        }
    </script>
</body>

</html>