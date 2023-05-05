<?php require_once('inc/connection.php');
$active = "cart"; 
if (!isset($_SESSION['user_id'])) {
	echo("<script> window.location = 'login.php'; </script>");
}
$id = $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>My Orders</title>
		<?php include('inc/header-head.php') ?>
	</head>
	<body>
		<?php include('inc/header-body.php') ?>
		<div class="container border border-secondary rounded col-xl-6 col-lg-7 col-md-9 col-sm-11 col-xs">
			<div class="row">
				<div class="col-12">
					<h4 class="m-3 mt-5 text-center">Order Details</h4>
				</div>
			</div>
			<hr>
			
			<div class="row mt-3">
				<div class="col-12">
					<div class="table table-responsive-lg">				
						
							<?php
							if (isset($_GET['product'])) {
								$order_id = $_GET['order_id'];
								$query = "SELECT * from orders WHERE customer_id={$id} && id={$order_id} LIMIT 1";
								$result = mysqli_query($connection,$query);
								if(mysqli_num_rows($result) == 1){
													$row = mysqli_fetch_array($result);
										// prepare database query for get the seller name
										$query = "SELECT first_name, last_name FROM sellers WHERE id = {$row['seller_id']} LIMIT 1";
										$result_set = mysqli_query($connection, $query);
												if (mysqli_num_rows($result_set) == 1) {
												// valid seller found
												$order = mysqli_fetch_assoc($result_set);
												$first_name = $order['first_name'];
												$last_name = $order['last_name'];
												}
										// prepare database query for get the product name
										$query = "SELECT name, img_dir FROM products WHERE id = {$row['product_id']} LIMIT 1";
										$result_set = mysqli_query($connection, $query);
										if (mysqli_num_rows($result_set) == 1) {
										// valid seller found
										$product = mysqli_fetch_assoc($result_set);
										$product_name = $product['name'];
										$product_img = $product['img_dir'];
										}
												
										if ($row['payment_method'] == 'acc') {
										$acc = 'Account Balance';
										} elseif ($payment_method == 'coh') {
										$acc = 'Cash On Hand';
										}
										if ($row['status']=='pending') {
											$display_status = '<div class="text-secondary"><strong><u>'.$row['status'].'</u></strong></div>';
										} elseif ($row['status']=='completed') {
											$display_status = '<div class="text-success"><strong><u>'.$row['status'].'</u></strong></div>';
										} elseif ($row['status']=='rejected') {
											$display_status = '<div class="text-danger"><strong><u>'.$row['status'].'</u></strong></div>';
													}
							 }} ?>
						<div class="row text-center mx-1 p-0">
							<div class="col-12 bg-dark text-white py-3 px-0">
								<h5>Product</h5>
							</div>							
						</div>
						<div class="row mx-1 text-center my-2">
							<div class="col-6 mx-auto text-center">
								<img style="border-radius: 20px;" class="img-fluid img-thumbnail w-75" src="<?php echo $product_img; ?>" alt="Product Image">
							</div>							
						</div>
						<div class="row">
							<div class="col-12 text-center">
								<h5 class="my-2"><?php echo $product_name;?></h5>
							</div>
						</div>
						<div class="row mt-3">
							<div class="col-6 my-auto">
							<label for="order_id"><h5>Order Id</h5></label>							
						</div>
							<div class="col-6 my-auto">
								<labe><?php echo $row['id'];?></labe>
							</div>						
						</div>
						<div class="row mt-3">
							<div class="col-6 my-auto">
							<label for="order_id"><h5>Status</h5></label>							
						</div>
							<div class="col-6 my-auto">
								<labe><?php echo $display_status;?></labe>
							</div>						
						</div>
						<div class="row mt-2">
							<div class="col-6 my-auto">
							<label for="order_id"><h5>Date</h5></label>							
						</div>
							<div class="col-6 my-auto">
								<labe><?php echo $row['date_time'];?></labe>
							</div>						
						</div>
						<div class="row mt-2">
							<div class="col-6 my-auto">
							<label for="order_id"><h5>Seller</h5></label>							
						</div>
							<div class="col-6 my-auto">
								<labe><?php echo $first_name.' '.$last_name;?></labe>
							</div>						
						</div>
						<div class="row mt-2">
							<div class="col-6 my-auto">
							<label for="order_id"><h5>Quantity</h5></label>							
						</div>
							<div class="col-6 my-auto">
								<labe><?php echo $row['quantity'];?></labe>
							</div>						
						</div>
						<div class="row mt-2">
							<div class="col-6 my-auto">
							<label for="order_id"><h5>Price</h5></label>							
						</div>
							<div class="col-6 my-auto">
								<labe><?php echo $row['price'];?></labe>
							</div>						
						</div>
						<div class="row mt-2">
							<div class="col-6 my-auto">
							<label for="order_id"><h5>Order for</h5></label>							
						</div>
							<div class="col-6 my-auto">
								<labe><?php echo $row['order_time'];?></labe>
							</div>						
						</div>
						<div class="row mt-2">
							<div class="col-6 my-auto">
							<label for="order_id"><h5>Payment Method</h5></label>							
						</div>
							<div class="col-6 my-auto">
								<labe><?php echo $acc;?></labe>
							</div>						
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
<?php mysqli_close($connection); ?>