<?php require_once('inc/connection.php');
$active = "cart";
/*print_r($_SESSION);*/
if(isset($_GET["action"])){
        if($_GET["action"] == "delete"){
            foreach($_SESSION["shopping_cart"] as $keys => $value){
                if($value["product_id"] == $_GET["id"]){
                    unset($_SESSION["shopping_cart"][$keys]);
                    echo '<script>window.location="cart.php"</script>';
                }
            }
        }
    }

if ((isset($_POST['buy'])) && (!empty($_SESSION["shopping_cart"]))) {

      foreach($_SESSION["shopping_cart"] as $key => $value){
        	
        $product_name = $value["product_name"];
        $product_quantity = $value["product_quantity"];
        $product_price = $value["product_price"];
        $seller_id = $_POST['seller_id'];
        $customer_id = $_SESSION['user_id'];

        // prepare database query for find the product id
		$query = "SELECT id FROM products WHERE name = '{$product_name}' LIMIT 1";
		$result_set = mysqli_query($connection, $query);
		/*verify_query($result_set);*/
		if (mysqli_num_rows($result_set) == 1) {
		// valid product found
		$row = mysqli_fetch_assoc($result_set);
		$product_id = $row['id'];
		}

		$order_time = $value["order_time"];
		$quantity = $value["product_quantity"];
		$price = $value["product_price"];
		$total_price = $price * $quantity;
		$payment_method = $_POST['payment_method'];

		$query = "INSERT INTO orders ( date_time, seller_id, customer_id, product_id, order_time, quantity, price, payment_method ) VALUES ( NOW(), {$seller_id}, {$customer_id}, {$product_id}, '{$order_time}', {$quantity}, {$total_price}, '{$payment_method}' )";
			$result = mysqli_query($connection, $query);
			if ($result) {
				//query success! refresh the page
				$successmsg 	= "success";
				unset($_SESSION["shopping_cart"]);				
			}
}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Shopping Cart</title>
		<?php include('inc/header-head.php') ?>
	</head>
	<body>
		<?php include('inc/header-body.php') ?>
		<div class="container border border-secondary rounded col-xl-6 col-lg-7 col-md-9 col-sm-11 col-xs">
			<div class="row">
				<div class="col-12 text-center my-3">
					<h2 class="headertext">Shopping Cart</h2>
				</div>
			</div>
			<hr>
			<?php
				if(isset($successmsg)) {
					echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Your order has been successfuly placed!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
			</div>';
				}
			?>
			<div class="alert alert-warning" role="alert">
				<h5>Attention!</h5>
				Before place the order make sure you have read the <a href="instructions.php" class="alert-link">instructions</a>. Otherwise you may have to face some troubles.
			</div>			
			<h3 class="title2">Shopping Cart Details</h3>
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr class="text-center">
						<th width="25%">Food name</th>
						<th width="10%">Qty</th>
						<th width="13%">Price Details</th>
						<th width="10%">Total Price</th>
						<th width="10%">Order For</th>
						<th width="12%">Remove Item</th>
					</tr>
					<?php
					if(!empty($_SESSION["shopping_cart"])){
					$total=0;
					foreach($_SESSION["shopping_cart"] as $key => $value){
					?>
					<tr>
						<td><?php echo $value["product_name"];?></td>
						<td><?php echo $value["product_quantity"];?></td>
						<td><?php echo $value["product_price"];?></td>
						<td><?php echo number_format($value["product_quantity"]*$value["product_price"],2);?></td>
						<td><?php echo $value["order_time"];?></td>
						<td><a href="cart.php?action=delete&id=<?php echo $value["product_id"]; ?>"><span class="text-danger">Remove Item</span></a></td>
					</tr>
					<?php
					$total = $total + ($value["product_quantity"]*$value["product_price"]);
					}
					?>
					<tr>
						<td colspan="3" align="right">Total</td>
						<td align="right"><?php echo number_format($total,2);?></td>
						<td></td>
					</tr>
					<?php
					}
					?>
				</table>
			</div>
			
			
			<form action="" method="post">
				<div class="row">
					<div class="col-12">
						<label>	Canteen </label>	<!--in-->
						<select class="form-control" name="seller_id" size="1" required>
							<option value="1">Hardy Canteen</option>
							<option value="2">Girls Hostel Canteen</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<label>	Payment method </label>	<!--in-->
						<select class="form-control" name="payment_method" size="1" required>
							<option value="acc">Account balance</option>
							<option value="coh">Cash on hand</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-12 text-center">
						<button class="btn-success btn-lg my-3 px-5" type="submit" id="button" name="buy">Order </button>
					</div>
				</div>
			</form>
			<hr>
			<div class="row">
				<a href="myorders.php" class="col-10 btn btn-warning px-5 my-3 mx-auto" role="buton">Check my orders		
				</a>
			</div>
		</div>
	</body>
</html>
<?php mysqli_close($connection); ?>