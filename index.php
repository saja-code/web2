<?php

require_once 'includes/init.php';

$taskObj = taskModel();
$tasks = $taskObj->getRecentPendingTasks(6);
$basePath = '';
?>

<?php require_once 'includes/header.php'; ?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">
                Recent Pending Tasks
            </h2>

            <p class="text-muted mb-0">
                A quick summary of the newest tasks waiting to be completed.
            </p>
        </div>

        <?php if (isset($_SESSION['user_id'])) { ?>
            <a
                href="<?= $_SESSION['isAdmin'] == 1 ? 'admin/dashboard.php' : 'user/dashboard.php' ?>"
                class="btn btn-primary"
            >
                Dashboard
            </a>
        <?php } else { ?>
            <a
                href="auth/login.php"
                class="btn btn-primary"
            >
                Login
            </a>
        <?php } ?>
    </div>

    <?php if ($tasks->num_rows === 0) { ?>
        <div class="card main-card p-4 text-center">
            <h5 class="mb-2">
                No pending tasks yet
            </h5>

            <p class="text-muted mb-0">
                Pending tasks will appear here once users start creating them.
            </p>
        </div>
    <?php } ?>

    <div class="row g-3">
        <?php
        $editUrl = isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1
            ? 'admin/edit_task.php?id='
            : 'user/edit_task.php?id=';
        $deleteUrl = isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1
            ? 'admin/delete_task.php?id='
            : 'user/delete_task.php?id=';
        $imagePrefix = '';
        $showActions = isset($_SESSION['user_id']);

        while ($task = $tasks->fetch_assoc()) {
            require 'includes/partials/task_card.php';
        }
        ?>
    </div>

</div>

<?php require_once 'includes/footer.php'; ?>
