<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Hotel Management - Sunny Isle</title>
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
					<p>You may wish to <a href=\"../staff_login\">log in</a> first.</p>
				");
			}else if($_SESSION['userType'] == "user"){
				echo("
					<h1>You are not logged in as a staff!</h1>
				");
			}else{
				echo("
					<h1>Hotel Management - Sunny Isle</h1>
				");
				if($_SESSION['userType'] == "administrator"){
					echo("<div id=\"manage_staff\" class=\"buttons\">Manage Staff</div>");
				}
				echo("
					<div id=\"manage_user\" class=\"buttons\">Manage User</div>
					<div id=\"view_by_time\" class=\"buttons\">View Booking Status by Time</div>
					<div id=\"view_by_room\" class=\"buttons\">View Booking Status by Room</div>
					<div id=\"view_by_user\" class=\"buttons\">View Booking Status by User</div>
					<div id=\"new_booking\" class=\"buttons\">New Booking</div>
					<div id=\"back\" class=\"buttons\">Back</div>
				");
			}
		?>
	</div>
</body>
</html>
