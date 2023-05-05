<?php require_once('../inc/connection.php');
	$active = "customers";
	if (isset($_SESSION['seller_id'])) {
		$seller_id = $_SESSION['seller_id'];
	} else {
		echo("<script> window.location = 'login.php'; </script>");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Customers</title>
		<?php include('../inc/seller/header-head.php') ?>
	</head>
	<body>
		<?php include('../inc/seller/header-body.php') ?>
		<div class="container border border-secondary rounded col-xl-10 col-lg-10 col-md-9 col-sm-11 col-xs">
			<div class="text-center m-3">
				<h2>Customers</h2>
				<hr>
			</div>
			<form action="" method="post">
				<div class="row mt-5">
					<div class="col-12">
						<input class="form-control border-dark form-control-lg" id="inputdefault" name="search-box" type="text" placeholder="enter customer name or id" value="<?php if(isset($_POST['search'])) { echo $_POST['search-box'];} ?>">
					</div>
				</div>
				<div class="row mt-4">
					<div class="col-12 text-center">
						<input type="submit" class="col-10 btn-success btn-lg py-2 px-5 my-auto rounded" name="search" value="search">
					</div>
				</div>
			</form>
			<hr class="border-dark">			
			<div class="row mt-3">
				<div class="col-12">
					<div class="table table-responsive-lg">
						
						<table class="table table-striped table-hover">
							<thead class="text-center thead-dark my-auto">
								<th>Customer ID</th>
								<th>Name</th>
								<th>Gender</th>
								<th>Role</th>
								<th>Email</th>
								<th>Phone No.</th>
								<th>Reg. No.</th>
								<th>Room No.</th>
								<th>Account Balance</th>
							</thead>
							<?php 

							if (isset($_POST['search'])) {
								$query = "select * from customers WHERE id='{$_POST['search-box']}' || first_name LIKE '%{$_POST['search-box']}%' || last_name LIKE '%{$_POST['search-box']}%' order by id";
								$result = mysqli_query($connection,$query);
								if(mysqli_num_rows($result)>0){
									while($row = mysqli_fetch_array($result)){ ?>
									<?php include('../inc/seller/customertable.php') ?>
									<?php
									}
									}
							} else {

							$query = "select * from customers order by id";
							$result = mysqli_query($connection,$query);
							if(mysqli_num_rows($result)>0){
								while($row = mysqli_fetch_array($result)){ 
							?>
							<?php include('../inc/seller/customertable.php') ?>
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