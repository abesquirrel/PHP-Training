<?php
// Initialize the session

session_start();

// check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('location: login.php');
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
          crossorigin="anonymous">
</head>
<body>
<h1 class="my-5">Welcome to you dashboard <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.</h1>
<p>
    <a href="password_reset.php" class="btn btn-warning">Reset Your Password</a>
    <a href="logout.php" class="btn btn-danger ml-3">Sign Out of your Account</a>
</p>
</body>
</html>