<?php
	require_once('inc/connection.php');
	$active = "profile";
	$email = $_SESSION['find_email'];
	$otp = $_SESSION['otp'];

	$query = "SELECT otp FROM customers WHERE email = '{$email}'";
	$result_set = mysqli_query($connection, $query);
	if($result_set) {
		$record = mysqli_fetch_assoc($result_set);
		$cus_otp = $record['otp'];

	} else {
		$error = "query failed!";
	}

	if(isset($_POST['verify'])) {
		if ($cus_otp == $otp) {
			$_SESSION['auth'] = "true";
			echo("<script>window.location = 'change_pw.php';</script>");

		} else {
			$error = "OTP is not matching!";
		}
		
	}	
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Enter Verification code</title>
		<?php include('inc/header-head.php') ?>
	</head>
	<body>
		<?php include('inc/header-body.php') ?>
		<div class="container border border-secondary rounded col-xl-6 col-lg-7 col-md-9 col-sm-11 col-xs">			
			
			<div class="row">
				<div class="col-12 text-center my-3">
					<h2 class="headertext">Enter Verification code</h2>
				</div>
			</div>
			<form action="verify.php" method="post">
			<div class="row">
				<div class="col-12">
					Please check your email for a message with your 4 digits verification code.
				</div>
			</div>
			<div class="row">
				<div class="col-12 mt-3">
					<p>If you can't see the verification mail on your Inbox. Please check on <b>spam</b> folder also.</p>
				</div>
			</div>
			
				<?php
					if (isset($error)) {
						echo '<div class="alert alert-danger" role="alert">OTP is not matching!</div>';
					}
				?>
				<div class="row">
					<div class="col-12">
						<input class="form-control" type="text"placeholder="Enter code here" name="otp"> 
					</div>

				 	<div class="col-12 text-center mt-3">
						We've sent your verification code to
						<b><h6 class="text-primary"><?php if($email) { echo "$email"; }  else { echo "Your Email"; }?>							
						</h6></b>
					</div>
				</div>
				<div class="row">
					<div class="col-12 text-center">
						<input class="btn-success btn-lg my-3 px-5" type="submit" value="verify" name="verify"></input>
					</div>
				</div>

			</form>
			</div><!--class:header-->
		</div><!--class:form-->
	</body>

</html>
<?php mysqli_close($connection); ?>