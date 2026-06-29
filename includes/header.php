<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$basePath = $basePath ?? '../';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= htmlspecialchars($basePath) ?>assets/css/style.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= htmlspecialchars($basePath) ?>index.php">Task Manager</a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#mainNavbar"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <div
            class="collapse navbar-collapse"
            id="mainNavbar"
        >
            <div class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                <?php if (isset($_SESSION['user_id'])) { ?>
                    <a
                        class="nav-link"
                        href="<?php echo $_SESSION['isAdmin'] == 1 ? htmlspecialchars($basePath) . 'admin/dashboard.php' : htmlspecialchars($basePath) . 'user/dashboard.php'; ?>"
                    >
                        Dashboard
                    </a>

                    <a
                        class="nav-link"
                        href="<?= htmlspecialchars($basePath) ?>user/profile.php"
                    >
                        Profile
                    </a>

                    <a
                        class="btn btn-outline-danger btn-sm"
                        href="<?= htmlspecialchars($basePath) ?>auth/logout.php"
                    >
                        Logout
                    </a>
                <?php } else { ?>
                    <a
                        class="nav-link"
                        href="<?= htmlspecialchars($basePath) ?>auth/login.php"
                    >
                        Login
                    </a>

                    <a
                        class="btn btn-primary btn-sm"
                        href="<?= htmlspecialchars($basePath) ?>auth/register.php"
                    >
                        Register
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</nav>
