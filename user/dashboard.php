<?php

require_once '../includes/auth_check.php';
require_once '../includes/init.php';

$taskObj = taskModel();

$tasks = $taskObj->getUserTasks($_SESSION['user_id']);

?>
<?php require_once '../includes/header.php'; ?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="mb-1">
                Recent Tasks
            </h2>

            <p class="text-muted mb-0">
                Welcome, <?= e($_SESSION['first_name']) ?>
            </p>
        </div>

        <div>

            <a
                href="create_task.php"
                class="btn btn-primary"
            >
                Add Task
            </a>

        </div>

    </div>

    <?php if ($tasks->num_rows === 0) { ?>

        <div class="card main-card p-4 text-center">
            <h5 class="mb-2">
                No tasks yet
            </h5>

            <p class="text-muted mb-3">
                Create your first task to start organizing your work.
            </p>

            <div>
                <a
                    href="create_task.php"
                    class="btn btn-primary"
                >
                    Add Task
                </a>
            </div>
        </div>

    <?php } ?>

    <div class="row g-3">

        <?php
        $editUrl = 'edit_task.php?id=';
        $deleteUrl = 'delete_task.php?id=';
        $imagePrefix = '../';

        while ($task = $tasks->fetch_assoc()) {
            require '../includes/partials/task_card.php';
        }
        ?>

    </div>

</div>

<?php require_once '../includes/footer.php'; ?>
