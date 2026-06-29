<?php

require_once '../includes/admin_check.php';
require_once '../includes/init.php';

$userObj = userModel();

$id = (int) $_GET['id'];
$user = $userObj->getById($id);

if (!$user) {
    header("Location: users.php");
    exit();
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $isAdmin = isset($_POST['isAdmin']) ? (int) $_POST['isAdmin'] : 0;

    if (
        $userObj->updateUser(
            $id,
            $_POST['first_name'],
            $_POST['last_name'],
            $_POST['email'],
            $isAdmin
        )
    ) {
        if ($_SESSION['user_id'] == $id) {
            $_SESSION['first_name'] = $_POST['first_name'];
            $_SESSION['isAdmin'] = $isAdmin;
        }

        header("Location: users.php");
        exit();
    }

    $message = 'Could not update user. Email may already exist.';
}
?>

<?php require_once '../includes/header.php'; ?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">
            Edit User
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
                        value="<?= htmlspecialchars($user['first_name']) ?>"
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
                        value="<?= htmlspecialchars($user['last_name']) ?>"
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
                        value="<?= htmlspecialchars($user['email']) ?>"
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
                        <option value="0" <?php if ($user['isAdmin'] == 0) echo 'selected'; ?>>
                            User
                        </option>
                        <option value="1" <?php if ($user['isAdmin'] == 1) echo 'selected'; ?>>
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
                    Update User
                </button>
            </div>
        </form>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
