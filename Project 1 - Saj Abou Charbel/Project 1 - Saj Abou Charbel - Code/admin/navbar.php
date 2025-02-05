<?php if (!isset($_COOKIE['loginCredentials'])) {
    header("Location: ../");
} else {
    $credentialsJson = $_COOKIE['loginCredentials'];
    $loginCredentials = json_decode($credentialsJson, true);
} ?>
<nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
    <div class="d-flex align-items-center">
        <i class="fas fa-align-left ternary-text fs-4 me-3" id="menu-toggle"></i>
        <h2 class="fs-2 m-0 text-danger" id="page-title"></h2>
    </div>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse " id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown">
                <a class="nav-link  text-dark fw-bold ternary-text" href="#">
                    <span class="ternary-text"><i class="fas fa-user me-2"></i><?php echo $loginCredentials['username']
                                                                                ?></span>
                </a>
            </li>
        </ul>
    </div>
</nav>

<script>
    let pageTitle = document.getElementById("page-title");
    if (window.location.href.includes("index.php") || window.location.href.includes("")) {
        pageTitle.innerHTML = "Home";
    }
    if (window.location.href.includes("editItem.php") || window.location.href.includes("editItemForm.php")) {
        pageTitle.innerHTML = "Item Editing";
    }
    if (window.location.href.includes("addItem.php")) {
        pageTitle.innerHTML = "Item Addition";
    }
    if (window.location.href.includes("removeItem.php")) {
        pageTitle.innerHTML = "Item Deletion";
    }
    if (window.location.href.includes("stock.php")) {
        pageTitle.innerHTML = "Stock Management";
    }
</script>