<?php session_start();
if (!isset($_SESSION['adminLoginCredentials'])) {
    header("Location: ../");
}
define('LOZA', true);
?>
<div class="container-fluid px-0 my-0 sideBar">
    <div class="navigation position-fixed h-100 overflow-auto">
        <ul class="position-absolute top-0 start-0 w-100 list-group">
            <li class="w-100  position-relative">
                <a href="#" class="w-100 d-flex text-decoration-none position-relative text-white">
                    <span class="icon position-relative d-flex text-center">
                        <img src="chocolate.png" alt="choco" class="flex-shrink-0 img-fluid w-75 h-75 my-2 mx-2">
                    </span>
                    <span class="title">Loza Chocolatier</span>
                </a>
            </li>
            <li class="w-100 position-relative">
                <a href="index.php" class="w-100 d-flex text-decoration-none position-relative text-white">
                    <span class="icon position-relative d-block text-center">
                        <ion-icon name="home-outline"></ion-icon>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>

            <li class="w-100 position-relative">
                <a href=".ordersCollapse" class="w-100 d-flex text-decoration-none position-relative text-white" data-bs-toggle="collapse" aria-expanded="false" aria-controls="ordersCollapse">
                    <span class="icon position-relative d-block text-center">
                        <ion-icon name="cart-outline"></ion-icon>
                    </span>
                    <span class="title">Orders</span>
                </a>
            </li>

            <li class="w-100 position-relative ordersCollapse collapse ms-3 list-unstyled">
                <a href="pendingOrders.php" class="w-100 d-flex text-decoration-none position-relative text-white">
                    <span class="icon position-relative d-block text-center">
                        <ion-icon name="alarm-outline"></ion-icon>
                    </span>
                    <span class="title">New Orders</span>
                </a>
            </li>

            <li class="w-100 position-relative ordersCollapse collapse ms-3 list-unstyled">
                <a href="doneOrders.php" class="w-100 d-flex text-decoration-none position-relative text-white">
                    <span class="icon position-relative d-block text-center">
                        <ion-icon name="checkmark-circle-outline"></ion-icon>
                    </span>
                    <span class="title">Done Orders</span>
                </a>
            </li>

            <li class="w-100 position-relative ordersCollapse collapse ms-3 list-unstyled">
                <a href="deniedOrders.php" class="w-100 d-flex text-decoration-none position-relative text-white">
                    <span class="icon position-relative d-block text-center">
                        <ion-icon name="close-circle-outline"></ion-icon>
                    </span>
                    <span class="title">Denied Orders</span>
                </a>
            </li>

            <li class="w-100 position-relative">
                <a href="chocolates.php" class="w-100 d-flex text-decoration-none position-relative text-white">
                    <span class="icon position-relative d-block text-center">
                        <ion-icon name="pricetags-outline"></ion-icon>
                    </span>
                    <span class="title">Chocolates</span>
                </a>
            </li>
            <li class="w-100 position-relative">
                <a href="customers.php" class="w-100 d-flex text-decoration-none position-relative text-white">
                    <span class="icon position-relative d-block text-center">
                        <ion-icon name="people-outline"></ion-icon>
                    </span>
                    <span class="title">Customers</span>
                </a>
            </li>

            <li class="w-100 position-relative">
                <a href="Contacts.php" class="w-100 d-flex text-decoration-none position-relative text-white">
                    <span class="icon position-relative d-block text-center">
                        <ion-icon name="mail-unread-outline"></ion-icon>
                    </span>
                    <span class="title">Messages</span>
                </a>
            </li>

            <li class="w-100 position-relative">
                <a href="Profile.php" class="w-100 d-flex text-decoration-none position-relative text-white">
                    <span class="icon position-relative d-block text-center">
                        <ion-icon name="person-outline"></ion-icon>
                    </span>
                    <span class="title">Profile</span>
                </a>
            </li>

            <li class="w-100 position-relative">
                <a href="adminAuthentication.php" class="w-100 d-flex text-decoration-none position-relative text-white">
                    <span class="icon position-relative d-block text-center">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                    </span>
                    <span class="title">Admin Authentication</span>
                </a>
            </li>

            <li class="w-100 position-relative">
                <a href="#" class="w-100 d-flex text-decoration-none position-relative text-white">
                    <span class="icon position-relative d-block text-center">
                        <ion-icon name="log-out-outline"></ion-icon>
                    </span>

                    <form action="logout.php" method="post">
                        <button type="submit" class="btn logoutBtn p-0 text-white m-0"><span class="title">Sign Out</span></button>
                    </form>
                </a>
            </li>
        </ul>
    </div>
</div>