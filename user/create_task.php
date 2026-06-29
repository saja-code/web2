<?php

require_once '../includes/auth_check.php';
require_once '../includes/init.php';

$taskObj = taskModel();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $imagePath = uploadTaskImage($_FILES['image'] ?? []);

    $taskObj->createTask(
        $_SESSION['user_id'],
        $title,
        $description,
        $status,
        $imagePath
    );

    redirectTo('dashboard.php');
}

?>

<?php require_once '../includes/header.php'; ?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="mb-0">
            Add New Task
        </h2>

        <a
            href="dashboard.php"
            class="btn btn-outline-secondary"
        >
            Back
        </a>

    </div>

    <div class="card main-card p-4">

        <?php
        $task = [];
        $backUrl = 'dashboard.php';
        $imagePrefix = '../';
        $submitLabel = 'Save Task';

        require '../includes/partials/task_form.php';
        ?>

    </div>

</div>

<?php require_once '../includes/footer.php'; ?>
