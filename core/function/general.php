<?php
function looged_in_redirect() {
	if(logged_in() === true) {
		header('Location: index.php');
		exit();
	}
}
function protect_page() {
	if(logged_in() === false) {
		header('Location: protected.php');
		exit();
	}
}
function array_sanitize(&$item) {
	//set accessing to the database connection inside the function
	global $con;
	$item = htmlentities(strip_tags(mysqli_real_escape_string($con, $item)));
}
function sanitize($data) {
	//set accessing to the database connection inside the function
	global $con;
	return htmlentities(strip_tags(mysqli_real_escape_string($con, $data)));
	//close the database connection
	mysqli_close($con);
}
function output_error($errors) {
	echo '<ul class="error"><li>' . implode('</li><li>', $errors) . '</li></ul>';
}
?>