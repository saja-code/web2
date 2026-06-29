<?php

require_once '../includes/admin_check.php';
require_once '../includes/init.php';

$taskObj = taskModel();

$taskObj->deleteTask($_GET['id']);

redirectTo('tasks.php');
