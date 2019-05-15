<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Update Password - Sunny Isle</title>
	<link rel="stylesheet" type="text/css" href="index.css">
	<script src="index.js"></script>
</head>
<body>
	<?php
		if(isset($_SESSION['notificationType'])){
			echo("<div class=\"" . $_SESSION['notificationType'] . "\" id=\"notification\">" . $_SESSION['notification'] . "</div>");
			unset($_SESSION['notification']);
			unset($_SESSION['notificationType']);
		}
	?>
	<div id="background"></div>
	<div id="home"></div>
	<div id="main">
		<?php
			if(!isset($_SESSION['userType'])){
				echo("
					<h1>You are not logged in!</h1>
					<p>You may wish to <a href=\"../../user_login\">log in</a> first.</p>
				");
			}else if($_SESSION['userType'] != "user"){
				echo("<h1>You are not logged in as a user!</h1>");
			}else{
				echo("
					<h1>Update Password - " . $_SESSION['username'] . "</h1>
					<form id=\"form\" action=\"update_password.php\" method=\"POST\">
						<br>
						<label>Original Password:</label>
						<br>
						<input type=\"password\" id=\"password0\" name=\"password0\">
						<br><br>
						<label>New Password:</label>
						<br>
						<input type=\"password\" id=\"password1\" name=\"password1\">
						<br><br>
						<label>Confirm New Password:</label>
						<br>
						<input type=\"password\" id=\"password2\" name=\"password2\">
						<br>
					</form>
					<div id=\"update\">Update</div>
					<div id=\"back\">Back</div>
				");
			}
		?>
	</div>
</body>
</html>
