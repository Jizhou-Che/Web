<?php
	session_start();
	unset($_SESSION['userType']);
	unset($_SESSION['username']);
	$_SESSION['notification'] = "You are successfully logged off.";
	$_SESSION['notificationType'] = "success";
	exit(header("Location: index.php"));
?>
