<?php

require_once __DIR__ . '/../helpers.php';

$task = $task ?? [];
$title = $task['title'] ?? '';
$description = $task['description'] ?? '';
$currentStatus = $task['status'] ?? 'Pending';
$imagePath = $task['image_path'] ?? '';
?>

<form
    method="POST"
    enctype="multipart/form-data"
>
    <div class="mb-3">
        <label class="form-label">
            Task Title
        </label>

        <input
            type="text"
            name="title"
            class="form-control"
            value="<?= e($title) ?>"
            placeholder="Enter task title"
            required
        >
    </div>

    <div class="mb-3">
        <label class="form-label">
            Description
        </label>

        <textarea
            name="description"
            class="form-control"
            rows="5"
            placeholder="Enter task description"
            required
        ><?= e($description) ?></textarea>
    </div>

    <div class="mb-4">
        <label class="form-label">
            Status
        </label>

        <select
            name="status"
            class="form-select"
        >
            <?php foreach (Task::STATUSES as $status) { ?>
                <option value="<?= e($status) ?>" <?= selected($currentStatus, $status) ?>>
                    <?= e($status) ?>
                </option>
            <?php } ?>
        </select>
    </div>

    <div class="mb-4">
        <label class="form-label">
            Task Image
        </label>

        <?php if ($imagePath !== '') { ?>
            <img
                src="<?= e($imagePrefix . $imagePath) ?>"
                class="img-fluid rounded mb-3"
                alt="Task image"
            >
        <?php } ?>

        <input
            type="file"
            name="image"
            class="form-control"
            accept="image/*"
        >
    </div>

    <div class="d-flex justify-content-end gap-2">
        <a
            href="<?= e($backUrl) ?>"
            class="btn btn-light"
        >
            Cancel
        </a>

        <button
            type="submit"
            class="btn btn-primary"
        >
            <?= e($submitLabel) ?>
        </button>
    </div>
</form>
