<?php

require_once '../includes/admin_check.php';
require_once '../includes/init.php';

$userObj = userModel();

$id = (int) $_GET['id'];

if ($_SESSION['user_id'] != $id) {
    $userObj->deleteUser($id);
}

header("Location: users.php");
exit();
