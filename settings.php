<?php
include_once 'core/init.php';
protect_page();
include_once 'include/overall/header.php';
if(empty($_POST) === false) {
	$required_fields = array('first_name', 'email');
	foreach($_POST as $key => $value) {
		if(empty($value) === true && in_array($key, $required_fields) === true) {
			$errors[] = 'Fields mark with an astersik are required.';
			break 1;
		}
	}
	if(empty($errors) === true) {
		if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
			$errors[] = 'A valid email address is required.';
		}
		else if(email_exists($_POST['email']) === true && $user_data['email'] !== $_POST['email']) {
			$errors[] = 'Sorry, the email \'' . $_POST['email'] . '\' is already in use.';
		}
	}
}
?>
<div class="home">
	<h1>Settings</h1>
	<?php
	if(isset($_GET['success']) === true && empty($_GET['success']) === true) {
		echo '<small>Your details have been updated.</small>';
	}
	else {
		if(empty($_POST) === false && empty($errors) === true) {
			$update_data = array(
					'first_name'	=> $_POST['first_name'],
						'last_name'		=> $_POST['last_name'],
						'email' 		=> $_POST['email']
			);
			update_user($update_data);
			header('Location: settings.php?success');
			exit();
		}
		else if(empty($errors) === false) {
			output_error($errors);
		}
	?>
	<form action="" method="post">
		<ul class="login">
			<li>
				<label>First name<span class="red">*</span>: <br /><input type="text" name="first_name" value="<?php echo $user_data['first_name'] ?>" /></label>
			</li>
			<li>
				<label>Last name: <br /><input type="text" name="last_name" value="<?php echo $user_data['last_name'] ?>" /></label>
			</li>
			<li>
				<label>Email<span class="red">*</span>: <br /><input type="text" name="email" value="<?php echo $user_data['email'] ?>" /></label>
			</li>
			<li>
				<button type="submit">Update</button>
			</li>
		</ul>
	</form>
</div>
<?php
	}
include_once 'include/overall/footer.php';
?>