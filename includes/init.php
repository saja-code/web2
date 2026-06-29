<?php

require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../classes/Task.php';
require_once __DIR__ . '/../classes/User.php';

function dbConnection(): mysqli
{
    static $conn = null;

    if ($conn === null) {
        $db = new Database();
        $conn = $db->connect();
    }

    return $conn;
}

$conn = dbConnection();

function taskModel(): Task
{
    return new Task(dbConnection());
}

function userModel(): User
{
    return new User(dbConnection());
}
