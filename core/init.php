<?php  
$dbName = 'tutorial';
$host = 'localhost';
$username = 'root';
$pass = '';

$connection  = mysqli_connect($host,$username,$pass,$dbName);

	if (mysqli_connect_errno()) {
		# code...
		echo "Failed to connect to MySQL: ".mysqli_connect_errno();
		exit();
	}


	session_start();
	require $_SERVER['DOCUMENT_ROOT'].'/E-COMM/config.php';
	require BASEURL.'helpers/helpers.php';

	$cartID = '';
	if(isset($COOKIE[CART_COOKIE]))
	{
		$cartID = sanitize($_COOKIE[CART_COOKIE]);
	}