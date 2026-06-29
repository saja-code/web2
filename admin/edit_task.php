<?php

require_once '../includes/admin_check.php';
require_once '../includes/init.php';

$id = (int) $_GET['id'];
$taskObj = taskModel();
$task = $taskObj->getById($id);

if (!$task) {
    redirectTo('tasks.php');
}

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $imagePath = uploadTaskImage($_FILES['image'] ?? []);

    $taskObj->updateTask(
        $id,
        $_POST['title'],
        $_POST['description'],
        $_POST['status'],
        $imagePath
    );

    redirectTo('tasks.php');
}
?>

<?php require_once '../includes/header.php'; ?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="mb-0">
            Edit Task
        </h2>

        <a
            href="tasks.php"
            class="btn btn-outline-secondary"
        >
            Back
        </a>

    </div>

    <div class="card main-card p-4">

        <?php
        $backUrl = 'tasks.php';
        $imagePrefix = '../';
        $submitLabel = 'Update Task';

        require '../includes/partials/task_form.php';
        ?>

    </div>

</div>

<?php require_once '../includes/footer.php'; ?>
