<?php

require_once __DIR__ . '/../helpers.php';

$description = $task['description'] ?? '';
$imagePath = $task['image_path'] ?? '';
$ownerName = trim(($task['first_name'] ?? '') . ' ' . ($task['last_name'] ?? ''));
if ($ownerName === '' && isset($_SESSION['first_name'])) {
    $ownerName = $_SESSION['first_name'];
}
$createdAt = !empty($task['created_at'])
    ? date('Y-m-d', strtotime($task['created_at']))
    : '';
$statusAccentClass = Task::statusAccentClass($task['status']);
$showActions = $showActions ?? true;
?>

<div class="col-12 col-md-6 col-xl-4">
    <div class="card task-card <?= e($statusAccentClass) ?>">
        <div class="task-card-body">
            <div class="d-flex align-items-start justify-content-between gap-3 mb-4">
                <h5 class="task-card-title mb-0">
                    <?= e($task['title']) ?>
                </h5>

                <span class="task-status-pill <?= e(Task::statusBadgeClass($task['status'])) ?>">
                    <?= e($task['status']) ?>
                </span>
            </div>

            <?php if ($createdAt !== '') { ?>
                <div class="task-date mb-4">
                    <i class="bi bi-calendar3"></i>
                    <span><?= e($createdAt) ?></span>
                </div>
            <?php } ?>

            <div class="task-card-content">
                <p class="task-card-description mb-0">
                    <?= e($description) ?>
                </p>

                <?php if ($imagePath !== '') { ?>
                    <img
                        src="<?= e($imagePrefix . $imagePath) ?>"
                        class="task-card-thumb"
                        alt="Task image"
                    >
                <?php } ?>
            </div>
        </div>

        <div class="task-card-footer">
            <div class="task-owner">
                <span class="task-owner-avatar">
                    <i class="bi bi-person-fill"></i>
                </span>

                <span>
                    <?= e($ownerName) ?>
                </span>
            </div>

            <?php if ($showActions) { ?>
                <div class="task-actions">
                    <a
                        href="<?= e($editUrl . $task['id']) ?>"
                        class="btn btn-sm task-action-button task-action-edit"
                    >
                        <i class="bi bi-pencil-square"></i>
                        Edit
                    </a>

                    <a
                        href="<?= e($deleteUrl . $task['id']) ?>"
                        class="btn btn-sm task-action-button task-action-delete"
                    >
                        <i class="bi bi-trash3"></i>
                        Delete
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
