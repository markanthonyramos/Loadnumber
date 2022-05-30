<?php
	$server = 'localhost';
	$dbUsername = 'id15035716_root';
	$dbPassword = 'XCo{*{]iJox{\5zx';
	$dbName = 'id15035716_load_numbers_db';

	$dbConnect = mysqli_connect($server, $dbUsername, $dbPassword, $dbName);

	if (!$dbConnect) {
			echo 'Error at Database Connection';
	}