<!DOCTYPE html>
<html lang="en">

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
  include "../Database/db.php";


$query = "SELECT c.id, c.name, c.price
FROM chocolates c
LEFT JOIN order_details od ON c.id = od.chocolate_id
GROUP BY c.id, c.name, c.price
ORDER BY COALESCE(SUM(od.quantity), 0) DESC LIMIT 4;
";
  $result = $conn->query($query);

  // Check if there are chocolates
  if ($result->num_rows > 0) {
    $chocolates = $result->fetch_all(MYSQLI_ASSOC);
  } else {
    $chocolates = array(); // Empty array if no chocolates
  }

  // Close the database connection
  $conn->close();
  ?>
      <!--Header -->
      <?php include "header.php" ?>
    <!--End Header -->
  <div class="container-fluid px-0 mx-0">


    <!-- Body-->
    <div class="container-fluid " id="body">
      <!--About-->
      <div class="container-xxl pb-5 pt-3">
        <div class="container">
          <div class="row  align-items-center">
            <div class="col-lg-6">
              <div class="row g-3">
                <div class="col-6 text-start">
                  <img class="img-fluid rounded w-100  wow fadeInDown" src="img/sq.jpg" alt="png">
                </div>
                <div class="col-6 text-start">
                  <img class="img-fluid rounded w-75  wow fadeInRight" src="img/sqp.jpg" alt="png" style="margin-top: 25%;">
                </div>
                <div class="col-6 text-end">
                  <img class="img-fluid rounded w-75  wow fadeInLeft" src="img/loza3.jpg" alt="png">
                </div>
                <div class="col-6 text-end">
                  <img class="img-fluid rounded w-100  wow fadeInUp" src="img/qqq2j.jpg" alt="png">
                </div>
              </div>
            </div>
            <div class="col-lg-6" id="about">
              <h5 class="section-title text-start italiana-regular text-bold wow fadeInDown">About Us</h5>
              <h1 class="mb-4 italiana-regular wow fadeInUp">Lo<span class="italianno-regular Z">Z</span>a
                Chocolatier</h1>
              <p class="mb-4 italiana-regular text-bold wow fadeInRight">Welcome to Loza Chocolatier! Based in Lebanon, we create exquisite, custom chocolates for your special events—engagements, weddings, and baby showers. Our passion is to add a touch of elegance and delight to your celebrations with our handcrafted creations.</p>
              <p class="mb-4 italiana-regular text-bold wow fadeInLeft">With worldwide shipping, we ensure that our artisanal chocolates can reach you no matter where you are. Celebrate with us and make your moments truly unforgettable!
              </p>
              <div class="row g-4 mb-4">
                <div class="col-sm-6">
                  <div class="d-flex align-items-center border-start border-5 border-warning px-3 wow rotateInUpLeft">
                    <h1 class="display-5 text-dark3 mb-0 italianno-regular text-bold" data-toggle="counter-up">6</h1>
                    <div class="ps-4">
                      <p class="mb-0  fs-5 text-bold italianno-regular">Years of</p>
                      <h6 class="mb-0 fs-4 text-bold italianno-regular">Experience</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End About-->
    <div class="d-flex p-0 m-0 justify-content-center">
      <hr class="w-75 p-0 m-0 h-100 wow slideInLeft">
    </div>
    <!-- Why us-->
    <div class="container-xxl py-5">
      <div class="container">
        <div class="text-center mx-auto mb-5" style="max-width: 630px;">
          <h1 class="mb-1 pb-0 italiana-regular text-bold fs-1 wow slideInUp">Why Us ?</h1>
          <p class="italianno-regular fs-2 wow slideInUp" data-wow-duration="1.5s">Experience the silky smoothness and rich taste that set our chocolates apart.</p>
        </div>
        <div class="row pb-5">
          <div class="col-lg-3 col-sm-6 mb-2 wow slideInDown">
            <a class="d-block bg-light text-center rounded p-3 text-decoration-none text-dark bg-light-beige">
              <div class="rounded p-4 border border-warning card-why bg-light-beige">
                <div class="mb-3">
                  <i class="fa-solid fa-star text-warning fs-2 icon"></i>
                </div>
                <h6>High Quality</h6>
                <span> Our chocolates are crafted with meticulous attention to detail, ensuring each piece delivers a consistently luxurious experience.</span>
              </div>
            </a>
          </div>
          <div class="col-lg-3 col-sm-6 mb-2  wow slideInUp">
            <a class="d-block bg-light text-center rounded p-3 text-decoration-none text-dark bg-light-beige">
              <div class="rounded p-4 border border-warning card-why bg-light-beige">
                <div class="mb-3">
                  <i class="fa-solid fa-wand-magic-sparkles text-warning fs-2 icon"></i>
                </div>
                <h6>Ingredients</h6>
                <span> We use premium, ethically sourced ingredients to ensure our chocolates deliver rich, authentic flavors and exceptional quality.</span>
              </div>
            </a>
          </div>
          <div class="col-lg-3 col-sm-6 mb-2  wow slideInDown">
            <a class="d-block bg-light text-center rounded p-3 text-decoration-none text-dark bg-light-beige">
              <div class="rounded p-4 border border-warning card-why bg-light-beige">
                <div class="mb-3">
                  <i class="fa-solid fa-eye text-warning fs-2 icon"></i>
                </div>
                <h6>Visual Appeal</h6>
                <span> Each creation is a masterpiece, designed not only to taste exceptional but also to captivate with its stunning presentation.</span>
              </div>
            </a>
          </div>
          <div class="col-lg-3 col-sm-6 mb-2  wow slideInUp">
            <a class="d-block bg-light text-center rounded p-3 text-decoration-none text-dark bg-light-beige">
              <div class="rounded p-4 border border-warning card-why bg-light-beige">
                <div class="mb-3">
                  <i class="fa-solid fa-child-reaching text-warning fs-2 icon"></i>
                </div>
                <h6>Customer's Choice</h6>
                <span> We offer personalized options to match your unique preferences and event themes, ensuring a custom experience that’s all about you.</span>
              </div>
            </a>
          </div>
        </div>
      </div>
      <div class="d-flex p-0 m-0 justify-content-center">
        <hr class="w-75 p-0 m-0 h-100 wow slideInRight">
      </div>
    </div>
    <!-- End Why us -->
    <!-- Feautured Items -->
    <div class="container-xxl py-5">
      <div class="container">
        <div class="text-center mx-auto" style="max-width: 650px;">
          <h1 class="pb-0 italiana-regular text-bold fs-1 wow slideInUp">Feautured Items</h1>
          <p class="italianno-regular fs-2 wow slideInUp" data-wow-duration="1.5s">Indulge in our standout creations, known for their smoothness and rich flavor.</p>
        </div>
        <div class="row">
        <?php
            foreach ($chocolates as $choc) : ?>
                <div class="col-lg-3 col-md-6 col-sm-12 col-12 wow fadeInUp">  <!--fixed error change this line -->
                    <div class="card w-100">
                        <img class="card-img-top" src="img/store/<?php echo $choc['name']; ?>.jpg" alt="Card image">
                        <div class="card-body">
                            <h6 class="card-title text-center italiana-regular text-bold text-nowrap"><?php echo $choc['name']; ?></h6>
                            <h3 class="card-text text-center text-bold italianno-regular"><?php echo $choc['price']; ?> $</h3>
                            <div class="d-grid">
                                <button href="#" class="btn btn-border italiana-regular btn-block text-bold" onclick="window.location.href='sproduct.php?chocID=<?php echo $choc['id'] ?>';">Add To Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
  <!--  End Feautured Items -->

  <!-- Footer -->
  <?php include "footer.php" ?>
  <!-- End Footer-->
  </div>
  <!-- End Body-->
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      new WOW({
        resetOnScroll: true
      }).init();
    });
  </script>
</body>

</html>