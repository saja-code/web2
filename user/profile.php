<?php

require_once '../includes/auth_check.php';
require_once '../includes/init.php';

$userObj = userModel();
$currentUser = $userObj->getById((int) $_SESSION['user_id']);

$message = '';
$messageType = 'success';
$backUrl = $_SESSION['isAdmin'] == 1 ? '../admin/dashboard.php' : 'dashboard.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['form_type'] === 'profile') {
        if (
            $userObj->updateUser(
                (int) $_SESSION['user_id'],
                $_POST['first_name'],
                $_POST['last_name'],
                $_POST['email'],
                (int) $_SESSION['isAdmin']
            )
        ) {
            $_SESSION['first_name'] = $_POST['first_name'];
            $currentUser = $userObj->getById((int) $_SESSION['user_id']);
            $message = 'Profile updated successfully.';
        } else {
            $message = 'Could not update profile. Email may already exist.';
            $messageType = 'danger';
        }
    } elseif ($_POST['new_password'] !== $_POST['confirm_password']) {
        $message = 'New password and confirmation do not match.';
        $messageType = 'danger';
    } elseif (
        $userObj->changePassword(
            $_SESSION['user_id'],
            $_POST['current_password'],
            $_POST['new_password']
        )
    ) {
        $message = 'Password updated successfully.';
    } else {
        $message = 'Current password is incorrect.';
        $messageType = 'danger';
    }
}
?>

<?php require_once '../includes/header.php'; ?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-1">
                Profile
            </h2>

            <p class="text-muted mb-0">
                Manage your account information and security.
            </p>
        </div>

        <a
            href="<?= htmlspecialchars($backUrl) ?>"
            class="btn btn-outline-secondary"
        >
            Back
        </a>
    </div>

    <div class="card main-card p-4">

        <?php if ($message != '') { ?>
            <div class="alert alert-<?= htmlspecialchars($messageType) ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php } ?>

        <form method="POST" class="mb-4">
            <input type="hidden" name="form_type" value="profile">

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">
                        First Name
                    </label>

                    <input
                        type="text"
                        name="first_name"
                        class="form-control"
                        value="<?= htmlspecialchars($currentUser['first_name']) ?>"
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
                        value="<?= htmlspecialchars($currentUser['last_name']) ?>"
                        required
                    >
                </div>

                <div class="col-12">
                    <label class="form-label">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="<?= htmlspecialchars($currentUser['email']) ?>"
                        required
                    >
                </div>
            </div>

            <div class="d-flex justify-content-end mt-4">
                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Update Profile
                </button>
            </div>
        </form>

        <hr>

        <form method="POST" class="mt-4">
            <input type="hidden" name="form_type" value="password">

            <div class="mb-3">
                <label class="form-label">
                    Current Password
                </label>

                <input
                    type="password"
                    name="current_password"
                    class="form-control"
                    required
                >
            </div>

            <div class="mb-3">
                <label class="form-label">
                    New Password
                </label>

                <input
                    type="password"
                    name="new_password"
                    class="form-control"
                    minlength="6"
                    required
                >
            </div>

            <div class="mb-4">
                <label class="form-label">
                    Confirm New Password
                </label>

                <input
                    type="password"
                    name="confirm_password"
                    class="form-control"
                    minlength="6"
                    required
                >
            </div>

            <div class="d-flex justify-content-end">
                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Update Password
                </button>
            </div>
        </form>

    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
