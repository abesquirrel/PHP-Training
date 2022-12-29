<?php
	// Initialize session
	session_start();
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
		header('location: dashboard.php');
		exit;
	}
	require_once('functions.php');

	$username = !empty($_POST['username']) ? strtolower(str_replace(' ', '_', $_POST['username'])) : null;
	$password = !empty($_POST['password']) ? trim($_POST['password']) : null;

	if (isset($_POST['submit'])
		&& !empty($username)
		&& !empty($password)) {
		// Validate credentials
		$query =
			"SELECT users.id, users.username, users.password FROM users WHERE users.username = '{$username}'";
		$result = mysqli_fetch_array(mysqli_query($mysqli, $query), MYSQLI_ASSOC);

		if (is_null($result) || $result['username'] != $username) {
			function_alert("Invalid username.");
		} elseif (password_verify($password, $result['password'])) {
			// Password verified
            if(!isset($_SESSION))
            {
                session_start();
            }
			// Store data in session global variables
			$_SESSION['loggedin'] = true;
			$_SESSION['id'] = $result['id'];
			$_SESSION['username'] = $result['username'];

			// Redirect to dashboard
			header('dashboard.php');
		} else {
			function_alert("Incorrect password!");
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
<section class="vh-100" style="background-color: #eee;">
	<div class="container h-100">
		<div class="row d-flex justify-content-center align-items-center h-100">
			<div class="col-lg-12 col-xl-11">
				<div class="card text-black" style="border-radius: 25px;">
					<div class="card-body p-md-5">
						<div class="row justify-content-center">
							<div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
								<p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Login</p>
								<form class="mx-1 mx-md-4" action="<?=$_SERVER['PHP_SELF'];?>" method="post">
									<div class="d-flex flex-row align-items-center mb-4">
										<i class="fas fa-user fa-lg me-3 fa-fw"></i>
										<div class="form-outline flex-fill mb-0">
											<input type="text" id="username" name="username" class="form-control" />
											<label class="form-label" for="username">Your Username</label>
										</div>
									</div>
									<div class="d-flex flex-row align-items-center mb-4">
										<i class="fas fa-lock fa-lg me-3 fa-fw"></i>
										<div class="form-outline flex-fill mb-0">
											<input type="password" id="password" name="password" class="form-control" />
											<label class="form-label" for="password">Password</label>
										</div>
									</div>
									<div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
										<input type="submit" name="submit" value="Login" class="btn btn-primary btn-lg">
									</div>
									<div class="d-flex flex-row align-items-center mb-4">
										<p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</section>
</body>
</html>