<?php
//start the session
session_start();

//unset and destroy the current session
session_unset();
session_destroy();

//redirect to index.php
header('Location: index.php');
?>