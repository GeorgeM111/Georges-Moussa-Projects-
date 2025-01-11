<?php session_start();
define('LOZA', true);
 ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5  py-lg-0 pb-lg-3 pt-lg-3 sticky-top italiana-regular  wow slideInDown">
  <div class="d-flex flex-row justify-content-between p-0 m-0 w-100">
    <div class="d-flex p-0 m-0 logo">
      <img src="img/chocolate.png" class="img-fluid flex-shrink-0 w-25 chocImg" alt="chocolate">
      <a href="" class="navbar-brand p-0 me-5">
        <h2 class="italiana-regular p-0 m-0">Lo<span class="italianno-regular Z">Z</span>a
          Chocolatier</h2>
      </a>
    </div>
<div class="m-0 align-self-center">
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
      </button>
</div>
  </div>
  <div class="collapse navbar-collapse w-100 text-nowrap" id="navbarCollapse">  
    <!-- Error Fixed added those classes  w-100 text-nowrap -->
    <div class="navbar-nav ms-auto py-0 pe-4">
      <a href="home.php" class="nav-item nav-link text-bold" id="home-link">Home</a>
      <a href="home.php#about" class="nav-item nav-link text-bold">About</a>
      <a href="shop.php" class="nav-item nav-link text-bold" id="shop-link">Shop Now</a>
      <a href="cart.php" class="nav-item nav-link text-bold" id="cart-link">View Cart</a>
      <?php if (isset($_SESSION['loginCredentials'])) {
    if (isset($_SESSION['loginCredentials']['Name'])) { ?>
         <div class="collapse navbar-collapse d-inline" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle second-text fw-bold ternary-text"  id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="ternary-text"><i class="fas fa-user me-2"></i><?php echo $_SESSION['loginCredentials']['Name'] ?></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item text-bold" href="profile.php">Profile</a></li>
                        <li><a class="dropdown-item text-bold" href="orders.php">Orders</a></li>
                        <li>
                            <form action="logout.php" method="post">
                                <button type="submit" class="text-danger dropdown-item">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    <?php } else { ?>
        <a href="login.php" class="nav-item nav-link text-bold" id="login-link">Login</a>
    <?php }
} else { ?>
  <a href="login.php" class="nav-item nav-link text-bold" id="login-link">Login</a>
<?php }?>

    </div>
  </div>
</nav>

<script>
  if (window.location.href.includes("home.php")) {
    document.getElementById("home-link").classList.add("active");
  }
  if (window.location.href.includes("shop.php")) {
    document.getElementById("shop-link").classList.add("active");
  }
  if (window.location.href.includes("cart.php")) {
    document.getElementById("cart-link").classList.add("active");
  }
  if (window.location.href.includes("login.php")) {
    document.getElementById("login-link").classList.add("active");
  }
</script>