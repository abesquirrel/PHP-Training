<?php
// Session initialize
session_start();

// Check if the user is logged in, otherwise redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('location: login.php');
    exit;
}

require_once 'functions.php';
$new_password = $confirm_password = '';
$new_password_err = $confirm_password_err = '';


if($_SERVER['REQUEST_METHOD'] == "POST") {
    // Validate new password
    if (empty(trim($_POST['new_password']))) {
        $new_password_err = "Please enter the new password.";
    } elseif (!validate_password_strength($_POST['new_password'])) {
        $new_password_err = "Password is not safe.";
    } else {
        $new_password = trim($_POST['new_password']);
    }

    // Validate confirm password
    if (empty(trim($_POST['confirm_password']))) {
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && strcmp($new_password, $confirm_password) != 0){
            $confirm_password_err = "Password did not match.";
        }
    }
    // Check input error before updating the database
    if (empty($new_password_err) && empty($confirm_password_err)) {
        // Set parameters
        $param_password = password_hash($new_password, PASSWORD_DEFAULT);
        $param_id = $_SESSION['id'];

        $query =
            "UPDATE users SET users.password = '{$param_password}' WHERE users.id = {$param_id}";

        if(mysqli_query($mysqli, $query)) {
            // Password updated successfully. Destroy the session, and redirect to login page
            session_destroy();
            header('location: login.php');
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
          crossorigin="anonymous">
</head>
<body>
    <div class="wrapper">
        <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
            <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Reset Password</p>
            <form class="mx-1 mx-md-4" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                        <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                        <label class="form-label" for="username">New Password</label>
                        <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
                    </div>
                </div>
                <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                        <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                        <label class="form-label" for="password">Confirm Password</label>
                    </div>
                </div>
                <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <input type="submit" name="submit" value="Change Password" class="btn btn-primary btn-lg">
                    <a class="btn btn-link ml-2" href="dashboard.php">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>