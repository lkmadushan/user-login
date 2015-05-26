<?php
//database connection details
$dbhost = '127.0.0.1';
$dbuser = 'root';
$dbpass = '';
$dbname = 'development';

//connect with database
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

//error handling
if(mysqli_connect_errno() === true) {
	echo 'Sorry, we\'re expreiencing connection problems.';
	exit();
}
?>