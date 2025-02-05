<?php
session_start();
session_destroy();
setcookie("loginCredentials", "", time() - 3600, "/");
header('Location: ../admin/');
die();
