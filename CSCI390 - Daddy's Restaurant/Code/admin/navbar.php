<?php require "../backend/config_session.php"; ?>
<?php if (!isset($_SESSION['adminLoginCredentials'])) {
    header("Location: ../customer/");
} ?>
<nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
    <div class="d-flex align-items-center">
        <i class="fas fa-align-left ternary-text fs-4 me-3" id="menu-toggle"></i>
        <h2 class="fs-2 m-0 text-primary" id="page-title"></h2>
    </div>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse " id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle second-text fw-bold ternary-text" href="#" id="navbarDropdown"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="ternary-text"><i class="fas fa-user me-2"></i><?php echo $_SESSION['adminLoginCredentials']['username'] ?></span>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<script>
    let pageTitle = document.getElementById("page-title");
    if (window.location.href.includes("index.php")) {
        pageTitle.innerHTML = "Dashboard";
    }
    if (window.location.href.includes("ordersManagement.php")) {
        pageTitle.innerHTML = "Orders Management";
    }
    if (window.location.href.includes("RestaurantManagement.php")) {
        pageTitle.innerHTML = "Restaurant Management";
    }
    if (window.location.href.includes("menuManagement.php")) {
        pageTitle.innerHTML = "Menu Management";
    }
    if (window.location.href.includes("items.php")) {
        pageTitle.innerHTML = "Items Management";
    }
    if (window.location.href.includes("adminManagement.php")) {
        pageTitle.innerHTML = "Admins Management";
    }
    if (window.location.href.includes("userManagement.php")) {
        pageTitle.innerHTML = "User Management & Control";
    }
    if (window.location.href.includes("profile.php")) {
        pageTitle.innerHTML = "Profile Management";
    }
    if (window.location.href.includes("orderDetails.php")) {
        pageTitle.innerHTML = "Order Details";
    }
    if (window.location.href.includes("editItem.php")) {
        pageTitle.innerHTML = "Edit Item";
    }
    if (window.location.href.includes("editCategory.php")) {
        pageTitle.innerHTML = "Edit Category";
    }
    if (window.location.href.includes("editIngredient.php")) {
        pageTitle.innerHTML = "Edit Ingredient";
    }
</script>