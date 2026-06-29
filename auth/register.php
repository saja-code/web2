<?php

require_once '../includes/init.php';

$message = '';
$messageType = 'success';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user = userModel();

    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (
        $user->register(
            $firstName,
            $lastName,
            $email,
            $password
        )
    ) {
        $message = "Registration successful!";
    } else {
        $message = "Registration failed. Check your email or database settings.";
        $messageType = 'danger';
    }
}
?> 
<?php require_once '../includes/header.php'; ?>

<div class="auth-box">

    <div class="card main-card p-4">

        <h3 class="text-center mb-2">
            Register
        </h3>

        <p class="text-muted text-center mb-4">
            Create your account and start tracking tasks.
        </p>

        <?php if($message != '') { ?>

            <div class="alert alert-<?php echo $messageType; ?>">
                <?php echo $message; ?>
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

                <div class="col-12">
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

                <div class="col-12">
                    <label class="form-label">
                        Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        minlength="6"
                        required
                    >
                </div>
            </div>

            <button
                type="submit"
                class="btn btn-primary w-100 mt-4"
            >
                Register
            </button>

        </form>

        <p class="text-center mt-3 mb-0">
            Already have an account?
            <a href="login.php">
                Login
            </a>
        </p>

    </div>

</div>

<?php require_once '../includes/footer.php'; ?>
