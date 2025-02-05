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
  <link href="css/animate.css" rel="stylesheet">
</head>

<body>
  <div>
  <?php include("navBar.php"); ?>
  <div class="container-fluid p-0 mx-sm-0">
    <div class="container-xxl py-5">
      <div class="container">
        <div class="row g-5 align-items-center">
          <div class="col-lg-3 wow slideInRight">
          <div class="row g-3">
              <div class="col-6 col-sm-6 col-md-12 text-end">
                <img class="img-fluid rounded w-100" src="images/itemsImg/sweetpizzaL.jpeg">
              </div>
              <div class="col-6 col-sm-6 col-md-12 text-end">
                <img class="img-fluid rounded w-100" src="images/itemsImg/kaniSalad.jpeg">
              </div>
            </div>
          </div>
          <?php printAbout($conn, 1); ?>
          <div class="col-lg-3 wow slideInLeft">
            <div class="row g-3">
              <div class="col-6 col-sm-6 col-md-12 text-start">
                <img class="img-fluid rounded w-100" src="images/itemsImg/avocadoCocktail.jpg">
              </div>
              <div class="col-6 col-sm-6 col-md-12 text-start">
                <img class="img-fluid rounded w-100" src="images/itemsImg/cheeseGarlicBread.jpeg">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid mb-3">
    <div class="row" id="itemCarouselDiv">
      <div class="col-12 col-sm-6 pt-5 wow fadeInLeft" id="feautredCarousel">
        <h2 class="text-center pacifico wow fadeInDown" data-wow-delay="0.5s">Feautured Items</h2>
        <?php printFeauturedItems($conn) ?>
      </div>
      <div class="col-sm-6 col-12 pt-5 wow fadeInRight" id="recommendedCarousel">
        <h2 class="text-center pacifico wow fadeInDown" data-wow-delay="0.5s">Recommended Items</h2>
        <?php printRecommendedItems($conn) ?>
      </div>
    </div>
  </div>
  </div>

  <?php include("footer.php") ?>
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