<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Sign Up - Sunny Isle</title>
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
					<h1>User sign up - Sunny Isle</h1>
					<form id=\"form\" action=\"register.php\" method=\"POST\">
						<br>
						<label>Username:</label>
						<br>
						<input type=\"text\" id=\"username\" name=\"username\">
						<br><br>
						<label>Password:</label>
						<br>
						<input type=\"password\" id=\"password1\" name=\"password1\">
						<br><br>
						<label>Confirm Password:</label>
						<br>
						<input type=\"password\" id=\"password2\" name=\"password2\">
						<br><br>
						<label>Real Name:</label>
						<br>
						<input type=\"text\" id=\"realname\" name=\"realname\">
						<br><br>
						<label>Passport ID:</label>
						<br>
						<input type=\"text\" id=\"passport\" name=\"passport\">
						<br><br>
						<label>Telephone Number:</label>
						<br>
						<input type=\"text\" id=\"tel\" name=\"tel\">
						<br><br>
						<label>Email:</label>
						<br>
						<input type=\"text\" id=\"email\" name=\"email\">
					</form>
					<div id=\"signup\">Sign Up</div>
					<div id=\"back\">Back</div>
					<br>
					<span id=\"login\">Already have an account? <a href=\"../user_login/\">Log In</a></span>
				");
			}
		?>
	</div>
</body>
</html>
