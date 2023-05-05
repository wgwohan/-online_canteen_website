<?php 
	session_start();
	/*$connection = mysqli_connect('fdb33.awardspace.net', '3879903_canteen', 'Wohan@canteen_db2021', '3879903_canteen');*/
	$connection = mysqli_connect('localhost', 'root', '', 'canteen_db');

	// Checking the connection
	if (mysqli_connect_errno()) {
		die('Database connection failed ' . mysqli_connect_error());
	} /*else {
		echo "Connection succesful!";
	}*/
	
	/*Header parts*/

	if (!isset($_SESSION['email'])) {
		$img_dir = 'image/profile/000.png';
		
		if (isset($_POST['submit'])) {
			echo("<script>
    			window.location = 'login.php';
			</script>");
		}
	}
	else {
		$email = $_SESSION['email'];
	
		// prepare database query
		$query = "SELECT img_dir FROM customers WHERE email = '{$email}' LIMIT 1";
		$result_set = mysqli_query($connection, $query);
		if (mysqli_num_rows($result_set) == 1) {
			// valid user found
			$user = mysqli_fetch_assoc($result_set);
			$img_dir = $user['img_dir'];
			}
		if (isset($_POST['submit'])) {
						echo("<script>
    							window.location = 'Cprofile.php';
							</script>");
		}
		}
?>