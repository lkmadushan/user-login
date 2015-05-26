<?php
//create a session.
session_start();
//turn off error reporting
//error_reporting(0);

require_once 'database/config.php';
require_once 'function/general.php';
require_once 'function/user.php';

if(logged_in() === true) {
	$session_user_id = $_SESSION['user_id'];
	$user_data = user_data($session_user_id, 'user_id', 'username', 'password', 'first_name', 'last_name', 'email');

	if(user_active($user_data['username']) === false) {
		session_unset();
		session_destroy();
		header('Location: index.php');
		exit();
	}
}
$errors = array();
?>