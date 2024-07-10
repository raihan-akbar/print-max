<?php

// db creds info
$host = '127.0.0.1';
$username = 'root';
$password = '';
$name = 'print-max';

// connect sys -to-> database
$con = mysqli_connect($host, $username, $password, $name);

if ( mysqli_connect_errno() ) {
	// error check
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
