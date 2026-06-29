<?php

require_once '../includes/admin_check.php';
require_once '../includes/init.php';

$userObj = userModel();

$result = $userObj->getAll();
?>

<?php require_once '../includes/header.php'; ?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="mb-0">
            Users Management
        </h2>

        <div class="d-flex gap-2">
            <a
                href="create_user.php"
                class="btn btn-primary"
            >
                Add User
            </a>

            <a
                href="dashboard.php"
                class="btn btn-outline-secondary"
            >
                Back
            </a>
        </div>

    </div>

    <div class="card main-card">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php while($user = $result->fetch_assoc()) { ?>

                        <tr>
                            <td>
                                <?= htmlspecialchars($user['id']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($user['first_name']) ?>
                                <?= htmlspecialchars($user['last_name']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($user['email']) ?>
                            </td>

                            <td>
                                <?php if ($user['isAdmin'] == 1) { ?>
                                    <span class="badge bg-primary">
                                        Admin
                                    </span>
                                <?php } else { ?>
                                    <span class="badge bg-secondary">
                                        User
                                    </span>
                                <?php } ?>
                            </td>

                            <td class="text-end">
                                <a
                                    href="edit_user.php?id=<?= htmlspecialchars($user['id']) ?>"
                                    class="btn btn-sm btn-outline-primary"
                                >
                                    Edit
                                </a>

                                <a
                                    href="delete_user.php?id=<?= htmlspecialchars($user['id']) ?>"
                                    class="btn btn-sm btn-outline-danger"
                                >
                                    Delete
                                </a>
                            </td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>

<?php require_once '../includes/footer.php'; ?>
