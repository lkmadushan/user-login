<?php
function update_user($update_data) {
	//set accessing to the database connection inside the function
	global $con;

	global $session_user_id;

	$update = array();

	array_walk($update_data, 'array_sanitize');

	foreach($update_data as $field => $data) {
		$update[] = '`' . $field . '` = \'' . $data . '\'';
	}

	mysqli_query($con, "UPDATE `user` SET " . implode(', ', $update) . " WHERE `user_id` = $session_user_id");

	//close database connection
	mysqli_close($con);
}
function activate($email, $email_code) {
	//set accessing to the database connection inside the function
	global $con;

	$email = sanitize($email);
	$email_code = sanitize($email_code);

	$query = mysqli_query($con, "SELECT `user_id` FROM `user` WHERE `email` = '$email' AND `email_code` = '$email_code' AND `active` = 0");

	if(mysqli_num_rows($query) === 1) {
		mysqli_query($con, "UPDATE `user` SET `active` = 1 WHERE `email` = '$email' AND `email_code` = '$email_code' AND `active` = 0");
		return true;
	}
	else {
		return false;
	}
	//free result set
	mysqli_free_result($query);
	//close database connection
	mysqli_close($con);
}
function email($to, $subject, $body) {
	mail($to, $subject, $body, 'From: admin@domain.com');
}
function change_password($user_id, $password) {
	//set accessing to the database connection inside the function
	global $con;
	$user_id = (int)$user_id;
	$password = md5($password);
	mysqli_query($con, "UPDATE `user` SET `password` = '$password' WHERE `user_id` = $user_id");
	//close database connection
	mysqli_close($con);
}
function register_user($register_data) {
	//set accessing to the database connection inside the function
	global $con;
	array_walk($register_data, 'array_sanitize');
	$register_data['password'] = md5($register_data['password']);
	
	$fields = '`' . implode('`, `', array_keys($register_data)) . '`';
	$data = '\'' . implode('\', \'', $register_data) . '\'';
	mysqli_query($con, "INSERT INTO `user` ($fields) VALUES ($data)");	
	//send an email to new user
	email($register_data['email'], 'Activate your account', "Hello ". $register_data['first_name'] .",\n\nYou need to activate your account, so use the link below:\n\nhttp://localhost/development/activate.php?email=" . $register_data['email'] ."&email_code=" . $register_data['email_code'] ."\n\n- company");
	//close database connection
	mysqli_close($con);
}
function user_count() {
	//set accessing to the database connection inside the function
	global $con;
	$query = mysqli_query($con, "SELECT COUNT(`user_id`) FROM `user` WHERE `active` = 1");
	$row = mysqli_fetch_row($query);
	return $row[0];
	//free result set
	mysqli_free_result($query);
	//close database connection
	mysqli_close($con);
}
function user_data($user_id) {
	//set accessing to the database connection inside the function
	global $con;
	$data = array();
	$user_id = (int)$user_id;
	$func_num_args = func_num_args();
	$func_get_args = func_get_args();
	if($func_num_args > 1) {
		unset($func_get_args[0]);
		$fields = '`' . implode('`, `', $func_get_args) . '`'; //`val1`, `val2`, `val3`;
		$query = mysqli_query($con, "SELECT $fields FROM `user` WHERE `user_id` = $user_id");
		$data = mysqli_fetch_assoc($query);
		return $data;
	}
	//free result set
	mysqli_free_result($query);
	//close database connection
	mysqli_close($con);
}
function logged_in() {
	return(isset($_SESSION['user_id']) === true && empty($_SESSION['user_id']) === false) ? true : false;
}
function user_exists($username) {
	//set accessing to the database connection inside the function
	global $con;
	$username = sanitize($username);
	$query = mysqli_query($con, "SELECT `user_id` FROM `user` WHERE `username` = '$username'");
	return(mysqli_num_rows($query) === 1) ? true : false;
	//free result set
	mysqli_free_result($query);
	//close database connection
	mysqli_close($con);
}
function email_exists($email) {
	//set accessing to the database connection inside the function
	global $con;
	$email = sanitize($email);
	$query = mysqli_query($con, "SELECT `user_id` FROM `user` WHERE `email` = '$email'");
	return(mysqli_num_rows($query) === 1) ? true : false;
	//free result set
	mysqli_free_result($query);
	//close database connection
	mysqli_close($con);
}
function user_active($username) {
	//set accessing to the database connection inside the function
	global $con;
	$username = sanitize($username);
	$query = mysqli_query($con, "SELECT `user_id` FROM `user` WHERE `username` = '$username' AND active = 1");
	return(mysqli_num_rows($query) === 1) ? true : false;
	//free result set
	mysqli_free_result($query);
	//close database connection
	mysqli_close($con);
}
function user_id_from_username($username) {
	//set accessing to the database connection inside the function
	global $con;
	$username = sanitize($username);
	$query = mysqli_query($con, "SELECT `user_id` FROM `user` WHERE `username` = '$username'");
	$row = mysqli_fetch_assoc($query);
	return($row['user_id']);
	//free result set
	mysqli_free_result($query);
	//close database connection
	mysqli_close($con);
}
function login($username, $password) {
	//set accessing to the database connection inside the function
	global $con;
	$user_id = user_id_from_username($username);
	$username = sanitize($username);
	$password = md5($password);
	$query = mysqli_query($con, "SELECT `user_id` FROM `user` WHERE `username` = '$username' AND `password` = '$password'");
	return(mysqli_num_rows($query) === 1) ? $user_id : false;
	//free result set
	mysqli_free_result($query);
	//close database connection
	mysqli_close($con);
}
?>