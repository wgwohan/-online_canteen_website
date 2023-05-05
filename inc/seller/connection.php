<?php 
	session_start();
	/*$connection = mysqli_connect('fdb33.awardspace.net', '3879903_canteen', 'Wohan@canteen_db2021', '3879903_canteen');*/
	$connection = mysqli_connect('localhost', 'root', '', 'canteen_db');

	// mysqli_connect_errno(); mysqli_connect_error();

	// Checking the connection
	if (mysqli_connect_errno()) {
		die('Database connection failed ' . mysqli_connect_error());
	} /*else {
$connection = mysqli_connect('localhost', 'root', '', 'canteen_db');
		echo "Connection succesful!";
	}*/
	
	/*Header parts*/
?>