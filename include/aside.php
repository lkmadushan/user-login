<aside>
<?php 
if(logged_in() === true):
	include_once 'include/widget/loggedin.php';
else: 
	include_once 'include/widget/login.php';
endif;

include_once 'include/widget/user_count.php'; 
?>
</aside>