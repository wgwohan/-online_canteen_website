<?php require_once('inc/connection.php'); ?>
<?php
	$active = "home";
	/*checking user logged or not*/
	if (!isset($_SESSION['email'])) {
		/*setting the profile image as default one*/
		$img_dir = 'image/profile/000.png';
		
		/*if user try to buy something without login, redirect to login page.*/
		if (isset($_POST['add'])) {
			echo("<script>
    			window.location = 'login.php';
			</script>");
		}
	}
	else {
		/*user logged in then*/
		$email = $_SESSION['email'];
	
		// prepare database query
		$query = "SELECT img_dir FROM customers WHERE email = '{$email}' LIMIT 1";
		$result_set = mysqli_query($connection, $query);
		if (mysqli_num_rows($result_set) == 1) {
			// valid user found
			$user = mysqli_fetch_assoc($result_set);
			$img_dir = $user['img_dir'];
			}		
		}

	if (isset($_POST['canteen'])) {
		$canteen = $_POST['canteen'];
	} else {
		$canteen = 1;
	}
	
	/*checking the user has pressed add to cart button or not.*/
	if(isset($_POST["add"])){
		if (!isset($_SESSION['email'])) {
			echo("<script>
    			window.location = 'login.php';
			</script>");
		} else {
        if(isset($_SESSION["shopping_cart"])){
            $item_array_id = array_column($_SESSION["shopping_cart"],"product_id");
            if(!in_array($_GET["id"],$item_array_id)){
                $count = count($_SESSION["shopping_cart"]);
                $item_array = array(
                    'product_id' => $_GET["id"],
                    'product_name' => $_POST["hidden_name"],
                    'product_price' => $_POST["hidden_price"],
                    'order_time' => $_POST["order_time"],
                    'product_quantity' => $_POST["quantity"],
                );
                $_SESSION["shopping_cart"][$count] = $item_array;
                echo '<script>window.location="index.php"</script>';
            }else{
                echo '<script>alert("Product is already in  the cart")</script>';
                echo '<script>window.location="index.php"</script>';
            }
        }else{
            $item_array = array(
                'product_id' => $_GET["id"],
                'product_name' => $_POST["hidden_name"],
                'product_price' => $_POST["hidden_price"],
                'order_time' => $_POST["order_time"],
                'product_quantity' => $_POST["quantity"],
            );
            $_SESSION["shopping_cart"][0] = $item_array;
        }
    }
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Canteen</title>
		<?php include('inc/header-head.php') ?>
	</head>
	<body>
		<?php include('inc/header-body.php') ?>
		<div class="container mt-5">
			
			<form action="index.php" method="post">				
				<div class="row text-center">
					<div class="col-12">
						<select class=" form-control form-control-lg mb-3" name="canteen">
							<option value="1" selected>Hardy Canteen</option>
							<option value="2">Girl's Hostel Canteen</option>
						</select>
					</div>
					<div class="col-12">
						<input class="form-control form-control-lg" id="inputdefault" name="search-box" type="text" placeholder="type here to search">
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<button type="submit" name="search" class="btn btn-success btn-lg float-right mt-1 px-3">Search</button>
					</div>
				</div>
			</form>
			<div class="row">
				<div class="col-12 mt-2">
					<h1>Main meals</h1>
				</div>
			</div>
			<div class="row text-center">
				<?php				
				if (!isset($_POST['search'])) {							
				$query = "select * from products WHERE category='mainmeal' && availability_1=1 order by id ASC";
				$result = mysqli_query($connection,$query);
				if(mysqli_num_rows($result)>0){
				while($row = mysqli_fetch_array($result)){
				?>				
				<?php include('inc/producttable.php') ?>
				<?php
				}
				}
				}

				elseif(isset($_POST['search'])){
					$keyword = $_POST['search-box'];

				  if(!empty($_POST['search-box'])) {

				  	if($_POST['canteen']==1) {					
					$query = "select * from products WHERE category='mainmeal' && availability_1=1 && name LIKE '%{$keyword}%' || category='mainmeal' && availability_1=1 && id='{$keyword}'  order by id ASC";
					$result = mysqli_query($connection,$query);
					if(mysqli_num_rows($result)>0){
					while($row = mysqli_fetch_array($result)){
				?>				
				<?php include('inc/producttable.php') ?>
				<?php
				}
				}
				}

				if($_POST['canteen']==2) {
					$query = "select * from products WHERE category='mainmeal' && availability_2=1 && name LIKE '%{$keyword}%' || category='mainmeal' && availability_2=1 && id='{$keyword}'  order by id ASC";
					$result = mysqli_query($connection,$query);
					if(mysqli_num_rows($result)>0){
					while($row = mysqli_fetch_array($result)){
				?>				
				<?php include('inc/producttable.php') ?>
				<?php
				}
				}
				}
				}

				if(empty($_POST['search-box'])) {
				if($_POST['canteen']==1) {
					$query = "select * from products WHERE category='mainmeal' && availability_1=1 order by id ASC";
					$result = mysqli_query($connection,$query);
					if(mysqli_num_rows($result)>0){
					while($row = mysqli_fetch_array($result)){
				?>				
				<?php include('inc/producttable.php') ?>
				<?php
				}
				}
				}

				if($_POST['canteen']==2) {
					$query = "select * from products WHERE category='mainmeal' && availability_2=1 order by id ASC";
					$result = mysqli_query($connection,$query);
					if(mysqli_num_rows($result)>0){
					while($row = mysqli_fetch_array($result)){
				?>				
				<?php include('inc/producttable.php') ?>
				<?php
				}
				}
				}
				}
				}
				?>
			</div>
			<div class="row mt-5">
				<div class="col-12 mt-2">
					<h1>Short meals</h1>
				</div>
			</div>
			<div class="row text-center">
				<?php				
				if (!isset($_POST['search'])) {							
				$query = "select * from products WHERE category='shortmeal' && availability_1=1 order by id ASC";
				$result = mysqli_query($connection,$query);
				if(mysqli_num_rows($result)>0){
				while($row = mysqli_fetch_array($result)){
				?>				
				<?php include('inc/producttable.php') ?>
				<?php
				}
				}
				}

				elseif(isset($_POST['search'])){
					$keyword = mysqli_real_escape_string($connection, $_POST['search-box']);

				  if(!empty($_POST['search-box'])) {
				  	if($_POST['canteen']==1) {
					$query = "select * from products WHERE category='shortmeal' && availability_1=1 && name LIKE '%{$keyword}%' || category='shortmeal' && availability_1=1 && id='{$keyword}'  order by id ASC";
					$result = mysqli_query($connection,$query);
					if(mysqli_num_rows($result)>0){
					while($row = mysqli_fetch_array($result)){
				?>				
				<?php include('inc/producttable.php') ?>
				<?php
				}
				}
				}

				if($_POST['canteen']==2) {
					$query = "select * from products WHERE category='shortmeal' && availability_2=1 && name LIKE '%{$keyword}%' || category='shortmeal' && availability_2=1 && id='{$keyword}'  order by id ASC";
					$result = mysqli_query($connection,$query);
					if(mysqli_num_rows($result)>0){
					while($row = mysqli_fetch_array($result)){
				?>				
				<?php include('inc/producttable.php') ?>
				<?php
				}
				}
				}
				}

				if(empty($_POST['search-box'])) {
				if($_POST['canteen']==1) {
					$query = "select * from products WHERE category='shortmeal' && availability_1=1 order by id ASC";
					$result = mysqli_query($connection,$query);
					if(mysqli_num_rows($result)>0){
					while($row = mysqli_fetch_array($result)){
				?>				
				<?php include('inc/producttable.php') ?>
				<?php
				}
				}
				}

				if($_POST['canteen']==2) {
					$query = "select * from products WHERE category='shortmeal' && availability_2=1 order by id ASC";
					$result = mysqli_query($connection,$query);
					if(mysqli_num_rows($result)>0){
					while($row = mysqli_fetch_array($result)){
				?>				
				<?php include('inc/producttable.php') ?>
				<?php
				}
				}
				}
				}
				}
				?>
			</div>
			<div class="footer mb-5">
				<h3></h3>
			</div>
		</div>
		
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<script type="text/javascript" src="js/jquery.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@17.4.0/dist/lazyload.min.js"></script>
		<script>
			const myLazyLoad = new LazyLoad({
				elements_selector: ".card-img-top"
			})
		</script>
	</body>
</html>
<?php mysqli_close($connection); ?>