<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "demo-product-19php03";

	// tạo kết nối:
	$con = new mysqli($servername, $username, $password, $database);
	// kiểm tra kết nối:
	if ($con->connect_error) {
		die("connection failed: " . $con->connect_error);
	}

	// echo "Connected successfully";

?>