<?php require_once('inc/connection.php'); ?>

<!DOCTYPE html>
<html>
	<head>
		<title>404</title>
		<?php include('inc/header-head.php') ?>
	</head>
	<body>
		<?php include('inc/header-body.php') ?>
		<div class="container">
			<div class="row">
				<div class="col-6">
					<img class="img-thumbnail" src="image/404.png" alt="not found">
				</div>
				<div class="col-6 text-center my-auto">
					<h1>It's not here!</h1>
					<br>
					<h4>Please visit to home page.</h4>
				</div>
			</div>
		</div>
	</body>
</html>
<?php mysqli_close($connection); ?>