<?php require_once('../inc/connection.php');
	$active = "orders";
	require_once('../inc/functions.php');
	if (isset($_SESSION['seller_id'])) {
		$seller_id = $_SESSION['seller_id'];
	} else {
		echo("<script> window.location = 'login.php'; </script>");
	}

	if (isset($_POST['completed'])) {
		$query = "UPDATE orders SET status='{$_POST['completed']}' WHERE id={$_POST['order_id']} LIMIT 1";
		$result = mysqli_query($connection, $query);
			
		 if ($_POST['payment_method']=='acc') {
		 	$query = "SELECT acc_bal FROM customers WHERE id={$_POST['customer_id']} LIMIT 1";
			$result_set = mysqli_query($connection, $query);
			verify_query($result_set);
			if (mysqli_num_rows($result_set) == 1) {
				$acc_bal = mysqli_fetch_assoc($result_set);
				$acc_ballance = $acc_bal['acc_bal'];
				$new_acc_ball = ($acc_ballance)-($_POST['price']);
				 
		$query = "UPDATE customers SET acc_bal={$new_acc_ball} WHERE id={$_POST['customer_id']} LIMIT 1";
		$update = mysqli_query($connection, $query);
			if ($update) {
				//query success! 
				}
			}

		$query = "SELECT acc_bal FROM sellers WHERE id={$seller_id} LIMIT 1";
			$result_set = mysqli_query($connection, $query);
			verify_query($result_set);
			if (mysqli_num_rows($result_set) == 1) {
				$acc_bal = mysqli_fetch_assoc($result_set);
				$acc_ballance = $acc_bal['acc_bal'];
				$new_acc_ball = ($acc_ballance)+($_POST['price']);
				 
		$query = "UPDATE sellers SET acc_bal={$new_acc_ball} WHERE id={$seller_id} LIMIT 1";
		$update = mysqli_query($connection, $query);
			if ($update) {
				//query success! redirect to home page
				$action_completed = 'Order successfuly';
		 }
		}

	} elseif(isset($_POST['rejected'])){
		$query = "UPDATE orders SET status='{$_POST['rejected']}' WHERE id={$_POST['order_id']} LIMIT 1";
		$result = mysqli_query($connection, $query);
		if ($result) {
			//query success! redirect to home page
			$action_rejected = 'Order has been rejected';
		}
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>All orders</title>
		<?php include('../inc/seller/header-head.php') ?>
	</head>
	<body>
		<?php include('../inc/seller/header-body.php') ?>
		<div class="container border border-secondary rounded col-xl-10 col-lg-10 col-md-9 col-sm-11 col-xs">
			<div class="text-center m-3">
				<h2>All orders</h2>
				<hr>
			</div>
			<form action="" method="post">
				<div class="row mt-5">
					<div class="col-6">
						<input class="form-control-lg border-dark w-100 my-auto" type="date" name="date" value="<?php if(isset($_POST['search'])) { echo $_POST['date'];} ?>" />
					</div>
					<div class="col-6">
						<input class="form-control border-dark form-control-lg" id="inputdefault" name="search-box" type="text" placeholder="enter customer ID" value="<?php if(isset($_POST['search'])) { echo $_POST['search-box'];} ?>">
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
								<th>Order Id</th>
								<th>Date</th>
								<th>Customer</th>
								<th>Product</th>
								<th>Qty</th>
								<th>Price</th>
								<th>Order for</th>
								<th>Payment Method</th>
								<th>Update</th>
							</thead>
							<?php 

							if (isset($_POST['search'])) {
								if (!empty($_POST['date'])) {
									if (!empty($_POST['search-box'])) {
										$query = "select * from orders WHERE seller_id={$seller_id} && date_time='{$_POST['date']}' && customer_id={$_POST['search-box']}  order by id DESC";
										$result = mysqli_query($connection,$query);
										if(mysqli_num_rows($result)>0){
											while($row = mysqli_fetch_array($result)){ ?> 
											<?php include('../inc/seller/allordertable.php') ?>
											<?php
											}
											}

									} elseif(empty($_POST['search-box'])) {
										$query = "select * from orders WHERE seller_id={$seller_id} && date_time='{$_POST['date']}' order by id DESC";
										$result = mysqli_query($connection,$query);
										if(mysqli_num_rows($result)>0){
											while($row = mysqli_fetch_array($result)){ ?> 
											<?php include('../inc/seller/allordertable.php') ?>
											<?php
											}
											}
									}

								} elseif (empty($_POST['date'])) {
									if (!empty($_POST['search-box'])) {
										$query = "select * from orders WHERE seller_id={$seller_id} && customer_id={$_POST['search-box']} order by id DESC";
										$result = mysqli_query($connection,$query);
										if($result){
											while($row = mysqli_fetch_array($result)){ ?> 
											<?php include('../inc/seller/allordertable.php') ?>
											<?php
											}
											}
									} elseif(empty($_POST['search-box'])) {
										$query = "select * from orders WHERE seller_id={$seller_id} order by id DESC";
										$result = mysqli_query($connection,$query);
										if($result){
											while($row = mysqli_fetch_array($result)){ ?> 
											<?php include('../inc/seller/allordertable.php') ?>
											<?php
											}
											}
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