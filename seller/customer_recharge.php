<?php require_once('../inc/connection.php');
	$active = "recharge";
	if (isset($_SESSION['seller_id'])) {
		$seller_id = $_SESSION['seller_id'];
	} else {
		echo("<script> window.location = 'login.php'; </script>");
	}

	if (isset($_GET['customer_id'])) {
		$customer_id = $_GET['customer_id'];
	} elseif (isset($_POST['search'])) {
		$customer_id = $_POST['search-box'];
	}

	if (isset($_POST['save'])) {
		$query = "select * from customers WHERE id={$_POST['customer_id']} order by id";
		$result = mysqli_query($connection,$query);
		if(mysqli_num_rows($result)>0){
			$customer = mysqli_fetch_array($result);
			$acc_bal = $customer['acc_bal'];
			$new_acc_bal = $acc_bal+$_POST['recharge'];

			$query = "UPDATE customers SET acc_bal={$new_acc_bal} WHERE id={$_POST['customer_id']} LIMIT 1";
			$result = mysqli_query($connection,$query);
			if($result){
				$successmsg = "recharge successful!";
			}
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Recharge</title>
		<?php include('../inc/seller/header-head.php') ?>
	</head>
	<body>
		<?php include('../inc/seller/header-body.php') ?>
		<div class="container border border-secondary rounded col-xl-10 col-lg-10 col-md-9 col-sm-11 col-xs">
			<div class="text-center m-3">
				<h2>Recharge</h2>
				<hr>
			</div>
			<?php
				if(isset($successmsg)) {
					echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Account Recharge successful!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
			</div>';
				}?>
			<form action="" method="post">
				<div class="row mt-5">
					<div class="col-12">
						<input class="form-control border-dark form-control-lg" id="inputdefault" name="search-box" type="text" placeholder="enter customer name or id" value="<?php if(isset($_POST['search'])) { echo $_POST['search-box'];}?>">
					</div>
				</div>
				<div class="row mt-4">
					<div class="col-12 text-center">
						<input type="submit" class="col-10 btn-success btn-lg py-2 px-5 my-auto rounded" name="search" value="search">
					</div>
				</div>
			</form>
			<hr class="border-dark">
			<?php
				if(isset($action_completed)) {
					echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Order has been successfuly delivered!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
			</div>';
				} elseif(isset($action_rejected)) {
					echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>An order has been rejected!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
			</div>';
				}
			?>
			<div class="row mt-3">
				<div class="col-12">
					<div class="table table-responsive-lg">
						
						<table class="table table-striped table-hover">
							<thead class="text-center thead-dark my-auto">
								<th>Customer ID</th>
								<th>Name</th>
								<th>Profile Image</th>
								<th>Email</th>
								<th>Phone No.</th>
								<th>Current Balance</th>
								<th>Recharge Amount</th>
								<th>Save</th>
							</thead>
							<?php 

							if (isset($_POST['search'])) {
								$query = "select * from customers WHERE id='{$_POST['search-box']}' || first_name LIKE '%{$_POST['search-box']}%' || last_name LIKE '%{$_POST['search-box']}%' LIMIT 1";
								$result = mysqli_query($connection,$query);
								if(mysqli_num_rows($result)>0){
									while($row = mysqli_fetch_array($result)){ ?>
									<?php include('../inc/seller/customer_recharge_table.php') ?>
									<?php
									}
									}
							} elseif (isset($_GET['recharge'])) {
								$query = "select * from customers WHERE id='{$_GET['customer_id']}' LIMIT 1";
								$result = mysqli_query($connection,$query);
								if(mysqli_num_rows($result)>0){
									while($row = mysqli_fetch_array($result)){ ?>
									<?php include('../inc/seller/customer_recharge_table.php') ?>
									<?php
									}
									}
							}
								?>							
							</tbody>
						</table>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<?php mysqli_close($connection); ?>