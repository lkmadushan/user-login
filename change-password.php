<?php
include_once 'core/init.php';
protect_page();
if(empty($_POST) === false) {
	$required_fields = array('current_password', 'password', 'password_again');
	foreach($_POST as $key => $value) {
		if(empty($value) === true && in_array($key, $required_fields) === true) {
			$errors[] = 'Fields mark with an astersik are required.';
			break 1;
		}
	}
	if(empty($errors) === true) {
		if(md5($_POST['current_password']) === $user_data['password']) {
			if($_POST['password'] !== $_POST['password_again']) {
				$errors[] = 'Your new passwords do not match.';
			}
			else if(strlen($_POST['password']) < 6) {
				$errors[] = 'Your password must be at least 6 characters.';
			}
		}
		else {
			$errors[] = 'Your current password is incorrect.';
		}
	}
}
include_once 'include/overall/header.php';
?>
<div class="home">
	<h1>Change Password</h1>
	<?php
	if(isset($_GET['success']) === true && empty($_GET['success']) === true) {
		echo '<small>Your password has been changed!</small>';
	}
	else {
		if(empty($_POST) === false && empty($errors) === true) {
			change_password($session_user_id, $_POST['password']);
			header('Location: change-password.php?success');
			exit();
		}
		else if(empty($errors) === false) {
			output_error($errors);
		}
	?>
		<form action="" method="post">
			<ul class="login">
				<li>
					<label>Current password<span class="red">*</span>: <br /><input type="text" name="current_password" /></label>
				</li>
				<li>
					<label>New Password<span class="red">*</span>: <br /><input type="text" name="password" /></label>
				</li>
				<li>
					<label>New Password again<span class="red">*</span>: <br /><input type="text" name="password_again" /></label>
				</li>
				<li>
					<button type="submit">Change</button>
				</li>
			</ul>
		</form>
</div>
<?php
}
include_once 'include/overall/footer.php';
?>