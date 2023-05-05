<?php require_once('inc/connection.php');
$active = "profile"; 
require_once('inc/functions.php');
	// check for form submission
	if (isset($_POST['delete'])) {
		$errors = array();
		$email = $_SESSION['email'];				
		$password 	= mysqli_real_escape_string($connection, $_POST['password']);
		$hashed_password = sha1($password);
		// prepare database query
		$query = "SELECT password FROM customers
					WHERE email = '{$email}'
					AND password = '{$hashed_password}'
					LIMIT 1";
		$result_set = mysqli_query($connection, $query);
		verify_query($result_set);
		if (mysqli_num_rows($result_set) == 1) {			
			// updating the db
			$query = "UPDATE customers SET user_deleted = 1 WHERE email = '{$email}' LIMIT 1";
			$result_set = mysqli_query($connection, $query);
			verify_query($result_set);
			// redirect to index.php
			session_unset();
			session_destroy();
			echo("<script>
				window.location = 'index.php';
			</script>");
			} else {
			// user name and password invalid
			$errors[] = 'Invalid Username / Password';
			}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Confirm delete</title>
		<?php include('inc/header-head.php') ?>
	</head>
	<body>
		<?php include('inc/header-body.php') ?>
		<div class="container border border-secondary rounded col-xl-6 col-lg-7 col-md-9 col-sm-11 col-xs">
			<div class="row">
				<div class="col-12 text-center my-3">
					<h2>Confirm delete</h2>
				</div>
			</div>
			<hr>
			<form action="" method="post">
				<div class="row">
					<div class="col-11 ">
						<h6 class="ml-3">Enter your password.</h6>
					</div>
				</div>
				
					<div class="alert alert-danger rounded my-3 text-center" role="alert">
						If you delete your account you're unable to order again and if you want to re-register, you have to contact the administrator.
					</div>
				
				<?php
					if (isset($errors) && !empty($errors)) {
						echo '<div class="alert alert-danger" role="alert">Invalid Username / Password</div>';
						}
				?>
				<div class="row">
					<div class="col-12">
						<input class="form-control" type="password" placeholder="Password" name="password">
					</div>
				</div>
				<div class="row text-center">
					<div class="col-6">
						<a href="login.php"><button type="button" class="btn-warning btn-lg my-3" >Cancel</button></a>
					</div>
					<div class="col-6">
						<button class="btn-danger btn-lg my-3" type="submit" name="delete">Confirm</button>
					</div>
				</div>
			</form>
		</div>
	</body>
</html>
<?php mysqli_close($connection); ?>