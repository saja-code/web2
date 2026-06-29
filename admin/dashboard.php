<?php

require_once '../includes/admin_check.php';

?>

<?php require_once '../includes/header.php'; ?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="mb-1">
                Admin Dashboard
            </h2>

            <p class="text-muted mb-0">
                Welcome, <?php echo htmlspecialchars($_SESSION['first_name']); ?>
            </p>
        </div>

    </div>

    <div class="card main-card p-4 mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1">
                    Users Management
                </h5>

                <p class="text-muted mb-0">
                    View and manage registered users.
                </p>
            </div>

            <a
                href="users.php"
                class="btn btn-primary"
            >
                Manage Users
            </a>
        </div>
    </div>

    <div class="card main-card p-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-1">
                    Tasks Management
                </h5>

                <p class="text-muted mb-0">
                    Review all tasks across users.
                </p>
            </div>

            <a
                href="tasks.php"
                class="btn btn-primary"
            >
                Manage Tasks
            </a>
        </div>
    </div>

</div>

<?php require_once '../includes/footer.php'; ?>
