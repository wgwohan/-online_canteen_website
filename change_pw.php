<?php require_once('inc/connection.php'); ?>
<?php 	
	$email = $_SESSION['find_email'];
	$errors 		= array();
	$password 		= '';
	$confirm		= '';
	
	if (isset($_POST['submit'])) {
		$password 		= sha1($_POST['password']);
		$confirm		= sha1($_POST['confirm']);

		// checking required fields
		$req_fields = array('password', 'confirm');

		foreach ($req_fields as $field) {
			if (empty(trim($_POST[$field]))) {
				$errors[] = $field . ' is required';
			}
		}

		// checking max length
		$max_len_fields = array('password' => 40);

		foreach ($max_len_fields as $field => $max_len) {
			if (strlen(trim($_POST[$field])) > $max_len) {
				$errors[] = $field . ' must be less than ' . $max_len . ' characters';
			}
		}

		//checking password  match
		if ($password !== $confirm) {
			$errors[] = 'Password did not match! try again.';
		}

		//send data to db
		if (empty($errors)) {
			//no any errors now we can add new user to db
			$query = "UPDATE customers SET password = '{$password}' WHERE email = '{$email}' LIMIT 1";

			$result = mysqli_query($connection, $query);

			if ($result) {
				//query success! redirect to home page
				header('Location: index.php');
			} else {
				echo "Database query failed.";
			}

		}
	}

 ?>
<!DOCTYPE html>
<html>
	<head>
		<title> Reset your account password</title>
		<?php include('inc/header-head.php') ?>
	</head>
	<body>
		<?php include('inc/header-body.php') ?>
		
		<div class="container border border-secondary rounded col-xl-6 col-lg-7 col-md-9 col-sm-11 col-xs">
			<div class="row">
				<div class="col-12 my-3 text-center">
					<h2 class="headertext">Create a new password</h2>
				</div>
			</div>
			<hr>
			<hr>
			<form action="change_pw.php" method="post">
				<div class="row">
					<div class="col-12">
						<?php
						if (!empty($errors)) {
						echo '<div class="errmsg">';
							foreach ($errors as $error) {
								echo '- ' . $error . '<br>';
							}
						echo '</div>';
						}
						?>
					</div>
				</div>
				
				<div class="row">
					<div class="col-12">
						<h6 class="description">Create a new password that must be strong password.</h6>
					</div>
				</div>
				
				<div class="row">
					<div class="col-12">
						<input style="padding-left: 10px;" class="form-control" name="password" type="password" placeholder="New password" required>
					</div>
					<div class="col-12 mt-2">
						<input style="padding-left: 10px;" class="form-control" name="confirm" type="password" placeholder="Confirm password" required>
					</div>
				</div>
				<div class="row">
					<div class="col-12 text-center">
						<input class="btn-success btn-lg my-3" type="submit" name="submit" value="Continue"></input>
					</div>
				</div>
			</form>
		</div>
	</body>
</html>
<?php mysqli_close($connection); ?>