<?php

require_once '../includes/auth_check.php';
require_once '../includes/init.php';

$id = (int) $_GET['id'];
$taskObj = taskModel();
$task = $taskObj->getUserTask($id, $_SESSION['user_id']);

if (!$task) {
    redirectTo('dashboard.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $imagePath = uploadTaskImage($_FILES['image'] ?? []);

    $taskObj->updateTask(
        $id,
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
            Edit Task
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
        $backUrl = 'dashboard.php';
        $imagePrefix = '../';
        $submitLabel = 'Update Task';

        require '../includes/partials/task_form.php';
        ?>

    </div>

</div>

<?php require_once '../includes/footer.php'; ?>
