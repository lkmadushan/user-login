<?php
include_once 'core/init.php';
looged_in_redirect();
if(empty($_POST) === false) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	if(empty($username) === true || empty($password) === true) {
		$errors[] = 'Username or password cannot be empty.';
	}
	else if(user_exists($username) === false) {
		$errors[] = 'We couldn\'t find that username. Have you registered?';
	}
	else if(user_active($username) === false) {
		$errors[] = 'You haven\'t activated your account!';
	}
	else {
		$login = login($username, $password);
		if($login === false) {
			$errors[] = 'That username or password is incorrect!';
		}
		else {
			$_SESSION['user_id'] = $login;
			header('Location: index.php');
			exit();
				}
	}
}
else {
	$errors[] = 'No data received.';
}
include_once 'include/overall/header.php';
if(empty($errors) === false):
?>
<div class="home">
	<h4>We tried to log you in, but...</h4>
	<?php
		output_error($errors);
	endif;
	?>
</div>
<?php include_once 'include/overall/footer.php'; ?>