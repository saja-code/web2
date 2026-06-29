<?php

require_once '../includes/admin_check.php';
require_once '../includes/init.php';

$userObj = userModel();

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $isAdmin = isset($_POST['isAdmin']) ? (int) $_POST['isAdmin'] : 0;

    if (
        $userObj->register(
            $_POST['first_name'],
            $_POST['last_name'],
            $_POST['email'],
            $_POST['password'],
            $isAdmin
        )
    ) {
        header("Location: users.php");
        exit();
    }

    $message = 'Could not create user. Email may already exist.';
}
?>

<?php require_once '../includes/header.php'; ?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">
            Add User
        </h2>

        <a
            href="users.php"
            class="btn btn-outline-secondary"
        >
            Back
        </a>
    </div>

    <div class="card main-card p-4">

        <?php if ($message != '') { ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php } ?>

        <form method="POST">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">
                        First Name
                    </label>

                    <input
                        type="text"
                        name="first_name"
                        class="form-control"
                        required
                    >
                </div>

                <div class="col-md-6">
                    <label class="form-label">
                        Last Name
                    </label>

                    <input
                        type="text"
                        name="last_name"
                        class="form-control"
                        required
                    >
                </div>

                <div class="col-md-6">
                    <label class="form-label">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        required
                    >
                </div>

                <div class="col-md-6">
                    <label class="form-label">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        required
                    >
                </div>

                <div class="col-md-6">
                    <label class="form-label">
                        Role
                    </label>

                    <select
                        name="isAdmin"
                        class="form-select"
                    >
                        <option value="0">
                            User
                        </option>
                        <option value="1">
                            Admin
                        </option>
                    </select>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <a
                    href="users.php"
                    class="btn btn-light"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Save User
                </button>
            </div>
        </form>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
