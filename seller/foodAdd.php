<?php require_once('../inc/seller/connection.php'); ?>
<?php 
	$active = "foodadd";
	if (!empty($_GET['status'])) {
		$status = $_GET['status'];
	}
	else {
		$status = 0;
	}
	if (isset($_POST['addfood'])) {
		
		$errors 		= array();

	//checking This food already exist
		$name = mysqli_real_escape_string($connection, $_POST['name']);
		$query = "SELECT * FROM products WHERE name = '{$name}' LIMIT 1";

		$result_set = mysqli_query($connection, $query);

		if ($result_set) {
			if (mysqli_num_rows($result_set) == 1) {
				$errors[] = 'This food already exists';
			}
		}

	//Add new food to db
		if (empty($errors)) {
		$name = mysqli_real_escape_string($connection, $_POST['name']);
		$price = mysqli_real_escape_string($connection, $_POST['price']);
		$category = mysqli_real_escape_string($connection, $_POST['category']);
		$description = mysqli_real_escape_string($connection, $_POST['description']);
		

		$query = "INSERT INTO products ( name, description, price, category ) VALUES ( '{$name}', '{$description}', '{$price}', '{$category}' ) ";

	$result = mysqli_query($connection, $query);

	if ($result) {
				//query success! redirect to home page
				$_SESSION['name'] 	= $name;				
				echo("<script> window.location = 'foodImageAdd.php'; </script>");
			} else {
				echo "Database query failed.";
			}
			
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Add new food</title>
		<?php include('../inc/seller/header-head.php') ?>
	</head>
	<body>
		<?php include('../inc/seller/header-body.php') ?>
		<div class="container border border-secondary rounded col-xl-7 col-lg-8 col-md-9 col-sm-11 col-xs">

		<div class="text-center m-3">
				<h2>Add new food</h2>
				<hr>
			</div>

		<form action="" method="post">
			<?php 
			if (!empty($status)) {
				echo '<div class="alert alert-success">Successfully entered added new food : ' .$_SESSION['name'] . '</div>';
			}
			if (!empty($errors)) {
				echo '<div class="alert alert-danger">';
				foreach ($errors as $error) {
					echo '- ' . $error . '<br>';
				}
				echo '</div>';
			}

		 	?> 	

		<div>
			<label class="mt-2">Food Name : </label><!--in-->
			<input class="form-control" type="text"placeholder="Food name" name="name" required><!--select-->
		</div>

		<div>
			<label class="mt-2">Food Description : </label><!--in-->
			<input class="form-control" type="text"placeholder="About the food" name="description"><!--select-->
		</div>

		<div>
			<label class="mt-2"> Price :</label><!--in-->
			<input class="form-control" type="number"placeholder="Rs 50.00" name="price" required><!--select-->
			
		</div>
		
		<div>
			<label class="mt-2"></label>
			<select class="form-control" name="category" style="width: 280px;"> 
				<option value="mainmeal">Main meal</option>
				<option value="shortmeal">Short meal</option>
			</select><!--meal-->
		</div>

		<div  class="text-center"><label class="in"></label>
		<button class="btn btn-success col-5 my-3" type="submit" id="button" name="addfood">Add Food</button><!--edit-->
		</div>

		</form>

		</div>

	</body>

</html>
<?php mysqli_close($connection); ?>