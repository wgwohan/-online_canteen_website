<?php 	require_once('inc/connection.php'); 
		require_once('inc/functions.php'); 
		$active = "profile";?>
<?php
		$errors 		= array();
		$role 			= '';
		$first_name 	= '';
		$last_name 		= '';
		$email 			= '';
		$mobile_num 	= '';
		$gender 		= '';
		$st_reg_num 	= '';
		$room_num 		= '';
		$password 		= '';
		$confirm		= '';
		$user_deleted	= '';
	if (isset($_POST['register'])) {
		
		$role 			= $_POST['role'];
		$first_name 	= $_POST['first_name'];
		$last_name 		= $_POST['last_name'];
		$email 			= $_POST['email'];
		$mobile_num 	= $_POST['mobile_num'];
		$gender 		= $_POST['gender'];
		$st_reg_num 	= $_POST['st_reg_num'];
		$room_num 		= $_POST['room_num'];
		$password 		= sha1($_POST['password']);
		$confirm		= sha1($_POST['confirm']);
		$user_deleted	= 0;
		
		// checking required fields
		$req_fields = array('role', 'first_name', 'last_name', 'email', 'mobile_num', 'gender', 'password');
		foreach ($req_fields as $field) {
			if (empty(trim($_POST[$field]))) {
				$errors[] = $field . ' is required';
			}
		}
		// checking max length
		$max_len_fields = array('role'=> 10, 'first_name' => 100, 'last_name' =>100, 'email' => 100, 'mobile_num'=> 10, 'gender'=> 6, 'password' => 40);
		foreach ($max_len_fields as $field => $max_len) {
			if (strlen(trim($_POST[$field])) > $max_len) {
				$errors[] = $field . ' must be less than ' . $max_len . ' characters';
			}
		}
		// checking email address
		if (!is_email($_POST['email'])) {
			$errors[] = 'Email address is invalid.';
		}
		//checking email address already exist
		$email = mysqli_real_escape_string($connection, $_POST['email']);
		$query = "SELECT * FROM customers WHERE email = '{$email}' LIMIT 1";
		$result_set = mysqli_query($connection, $query);
		if ($result_set) {
			if (mysqli_num_rows($result_set) == 1) {
				$errors[] = 'Email address already exists';
			}
		}
		//checking password  match
		if ($password !== $confirm) {
			$errors[] = 'Password did not match! try again.';
		}
		//send data to db
		if (empty($errors)) {
			//no any errors now we can add new user to db
			$first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
			$last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
			//email already sanitized
			$mobile_num = mysqli_real_escape_string($connection, $_POST['mobile_num']);
			$st_reg_num = mysqli_real_escape_string($connection, $_POST['st_reg_num']);
			$room_num = mysqli_real_escape_string($connection, $_POST['room_num']);
			$query = "INSERT INTO customers ( role, first_name, last_name, email, mobile_num, gender, st_reg_num, room_num, password, user_deleted ) VALUES ( '{$role}', '{$first_name}', '{$last_name}', '{$email}', {$mobile_num}, '{$gender}', '{$st_reg_num}', '{$room_num}', '{$password}', {$user_deleted} )";
			$result = mysqli_query($connection, $query);
			if ($result) {
				//query success! redirect to home page
				$_SESSION['first_name'] 	= $first_name;
				$_SESSION['email'] = $email;
				header('Location: index.php');
			} else {
				echo "Database query failed.";
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
		<title>Register</title>
		<?php include('inc/header-head.php') ?>
	</head>
	<body>
		<?php include('inc/header-body.php') ?>
		<div class="container border border-secondary rounded col-xl-6 col-lg-7 col-md-9 col-sm-11 col-xs mb-5 marginbottom-50">
			<div class="text-center mt-5">
				<h2>Create an account</h2>
			</div>
			<form action="register.php" method="post" enctype="multipart/form-data">
				
				
				<?php
				if (!empty($errors)) {
					echo '<div class="alert alert-danger" role="alert">';
												foreach ($errors as $error) {
													echo '- ' . $error . '<br>';
												}
					echo '</div>';
				}
				?>
				<div class="row">
					<div class="col-12">
						<label>Role :</label>
						<select class="custom-select" name="role" required>
							<option value="student" selected>Student</option>
							<option value="academic">Academic</option>
							<option value="non-academic">Non academic</option>
						</select>
					</div>
				</div>
				
				
				<div class="row">
					<div class="col-12">
						<label class="mt-2">Your name :</label>
						<input class="form-control" type="text"placeholder="Fast name" name="first_name" required <?php echo 'value="'.$first_name.'"'?>>
						<input class="form-control mt-2"type="text"placeholder="Last name" name="last_name" required <?php echo 'value="'.$last_name.'"'?>>
					</div>
				</div>
				
				<div class="row">
					<div class="col-12">
						<label class="mt-2">Email Address:</label>
						<input class="form-control" type="email" placeholder="example@email.com" name="email" required <?php echo 'value="'.$email.'"'?>>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<label class="mt-2">Mobile number :</label>
						<input class="form-control" type="tel" placeholder="0771234567" pattern="[0-9]{10}" name="mobile_num" required <?php echo 'value="'.$mobile_num.'"'?>>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<label class="mt-2">Gender :</label>
						<select class="custom-select" name="gender" required>
							<option value="male" selected>Male</option>
							<option value="female">Female</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<label class="mt-2">Index number :</label>
						<input class="form-control" type="text"placeholder="AMP/IT/2019/F/0000 (Optional)" name="st_reg_num" <?php echo 'value="'.$st_reg_num.'"'?>>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<label class="mt-2">Room number :</label>
						<input class="form-control" type="text"placeholder="Ex:GA1 (Optional)" name="room_num" <?php echo 'value="'.$room_num.'"'?>>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<label class="mt-2">Password :</label>
						<input class="form-control" id="password" type="password" placeholder="Password" name="password" required>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-12">
						<input class="form-control" id="confirmPassword" type="password" placeholder="Confirm password" name="confirm" required>
					</div>
				</div>
				<div class="row">
					<div class="col-12 text-center my-5">
						<button class="btn-success btn-lg my-3  px-5" type="submit" id="button" name="register" value="Register">Register</button>
					</div>
				</div>
				
			</div>
		</form>
		
	</body>
</html>
<?php mysqli_close($connection); ?>