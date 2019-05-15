<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Log In - Sunny Isle</title>
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
			if(isset($_SESSION['userType'])){
				echo("
					<h1>You are already logged in!</h1>
					<p>You may wish to <span id=\"logoff\">log off</span> first.</p>
				");
			}else{
				echo("
					<h1>Staff log in - Sunny Isle</h1>
					<form id=\"form\" action=\"login_check.php\" method=\"POST\">
						<br>
						<label>Username:</label>
						<br>
						<input type=\"text\" id=\"username\" name=\"username\">
						<br><br>
						<label>Password:</label>
						<br>
						<input type=\"password\" id=\"password\" name=\"password\">
					</form>
					<div id=\"login\">Log In</div>
					<div id=\"back\">Back</div>
					<br>
					<a id=\"user_login\" href=\"../user_login\">I'm a user</a>
				");
			}
		?>
	</div>
</body>
</html>
