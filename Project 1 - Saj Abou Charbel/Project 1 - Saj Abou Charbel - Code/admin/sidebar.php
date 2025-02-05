<div class="bg-white border-right border-right-3" id="sidebar-wrapper">
    <div class="sidebar-heading text-center py-4  border-bottom" id="Logo">
        <h6 class="text-uppercase"><i class="fa fa-utensils me-3"></i>Saj Abou Charbel</h4>
    </div>
    <div class="list-group list-group-flush my-3" id="sideBar">
        <a id="home-link" href="index.php" class="list-group-item list-group-item-action bg-transparent second-text"><i class="fas fa-tachometer-alt me-2"></i>Home</a>
        <a id="add-link" href="addItem.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-shopping-cart me-2"></i>Add Items</a>
        <a id="edit-link" href="editItem.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-table-list me-2"></i>Edit Items</a>
        <a id="remove-link" href="removeItem.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fa-solid fa-trash me-2"></i>Remove Items</a>
        <a id="stock-link" href="stock.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-chart-line me-2"></i>Stock</a>
        <a href="logout.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i class="fas fa-power-off me-2"></i>Logout</a>
    </div>
</div>

<script>
    if (window.location.href.includes("index.php")) {
        document.getElementById("home-link").classList.add("active");
    }
    if (window.location.href.includes("addItem.php")) {
        document.getElementById("add-link").classList.add("active");
    }
    if (window.location.href.includes("editItem.php") || window.location.href.includes("editItemForm.php")) {
        document.getElementById("edit-link").classList.add("active");
    }
    if (window.location.href.includes("stock.php")) {
        document.getElementById("stock-link").classList.add("active");
    }
    if (window.location.href.includes("removeItem.php")) {
        document.getElementById("remove-link").classList.add("active");
    }
</script>