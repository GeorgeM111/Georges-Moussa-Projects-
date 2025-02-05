<div class="bg-white border-right border-right-3" id="sidebar-wrapper">
    <div class="sidebar-heading text-center py-4  border-bottom" id="Logo">
        <h6 class="text-uppercase"><i class="fa fa-utensils me-3"></i>Daddy's Restaurant</h4>
    </div>
    <div class="list-group list-group-flush my-3" id="sideBar">
        <a id="home-link" href="index.php" class="list-group-item list-group-item-action bg-transparent second-text"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
        <a id="orders-link" href="ordersManagement.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-shopping-cart me-2"></i>Order</a>
        <a id="resmanagement-link" href="RestaurantManagement.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-chart-line me-2"></i>Restaurant</a>
        <a id="menmanagement-link" href="menuManagement.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa-solid fa-table-list me-2"></i>Menu</a>
        <a id="items-link" href="items.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-gift me-2"></i>Items</a>
        <a id="admins-link" href="adminManagement.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa-solid fa-user-tie me-2"></i>Admins</a>
        <a id="usmanagement-link" href="userManagement.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa-regular fa-user me-2"></i>Users</a>
        <a href="../customer/logout.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i class="fas fa-power-off me-2"></i>Logout</a>
    </div>
</div>

<script>
    if (window.location.href.includes("index.php")) {
        document.getElementById("home-link").classList.add("active");
    }
    if (window.location.href.includes("ordersManagement.php")) {
        document.getElementById("orders-link").classList.add("active");
    }
    if (window.location.href.includes("RestaurantManagement.php")) {
        document.getElementById("resmanagement-link").classList.add("active");
    }
    if (window.location.href.includes("menuManagement.php")) {
        document.getElementById("menmanagement-link").classList.add("active");
    }
    if (window.location.href.includes("items.php")) {
        document.getElementById("items-link").classList.add("active");
    }
    if (window.location.href.includes("adminManagement.php")) {
        document.getElementById("admins-link").classList.add("active");
    }
    if (window.location.href.includes("userManagement.php")) {
        document.getElementById("usmanagement-link").classList.add("active");
    }
</script>