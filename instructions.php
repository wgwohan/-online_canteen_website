<?php require_once('inc/connection.php');
		$active = "profile";?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Instructions</title>
	<?php include('inc/header-head.php') ?>
</head>
<body>
	<?php include('inc/header-body.php') ?>
	<div class="container border border-secondary rounded col-xl-6 col-lg-7 col-md-9 col-sm-11 col-xs alert-success">
		<div class="col-12">
			<h1 class="text-center mt-3">Keep in mind!</h1>
			<hr>
		</div>
		<div class="col-12">
			<ul>
				<li>If you have not a previous customer of Hardy canteen,</li>
				<ul><br>
					<li>For breakfast you can only order,</li>
					<ul>
						<li>Rice and curry - Vegitable</li>
						<li>String Hoppers</li>
						<li>Noddles</li>
					</ul><br>
					<li>For the lunch you can order,</li>
					<ul>
						<li>Rice and curry - Vegitable</li>
						<li>Rice and curry - Fish</li>
						<li>Rice and curry - Chiken</li>
					</ul><br>
					<li>For dinner you can order only if you're a hostel student. there are</li>
					<ul>
						<li>Rice and curry - Vegitable</li>
						<li>Rice and curry - Fish</li>
						<li>Rice and curry - Chiken</li>
						<li>Fried Rice</li>
						<li>Kottu (only from Girls hostel canteen)</li>
					</ul><br>
				</ul>
			</ul>
		</div>
	</div>
</body>
</html>
<?php mysqli_close($connection); ?>