<?php require_once('inc/connection.php'); ?>
<?php 
	$find_email = $_SESSION['find_email'];
?>

<?php 
	$query = "SELECT img_dir FROM customers WHERE email = '{$find_email}'";
	$result_set = mysqli_query($connection, $query);

	if($result_set) {
		$record = mysqli_fetch_assoc($result_set);
		$find_img_dir = $record['img_dir'];		
	} else {
		echo 'image not found';
	}
?>

<?php 


	//Import PHPMailer classes into the global namespace
		//These must be at the top of your script, not inside a function
		use PHPMailer\PHPMailer\PHPMailer;
		use PHPMailer\PHPMailer\SMTP;
		use PHPMailer\PHPMailer\Exception;

	if ( isset($_POST['reset'])) {	
		
		$otp = rand(999,10000);
		$_SESSION['otp'] = $otp;
		$query = "UPDATE customers SET otp={$otp} WHERE email='{$find_email}' LIMIT 1";
		$result = mysqli_query($connection, $query);
			if ($result) {
				//query success! 
			}

		$email_body = '<div style="width: 80%; border-style: solid; border-width: 4px; border-radius: 10px; margin: auto; padding-bottom: 20px; font-family: sans-serif;">
			<center><img src="https://i.ibb.co/XFV5KZq/android-chrome-192x192.png" alt="logo"></center>
			<p style="text-align:justify; margin-left: 10px; margin-right: 10px;">Hello dear customer, <br><br>
				It seems like you have requested password reset for "Hardy canteen" customer account. <br><br><b>Is not that you, Please skip this message</b> and do not share this message with anyone! <br><br>
				Is that you, Here is your verification code.
			Copy & enter this verification code on the website</p><br>
			<div style="background-color: #000; padding: 2px; width: 100%; text-align: center;"><h3 style="color: #fff;">'.$otp.'</h3>				
			</div>
			<br>
			<p style="margin-left: 10px; margin-right: 10px;">Thank you!<br><br>
				Team Hardy Canteen.</p>
		
		<br>
		<p style="margin-left: 10px; margin-right: 10px;"><b>This is an automatically generated email. Do not reply!</b></p>
		</div>';

		require 'PHPMailer/src/Exception.php';
		require 'PHPMailer/src/PHPMailer.php';
		require 'PHPMailer/src/SMTP.php';

		//Create an instance; passing `true` enables exceptions
		$mail = new PHPMailer(true);

		try {
		    //Server settings
		    $mail->SMTPDebug = SMTP::DEBUG_SERVER;              //Enable verbose debug output
		    $mail->isSMTP();                                    //Send using SMTP
		    $mail->Host       = 'smtp.gmail.com';             //Set the SMTP server to send through
		    $mail->SMTPAuth   = true;                           //Enable SMTP authentication
		    $mail->Username   = 'chamarawohan@gmail.com';             //SMTP username
		    $mail->Password   = 'wohan@2020';                       //SMTP password
		    $mail->SMTPSecure = 'tls';    //Enable implicit TLS encryption
		    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

		    //Recipients
		    $mail->setFrom('chamarawohan@gmail.com', 'Hardy Canteen');
		    $mail->addAddress($find_email);     //Add a recipient             //Name is optional
		    $mail->addReplyTo('chamarawohan@gmail.com', 'No-Reply');

		    //Content
		    $mail->isHTML(true);                                  //Set email format to HTML
		    $mail->Subject = 'Your password reset code';
		    $mail->Body    = $email_body;
		    $mail->AltBody = $email_body;

		    $mail->send();
		    echo("<script>window.location = 'verify.php';</script>");
		} catch (Exception $e) {
		    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}

	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Reset your account password</title>
		<?php include('inc/header-head.php') ?>
	</head>
	<body>
		<?php include('inc/header-body.php') ?>
		<div class="container border border-secondary rounded col-xl-6 col-lg-7 col-md-9 col-sm-11 col-xs">
			
			<div class="row">
				<div class="col-12 text-center mt-3">
					<h2>Reset your password</h2>
				</div>
			</div>
			<form action="reset_pw.php" method="post">				
				<div class="row text-center mt-4">
					<div class="col-12 text-primary">
						<b><?php echo $find_email ?></b>
					</div>
				</div>
				<div class="row text-center">
					<div class="col-12">Please press countinue to get your verification code to above Email address?
					</div>
				</div>
				<div class="row">
					<div class="col-12 text-center mt-3">
						<img class="border border-secondary" style="width: 80px; height: 80px; border-radius: 20px;" src="<?php echo $find_img_dir ?>" alt="Your profile photo">
					</div>
				</div>
				<div class="row text-center my-5">
					<div class="col-6">
						<a href="find_acccount.php">
							<input class="btn-warning btn-lg rounded" type="submit" value="Not you?"></input>
						</a>
					</div>
					<div class="col-6">
						<input class="btn-success btn-lg rounded" type="submit" name="reset"></input>
					</div> 
				</div>
										
				</div>
				
			</form>
			</div>
		</body>
	</html>
	<?php mysqli_close($connection); ?>