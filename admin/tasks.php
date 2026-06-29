<?php

require_once '../includes/admin_check.php';
require_once '../includes/init.php';

$taskObj = taskModel();

$result = $taskObj->getAllWithUsers();
?>

<?php require_once '../includes/header.php'; ?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="mb-0">
            All Tasks
        </h2>

        <a
            href="dashboard.php"
            class="btn btn-outline-secondary"
        >
            Back
        </a>

    </div>

    <div class="row g-3">

        <?php
        $editUrl = 'edit_task.php?id=';
        $deleteUrl = 'delete_task.php?id=';
        $imagePrefix = '../';

        while ($task = $result->fetch_assoc()) {
            require '../includes/partials/task_card.php';
        }
        ?>

    </div>

</div>

<?php require_once '../includes/footer.php'; ?>
