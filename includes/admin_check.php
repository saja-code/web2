<?php

require_once 'auth_check.php';

if ($_SESSION['isAdmin'] != 1) {
    header("Location: ../user/dashboard.php");
    exit();
}
