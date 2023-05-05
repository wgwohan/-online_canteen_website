<?php require_once('inc/connection.php');
	require_once('inc/functions.php');
	$active = "profile";
	// check for form submission
	if (isset($_POST['login'])) {
		$errors = array();
		// check if the username and password has been entered
		if (!isset($_POST['email']) || strlen(trim($_POST['email'])) < 1 ) {
			$errors[] = 'Username is Missing / Invalid';
		}
		if (!isset($_POST['password']) || strlen(trim($_POST['password'])) < 1 ) {
			$errors[] = 'Password is Missing / Invalid';
		}
		// check if there are any errors in the form
		if (empty($errors)) {
			// save username and password into variables
			$email 		= mysqli_real_escape_string($connection, $_POST['email']);
			$password 	= mysqli_real_escape_string($connection, $_POST['password']);
			$hashed_password = sha1($password);
			// prepare database query
			$query = "SELECT * FROM customers
						WHERE email = '{$email}'
						AND password = '{$hashed_password}'
						LIMIT 1";
			$result_set = mysqli_query($connection, $query);
			verify_query($result_set);
			if (mysqli_num_rows($result_set) == 1) {
				// valid user found
				$user = mysqli_fetch_assoc($result_set);
				$_SESSION['user_id'] = $user['id'];
				$_SESSION['first_name'] = $user['first_name'];
				$_SESSION['email'] = $user['email'];
				// updating last login
				$query = "UPDATE customers SET last_login = NOW() ";
				$query .= "WHERE id = {$_SESSION['user_id']} LIMIT 1";
				$result_set = mysqli_query($connection, $query);
				verify_query($result_set);
				// redirect to index.php
echo("<script>	window.location = 'index.php'; </script>");
} else {
// user name and password invalid
$errors[] = 'Invalid Username / Password';
}
}
}
if (isset($_SESSION['email'])) {
echo("<script>
	window.location = 'Cprofile.php';
</script>");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Log in Hardy online canteen</title>
		<?php include('inc/header-head.php') ?>		
	</head>
	<body>
		<?php include('inc/header-body.php') ?>
		<div class="container border border-secondary rounded col-xl-6 col-lg-7 col-md-9 col-sm-11 col-xs">
			<div class="text-center m-5">
				<h2>Log in</h2><!-- class-pageTitle1, log in title, Log in.css -->
			</div>
			<form action="" method="post">
				<?php
					if (isset($errors) && !empty($errors)) {
						echo '<div class="alert alert-danger" role="alert">Invalid Username / Password</div>';
					}
				?>				
				<div >
					<label for="email">Email Address</label>
					<input class="form-control" type="email" name="email" id="email" autofocus placeholder="example@email.com" required>
				</div>
				
				<div>
					<label for="password">Password</label>
					<input class="form-control" id="password" name="password" type="password"placeholder="Password">
				</div>
				<div>
					<label for=""></label>
					<input class="form-control btn-success" type="submit" name="login" value="Log in">
				</div>
			</form>
			<div class="row">
				<div class="col-12">
					<a class="float-right m-2"  href="find_acccount.php">Forget password?</a>
				</div>
			</div>
			<div class="row mt-5 text-center">
				<div class="col-4">
					<label class=""><h6>Are you new here?</h6></label>
				</div>
				<div class="col-4">
					<a href="register.php" > Create an account </a>
				</div>
				<div class="col-4">
					<a class="text-muted" href="seller/login.php">Seller login</a>
				</div>
			</div>
		</body>
	</html>
	<?php mysqli_close($connection); ?>