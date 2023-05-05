<?php require_once('../inc/connection.php');
	$active = "products";
	if (isset($_SESSION['seller_id'])) {
		$seller_id = $_SESSION['seller_id'];
	} else {
		echo("<script> window.location = 'login.php'; </script>");
	}

	if (isset($_POST['sw'])) {
		$product_id = $_POST['product_id'];
		$status = $_POST['switch'];
		if ($seller_id==1) {
			$query = "UPDATE products SET availability_1={$status} WHERE id={$product_id} LIMIT 1";
			$result = mysqli_query($connection,$query);
			if($result){
				//query success
			}
		} elseif ($seller_id==2) {
			$query = "UPDATE products SET availability_2={$status} WHERE id={$product_id} LIMIT 1";
			$result = mysqli_query($connection,$query);
			if($result){
				//query success
		}
	}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Products</title>
		<?php include('../inc/seller/header-head.php') ?>
	</head>
	<body>
		<?php include('../inc/seller/header-body.php') ?>
		<div class="container border border-secondary rounded col-xl-10 col-lg-10 col-md-9 col-sm-11 col-xs">
			<div class="text-center m-3">
				<h2>Products</h2>
				<hr>
			</div>
			<form action="" method="post">
				<div class="row mt-5">
					<div class="col-12">
						<input class="form-control border-dark form-control-lg" id="inputdefault" name="search-box" type="text" placeholder="enter product name or id" value="<?php if(isset($_POST['search'])) { echo $_POST['search-box'];} ?>">
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
								<th>Product ID</th>
								<th>Name</th>
								<th>Category</th>
								<th>Price</th>
								<th>Avalability</th>
							</thead>
							<?php 

							if (isset($_POST['search'])) {
								$query = "select * from products WHERE id='{$_POST['search-box']}' || name LIKE '%{$_POST['search-box']}%' order by id";
								$result = mysqli_query($connection,$query);
								if(mysqli_num_rows($result)>0){
									while($row = mysqli_fetch_array($result)){ ?>
									<?php include('../inc/seller/producttable.php') ?>
									<?php
									}
									}
							} else {

							$query = "select * from products order by id";
							$result = mysqli_query($connection,$query);
							if(mysqli_num_rows($result)>0){
								while($row = mysqli_fetch_array($result)){ 
							?>
							<?php include('../inc/seller/producttable.php') ?>
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