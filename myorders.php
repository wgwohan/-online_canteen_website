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
		<div class="container border border-secondary rounded col-xl-9 col-lg-9 col-md-10 col-sm-10 col-xs mb-5">
			<div class="row">
				<div class="col-12">
					<h4 class="m-3 mt-5 text-center">My Orders</h4>
				</div>
			</div>
			<hr>
			<div class="row mt-3">
				<div class="col-12">
					<div class="table table-responsive-lg">
						

			<table class="table table-striped table-hover">
					<thead class="text-center thead-dark">
						<th>Date</th>
						<th>Product</th>
						<th>Price</th>
						<th>Order for</th>
						<th>Status</th>
					</thead>
			<?php $query = "select * from orders WHERE customer_id={$id} order by id DESC";
			$result = mysqli_query($connection,$query);
			if(mysqli_num_rows($result)>0){
				while($row = mysqli_fetch_array($result)){
					$order_id = $row['id'];
					

					// prepare database query for get the product name
					$query = "SELECT name FROM products WHERE id = {$row['product_id']} LIMIT 1";
					$result_set = mysqli_query($connection, $query);
						if (mysqli_num_rows($result_set) == 1) {						
							// valid seller found
							$product = mysqli_fetch_assoc($result_set);
							$product_name = $product['name'];
						}
					
					if ($row['status']=='pending') {
						$display_status = '<div class="text-secondary"><strong><u>'.$row['status'].'</u></strong></div>';

					} elseif ($row['status']=='completed') {
						$display_status = '<div class="text-success"><strong><u>'.$row['status'].'</u></strong></div>';
					} elseif ($row['status']=='rejected') {
						$display_status = '<div class="text-danger"><strong><u>'.$row['status'].'</u></strong></div>';
					}
					
					?>
					<tbody>
					<form action="order_details.php" method="get">
					<tr>
						<td><?php echo $row['date_time'];?></td>
						<td><form action="order_details.php" method="get">
						<button class="btn" type="submit" name="product"><?php echo $product_name;?></button><input type="hidden" name="order_id" value="<?php echo $order_id; ?>"></form></td>
						<td><?php echo $row['price'];?></td>
						<td><?php echo $row['order_time'];?></td>
						<td><?php echo $display_status;?></td>
						
					</tr>
										
					<?php
					}
					}
					?>
					</tbody>
				</table>
		
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
<?php mysqli_close($connection); ?>