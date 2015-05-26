<?php 
include_once 'core/init.php';
looged_in_redirect();
include_once 'include/overall/header.php';

if(isset($_GET['success']) === true && empty($_GET['success']) === true) {
?>
	<h2>Thanks, we've activated your account.</h2>
	<p>You're free to log in!</p>
<?php	
}
else if(isset($_GET['email'], $_GET['email_code']) === true) {
	$email = $_GET['email'];
	$email_code = $_GET['email_code'];

	if(email_exists($email) === false) {
		$errors[] = 'Oops, something went wrong, and we couldn\'t find that email address!';
	}
	else if(activate($email, $email_code) === false) {
		$errors[] = 'We had problems activating your account.';
	}

	if(empty($errors) === false) {
	?>

	<h2>Oops...</h2>

	<?php
		output_error($errors);
	}
	else {
		header('Location: activate.php?success');
		exit();
	}
}
else {
	header('Location: index.php');
	exit();
}
include_once 'include/overall/footer.php';
?>