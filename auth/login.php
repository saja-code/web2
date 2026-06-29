<?php

session_start();

require_once '../includes/init.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $userObj = userModel();

    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = $userObj->login($email, $password);

    if ($user) {

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['isAdmin'] = $user['isAdmin'];

        if ($user['isAdmin'] == 1) {
            header("Location: ../admin/dashboard.php");
        } else {
            header("Location: ../user/dashboard.php");
        }

        exit();
    } else {
        $message = "Invalid Email or Password";
    }
}
?>

<?php require_once '../includes/header.php'; ?>

<div class="auth-box">
    <div class="card main-card p-4">

        <h3 class="text-center mb-2">Login</h3>

        <p class="text-muted text-center mb-4">
            Welcome back to your task manager.
        </p>

        <?php if($message != '') { ?>
            <div class="alert alert-danger">
                <?php echo $message; ?>
            </div>
        <?php } ?>

        <form method="POST">

            <div class="mb-3">
                <label class="form-label">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="name@example.com"
                    required
                >
            </div>

            <div class="mb-4">
                <label class="form-label">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="Enter your password"
                    required
                >
            </div>

            <button class="btn btn-primary w-100">
                Login
            </button>

        </form>

        <p class="text-center mt-3 mb-0">
            Don't have an account?
            <a href="register.php">Register</a>
        </p>

    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
