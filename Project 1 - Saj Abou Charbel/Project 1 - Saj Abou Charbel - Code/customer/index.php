<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <title>Saj Abou Charbel</title>
    <link href="img/logo.png" rel="icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php include "navbar.php";
    include "../database/database.php";
    include "functions.php"; ?>
    <div class="container-fluid about py-1">
        <div class="d-flex align-items-center justify-content-center mt-2">
            <select name="options" id="select" class="form-control" style="width:50%;" onchange="changeCategory()">
                <?php printCategories($connection); ?>
            </select>
        </div>

        <div class="mt-3">
            <?php printItems($connection);
            $connection->close(); ?>

        </div>
    </div>
    <?php include "footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script>
        function changeCategory() {
            let categories = document.getElementsByTagName("section");
            let selectedCategory = document.getElementById("select");
            for (let x of categories) {
                x.style.display = "none";
            }
            document.getElementById(selectedCategory.value).style.display = "block";
        }
    </script>

</body>

</html>