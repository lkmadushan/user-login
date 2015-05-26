<?php
include_once 'core/init.php';
looged_in_redirect();
include_once 'include/overall/header.php';
if(empty($_POST) === false) {
	$required_fields = array('username', 'password', 'password_again', 'first_name', 'email');
	foreach($_POST as $key => $value) {
		if(empty($value) === true && in_array($key, $required_fields) === true) {
			$errors[] = 'Fields mark with an astersik are required.';
			break 1;
		}
	}
	if(empty($errors) === true) {
		if(user_exists($_POST['username']) === true) {
			$errors[] = 'Sorry, the username \'' . $_POST['username'] . '\' is already taken.';
		}
		if (preg_match('/\\s/', $_POST['username']) === 1) {
			$errors[] = 'Your username must not contain any spaces.';
		}
		if(strlen($_POST['password']) < 6) {
			$errors[] = 'Your password must be at least 6 characters.';
		}
		if($_POST['password'] !== $_POST['password_again']) {
			$errors[] = 'Your passwords do not match.';
		}
		if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
			$errors[] = 'A valid email address is required.';
		}
		if(email_exists($_POST['email']) === true) {
			$errors[] = 'Sorry, the email \'' . $_POST['email'] . '\' is already in use.';
		}
	}
}
?>
<div class="home">
	<h1>Register</h1>
	<?php
	if(isset($_GET['success']) === true && empty($_GET['success']) === true) {
		echo '<small>You \'ve been registered successfully! Please check your email to activate your account.</small>';
	}
	else {
		if(empty($_POST) === false && empty($errors) === true) {
		$register_data = array(
					'username' 		=> $_POST['username'],
					'password' 		=> $_POST['password'],
					'first_name' 	=> $_POST['first_name'],
					'last_name' 	=> $_POST['last_name'],
					'email' 		=> $_POST['email'],
					'email_code'	=> md5($_POST['username'] + microtime())
		);
		register_user($register_data);
		header('Location: register.php?success');
		exit();
		}
		else if(empty($errors) === false) {
		output_error($errors);
		}
	?>
	<form action="" method="post">
		<ul class="login">
			<li>
				<label>Username<span class="red">*</span>: <br /><input type="text" name="username" /></label>
			</li>
			<li>
				<label>Password<span class="red">*</span>: <br /><input type="text" name="password" /></label>
			</li>
			<li>
				<label>Password again: <br /><input type="text" name="password_again" /></label>
			</li>
			<li>
				<label>First name<span class="red">*</span>: <br /><input type="text" name="first_name" /></label>
			</li>
			<li>
				<label>Last name: <br /><input type="text" name="last_name" /></label>
			</li>
			<li>
				<label>Email<span class="red">*</span>: <br /><input type="text" name="email" /></label>
			</li>
			<li>
				<button type="submit">Register</button>
			</li>
		</ul>
	</form>
</div>
<?php
}
include_once 'include/overall/footer.php';
?>