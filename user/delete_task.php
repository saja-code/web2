<?php

require_once '../includes/auth_check.php';
require_once '../includes/init.php';

$id = (int) $_GET['id'];
$taskObj = taskModel();
$task = $taskObj->getUserTask($id, $_SESSION['user_id']);

if (!$task) {
    redirectTo('dashboard.php');
}

$taskObj->deleteTask($id);

redirectTo('dashboard.php');
