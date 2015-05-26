<?php 
include_once 'core/init.php';
include_once 'include/overall/header.php';
if(isset($_GET['username']) === true && empty($_GET['username']) === false) {
	echo $_GET['username'];
}
else {
	header('Location: index.php');
}
include_once 'include/overall/footer.php';
?>