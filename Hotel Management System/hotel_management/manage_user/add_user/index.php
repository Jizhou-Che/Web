<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Add User - Sunny Isle</title>
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
					<p>You may wish to <a href=\"../../../staff_login\">log in</a> first.</p>
				");
			}else if($_SESSION['userType'] == "user"){
				echo("
					<h1>You are not logged in as a staff!</h1>
				");
			}else{
				echo("
					<h1>Add User - Sunny Isle</h1>
					<form id=\"form\" action=\"add_user.php\" method=\"POST\">
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
						<label>Telephone:</label>
						<br>
						<input type=\"text\" id=\"tel\" name=\"tel\">
						<br><br>
						<label>Email:</label>
						<br>
						<input type=\"text\" id=\"email\" name=\"email\">
					</form>
					<div id=\"add\">Add</div>
					<div id=\"back\">Back</div>
				");
			}
		?>
	</div>
</body>
</html>
