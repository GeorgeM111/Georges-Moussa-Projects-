   <?php include "functions.php" ?>
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4 px-lg-5 py-3 py-lg-0 pb-lg-3 pt-lg-3 sticky-top wow fadeInDown">
       <a href="home.php" class="navbar-brand p-0 wow fadeInLeft" data-wow-delay="0.5s">
           <h3 class="pacifico fs-3 logo-brand"><i class="fa fa-utensils me-3"></i>Daddy's Restaurant</h3>
       </a>
       <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
           <span class="fa fa-bars"></span>
       </button>

       <div class="collapse navbar-collapse" id="navbarCollapse">
           <div class="navbar-nav ms-auto py-0 pe-4">
               <a href="home.php" class="nav-item nav-link">Home</a>
               <a href="home.php#about" class="nav-item nav-link">About</a>
               <a href="menu.php" class="nav-item nav-link">Menu</a>
               <a href="cart.php" class="nav-item nav-link">View Cart</a>
               <a href="#footer" class="nav-item nav-link">Contact</a>
               <?php if (isset($_SESSION['loginCredentials'])) {
                    if (isset($_SESSION['loginCredentials']['name'])) { ?>
                       <div class="collapse navbar-collapse d-inline" id="navbarSupportedContent">
                           <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                               <li class="nav-item dropdown">
                                   <a class="nav-link dropdown-toggle second-text fw-bold ternary-text" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                       <span class="ternary-text"><i class="fas fa-user me-2"></i><?php echo $_SESSION['loginCredentials']['name'] ?></span>
                                   </a>
                                   <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                       <li><a class="dropdown-item text-bold" href="profile.php">Profile</a></li>
                                       <li><a class="dropdown-item text-bold" href="orders.php">Orders</a></li>
                                       <li><a class="dropdown-item text-danger text-bold" href="logout.php">Logout</a></li>
                                   </ul>
                               </li>
                           </ul>
                       </div>
                   <?php } else { ?>
                       <a href="login.php" class="nav-item nav-link text-bold" id="login-link">Login</a>
                   <?php }
                } else { ?>
                   <a href="login.php" class="nav-item nav-link text-bold" id="login-link">Login</a>
               <?php } ?>
           </div>
       </div>
   </nav>
   <style>
       @media (max-width: 338px) {
           .logo-brand {
               font-size: 100% !important;
           }
       }

       @media (max-width: 310px) {
           .logo-brand {
               font-size: 90% !important;
           }
       }

       @media (max-width: 293px) {
           .logo-brand {
               font-size: 80% !important;
           }
       }

       @media (max-width: 274px) {
           .logo-brand {
               font-size: 70% !important;
           }
       }

       @media (max-width: 255px) {
           .logo-brand {
               font-size: 60% !important;
           }
       }
   </style>