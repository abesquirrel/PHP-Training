<?php
	require('functions.php');

	function validate_password_strength($password): bool
	{
		// Validate password strength
		$uppercase = preg_match('@[A-Z]@', $password);
		$lowercase = preg_match('@[a-z]@', $password);
		$number = preg_match('@[0-9]@', $password);
		$specialChars = preg_match('@\W@', $password);

		if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
			return false;
		}else{
			return true;
		}
	}

	$username = !empty($_POST['username']) ? strtolower(str_replace(' ', '_', $_POST['username'])) : null;
	$password = !empty($_POST['password']) ? trim($_POST['password']) : null;
	$password_check = !empty($_POST['password_check']) ? trim($_POST['password_check']) : null;
	$created_at = date("Y-m-d H:i:s");

	if (isset($_POST['submit'])
		&& !empty($username)
		&& !empty($password)
		&& !empty($password_check)
	) {
		$hashed_password = '';
		$query = "SELECT * FROM users WHERE users.username = '{$username}'";
		$result = mysqli_query($mysqli, $query);
		if (!is_null($result)) {
			function_alert("Username already taken.");
		} else {
			if (validate_password_strength($password)) {
				if (strcmp($password, $password_check) == 0) {
					$hashed_password = password_hash(trim($password), PASSWORD_DEFAULT);
					$query = "INSERT INTO users(username,password,created_at) 
					VALUES ('{$username}', '{$hashed_password}', '{$created_at}')";
					$result = mysqli_query($mysqli, $query);
					!$result ? function_alert('Account not created!') : function_alert('Successful!');

				} else {
					function_alert('Passwords do not match!');
				}
			} else {
				function_alert('Password is not strong enough');
			}
		}
	}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registration</title>
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
								<p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>
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

									<div class="d-flex flex-row align-items-center mb-4">
										<i class="fas fa-key fa-lg me-3 fa-fw"></i>
										<div class="form-outline flex-fill mb-0">
											<input type="password" id="password_check" name="password_check" class="form-control" />
											<label class="form-label" for="password_check">Repeat your password</label>
										</div>
									</div>
									<div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
										<input type="submit" name="submit" value="Register" class="btn btn-primary btn-lg">
									</div>
									<div class="d-flex flex-row align-items-center mb-4">
										<p>Have an account? <a href="login.php">Login now</a>.</p>
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