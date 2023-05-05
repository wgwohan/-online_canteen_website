<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php
	$active = "profile";
	if ($_SESSION['email']) {
		$email = $_SESSION['email'];
	
	// prepare database query
	$query = "SELECT * FROM customers WHERE email = '{$email}' LIMIT 1";
	$result_set = mysqli_query($connection, $query);
	/*verify_query($result_set);*/
	if (mysqli_num_rows($result_set) == 1) {
		// valid user found
		$errors 		= array();
		$user = mysqli_fetch_assoc($result_set);
		$role = $user['role'];
		$first_name = $user['first_name'];
		$last_name = $user['last_name'];
		$mobile_num = $user['mobile_num'];
		$gender = $user['gender'];
		$st_reg_num = $user['st_reg_num'];
		$last_login = $user['last_login'];
		$acc_bal = $user['acc_bal'];
		$room_num = $user['room_num'];
		$_SESSION['img_dir'] = $user['img_dir'];
		$img_dir = $_SESSION['img_dir'];
						$password 		= '';
						$confirm		= '';
				$user_deleted	= '';
	if (isset($_POST['submit'])) {
				
				$first_name 	= $_POST['first_name'];
				$last_name 		= $_POST['last_name'];
				$mobile_num 	= $_POST['mobile_num'];
				$st_reg_num 	= $_POST['st_reg_num'];
						$room_num 		= $_POST['room_num'];
						$password 		= sha1($_POST['password']);
						$confirm		= sha1($_POST['confirm']);
				$user_deleted	= 0;
		// checking required fields
		$req_fields = array('first_name', 'last_name', 'mobile_num', 'password');
		foreach ($req_fields as $field) {
			if (empty(trim($_POST[$field]))) {
				$errors[] = $field . ' is required';
			}
		}
		// checking max length
		$max_len_fields = array('first_name' => 100, 'last_name' =>100, 'mobile_num'=> 10, 'password' => 40);
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
			$first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
			$last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
			$mobile_num = mysqli_real_escape_string($connection, $_POST['mobile_num']);
			$st_reg_num = mysqli_real_escape_string($connection, $_POST['st_reg_num']);
			$room_num = mysqli_real_escape_string($connection, $_POST['room_num']);
			$query = "UPDATE customers SET first_name='{$first_name}', last_name='{$last_name}', mobile_num={$mobile_num}, st_reg_num='{$st_reg_num}', room_num='{$room_num}', password='{$password}' WHERE email='$email' LIMIT 1";
			$result = mysqli_query($connection, $query);
			if ($result) {
				//query success! redirect to home page
				$_SESSION['first_name'] 	= $first_name;
				echo("<script>	window.location = 'index.php'; </script>");
			} else {
				echo "Database query failed.";
			}
		}
			}
		}
	}
	
	
	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Edit your profile</title>
		<?php include('inc/header-head.php') ?>
	</head>
	<body>
		<?php include('inc/header-body.php') ?>
		<div class="container border border-secondary rounded col-xl-6 col-lg-8 col-md-8 col-sm-10 col-xs">
			<div class="row">
				<div class="col-12">
					<h4 class="text-center mb-3 mt-3">Edit your account</h4>
				</div>
			</div>
			<form action="" method="post" enctype="multipart/form-data">
				<div class="row">
					<div class="col-12 text-center">
						<a href="CprofileImageAdd.php">
							<img class="img-thumbnail img-fluid w-25 rounded-circle" src="<?php echo($img_dir) ?>" alt="Profile photo"><!--picture-->
							<div class="text">Upload Image</div>
						</a>
					</div>
				</div>
				<div class="row mt-3 mb-2">
					<div class="col-5">
						<label>Room number :</label>
					</div>
					<div class="col-7">
						<input class="form-control" type="text"placeholder="Ex:GA1" name="room_num" value="<?php echo($room_num) ?>">
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-5">
						<label>First name :</label>
					</div>
					<div class="col-7">
						<input class="form-control" type="text"placeholder="Fast name" name="first_name" value="<?php echo($first_name) ?>">
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-5">
						<label>Last name :</label>
					</div>
					<div class="col-7">
						<input class="form-control"type="text"placeholder="Last name" name="last_name" value="<?php echo($last_name) ?>">
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-5">
						<label>Email Address:</label>
					</div>
					<div class="col-7">
						<input class="form-control" type="email" placeholder="example@email.com" name="email" value="<?php echo($email) ?>" disabled>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-5">
						<label>Mobile number :</label>
					</div>
					<div class="col-7">
						<input class="form-control" type="tel" placeholder="0771234567" name="mobile_num" value="<?php echo($mobile_num) ?>">
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-5">
						Gender :
					</div>
					<div class="col-7">
						<label class="form-control" name="gender" size="1" disabled><?php echo($gender) ?></label>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-5">
						Index number :
					</div>
					<div class="col-7">
						<input class="form-control" type="text"placeholder="AMP/IT/2019/F/0000 (Optional)" name="st_reg_num" value="<?php echo($st_reg_num) ?>" disabled>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-5">
						<label>Password :</label>
					</div>
					<div class="col-7">
						<input class="form-control" id="password" type="password" placeholder="Password" name="password" required>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-5">
						<label></label>
					</div>
					<div class="col-7">
						<input class="form-control" id="confirmPassword" type="password" placeholder="Confirm password" name="confirm" required>
					</div>
				</div>
				<div class="row mt-3">
					<div class="col-5">
						<label for=""></label>
					</div>
					<div class="col-7">
						<button class="btn-success px-3 py-2 mb-3" type="submit" id="button" name="submit" value="Register">Save Change</button>
					</div>
					
				</div>
				
				
				
				
				
				</div><!--class:inputs-->
				
				</div><!--class-backgroundacreate, create an account box background,Create an account.css-->
			</form>
			</div><!--class:form-->
			
		</body>
	</html>
	<?php mysqli_close($connection); ?>