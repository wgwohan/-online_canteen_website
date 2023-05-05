<?php require_once('../inc/seller/connection.php'); ?>
<?php
	$active = "customers";
	if (isset($_GET['customer'])) {
		$id = $_GET['customer_id'];
	
	// prepare database query
	$query = "SELECT * FROM customers WHERE id = '{$id}' LIMIT 1";
	$result_set = mysqli_query($connection, $query);
	/*verify_query($result_set);*/
	if (mysqli_num_rows($result_set) == 1) {
		// valid user found
		$user = mysqli_fetch_assoc($result_set);
		$id = $user['id'];
		$role = $user['role'];
		$email = $user['email'];
		$first_name = $user['first_name'];
		$last_name = $user['last_name'];
		$mobile_num = $user['mobile_num'];
		$gender = $user['gender'];
		$last_login = $user['last_login'];
		//add 5 hour and 30 minutes to time
		$cenvertedTime = date('Y-m-d H:i:s',strtotime('+5 hour +30 minutes',strtotime($last_login)));
		$acc_bal = $user['acc_bal'];
		$room_num = $user['room_num'];
		$_SESSION['img_dir'] = $user['img_dir'];
				$img_dir = $_SESSION['img_dir'];
		}
	}
		
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Customer Profile</title>
		<?php include('../inc/seller/header-head.php') ?>
	</head>
	<body>
		<?php include('../inc/seller/header-body.php') ?>
		<div class="container border border-secondary rounded col-xl-6 col-lg-8 col-md-10 col-sm-10 col-xs">
			<div class="row">
				<div class="col-12">
					<h4 class="m-3 text-center">Customer Profile</h4>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-12 text-center">
					<img class="img-thumbnail img-fluid w-25 rounded-circle" src="../<?php echo($img_dir) ?>" alt="Profile photo"><!--picture-->
				</div>
			</div>			
			<div class="row mt-3">
				<div class="col-5">
					<label>last loging</label>
				</div>
				<div class="col-7">
					<label>: <?php echo($cenvertedTime) ?></label>
				</div>
			</div>
			<div class="row">
				<div class="col-5">
					<label>Customer ID</label>
				</div>
				<div class="col-7">
					<label>: <?php echo($id) ?></label>
				</div>
			</div>
			<div class="row">
				<div class="col-5">
					<label>Room ID</label>
				</div>
				<div class="col-7">
					<label>: <?php echo($room_num) ?></label>
				</div>
			</div>
			<div class="row">
				<div class="col-5">
					<label>Name</label>
				</div>
				<div class="col-7">
					<textarea class="form-control w-100" disabled="">: <?php echo($first_name . ' ' . $last_name) ?></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-5">
					<label>Role</label>
				</div>
				<div class="col-7">
					<label>: <?php echo($role) ?></label>
				</div>
			</div>
			<div class="row">
				<div class="col-5">
					<label>Email address</label>
				</div>
				<div class="col-7">
					<textarea class="form-control w-100" disabled="">: <?php echo($email) ?></textarea class="w-100">
				</div>
			</div>
			<div class="row">
				<div class="col-5">
					<label>Mobile Number</label>
				</div>
				<div class="col-7">
					<label>: <?php echo($mobile_num) ?></label>
				</div>
			</div>
			<div class="row">
				<div class="col-5">
					<label>Gender</label>
				</div>
				<div class="col-7">
					<label>: <?php echo($gender) ?></label>
				</div>
			</div>
			<div class="row">
				<div class="col-5">
					<label>Account balance</label>
				</div>
				<div class="col-7">
					<label>: <?php echo($acc_bal) ?></label>
				</div>
			</div>
			<div class="row">
				<div class="col-5 my-auto">
					<label>Account Recharge</label>
				</div>
				<div class="col-7">
					<form action="customer_recharge.php" method="get">
						<button href="customer_recharge.php" type="submit" name="recharge" class="col-10 btn btn-success px-2 my-2 mx-auto" role="buton">Recharge</button>
						<input type="hidden" name="customer_id" value="<?php echo($id) ?>">
					</form>
				</div>
			</div>			
			<hr>			
		</body>
	</html>
	<?php mysqli_close($connection); ?>