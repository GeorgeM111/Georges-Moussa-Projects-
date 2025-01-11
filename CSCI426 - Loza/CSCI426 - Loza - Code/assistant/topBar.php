<div class="topbar w-100 d-flex align-items-center justify-content-between">
    <div class="toggle d-flex justify-content-start align-items-center" id="toggle">
        <ion-icon name="menu-outline"></ion-icon>
    </div>

    <div class="user d-flex justify-content-evenly">
        <div class="usericon">
            <ion-icon name="person" class="me-3 mt-1 icon"></ion-icon>
        </div>
        <a href="Profile.php" type="button" class="btn text-white admin">
            <?php
                echo $_SESSION['assistantLoginCredentials']['Username'];
            ?>
        </a>
    </div>
</div>

