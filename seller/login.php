<?php require_once('../inc/seller/connection.php');
require_once('../inc/functions.php');
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
			$query = "SELECT * FROM sellers
						WHERE email = '{$email}'
						AND password = '{$hashed_password}'
						LIMIT 1";
			$result_set = mysqli_query($connection, $query);
			verify_query($result_set);
			if (mysqli_num_rows($result_set) == 1) {
				// valid user found
				$user = mysqli_fetch_assoc($result_set);
				$_SESSION['seller_id'] = $user['id'];
				$_SESSION['seller_email'] = $user['email'];
				// updating last login
				$query = "UPDATE sellers SET last_login = NOW() ";
				$query .= "WHERE id = {$_SESSION['seller_id']} LIMIT 1";
				$result_set = mysqli_query($connection, $query);
				verify_query($result_set);
				// redirect to index.php
echo("<script>window.location = 'home.php';</script>");
} else {
// user name and password invalid
$errors[] = 'Invalid Username / Password';
}
}
}
if (isset($_SESSION['seller_email'])) {
echo("<script>
	window.location = 'home.php';
</script>");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Seller login Hardy online canteen</title>
		<?php include('../inc/seller/header-head.php') ?>		
	</head>
	<body>
		<?php include('../inc/seller/header-body.php') ?>
		<div class="container border border-secondary rounded col-xl-7 col-lg-7 col-md-9 col-sm-11 col-xs">
			<div class="row text-center m-5">
				<div class="col-4 my-auto">
					<img class="img-thumbnail w-75" src="../image/seller_logo.jpg" alt="seller">
				</div>
				<div class="col-8 my-auto">
					<h1>Seller login</h1>
				</div>
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
					<input class="form-control btn-success mb-5" type="submit" name="login" value="Log in">
				</div>
			</form>
			<div class="row">
			</div>
		</body>
	</html>
	<?php mysqli_close($connection); ?>