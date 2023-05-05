<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php 

	// check for form submission
	if (isset($_POST['find'])) {
		$errors = array();

		// check if the username has been entered
		if (!isset($_POST['email']) || strlen(trim($_POST['email'])) < 1 ) {
			$errors[] = 'Username is Missing / Invalid';
		}
		
		// check if there are any errors in the form
		if (empty($errors)) {
			// save username and password into variables
			$find_email	= mysqli_real_escape_string($connection, $_POST['email']);

			// prepare database query
			$query = "SELECT * FROM customers 
						WHERE email = '{$find_email}' 
						LIMIT 1";
			
			$result_set = mysqli_query($connection, $query);

			verify_query($result_set);

			if (mysqli_num_rows($result_set) == 1) {
				// valid user found
				$_SESSION['find_email'] = $find_email;				

				$result_set = mysqli_query($connection, $query);

				verify_query($result_set);

				// redirect to index.php
				header('Location: reset_pw.php');
			} else {
				// user name and password invalid
				$errors[] = 'Invalid Username / Password';
			}
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Find your account</title>
		<?php include('inc/header-head.php') ?>
	</head>
	<body>
		<?php include('inc/header-body.php') ?>
		<div class="container border border-secondary rounded col-xl-6 col-lg-7 col-md-9 col-sm-11 col-xs">
			
			<div class="row">
				<div class="col-12 text-center">
					<h2 class="mt-3">Find your account</h2>
				</div>
			</div>
			<form action="" method="post">
				
				<div class="row">
					<div class="col-12">						
							<?php
							if (isset($errors) && !empty($errors)) {
								echo '<div class="alert alert-danger" role="alert">
							Invalid Email Address
						</div>';
							}
							?>												
					</div>
					<div class="col-12">
						<h6 class="mt-3">Please enter your email address to search for your account.</h6>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<input class="form-control" type="email" name="email" placeholder="yourname@gmail.com">
					</div>
				</div>
				<div class="row">
					<div class="col-12 text-center">
						<input type="submit" class="btn-success btn-lg px-5 my-3" name="find" value="Search"></input>
					</div>
				</div>
			</form>
		</div>
	</body>
</html>
<?php mysqli_close($connection); ?>