<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>New Booking - Sunny Isle</title>
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
					<p>You may wish to <a href=\"../../staff_login\">log in</a> first.</p>
				");
			}else if($_SESSION['userType'] == "user"){
				echo("
					<h1>You are not logged in as a staff!</h1>
				");
			}else{
				// Plan view of hotel.
				echo("
					<h1>New Booking - Sunny Isle</h1>
					<table>
						<caption>Sunny Isle - Plan View</caption>
						<tr class=\"solid_row\">
							<td>Large double bed<br><br>Room X01</td>
							<td>Large double bed<br><br>Room X02</td>
							<td>Large single bed<br><br>Room X03</td>
							<td>Large single bed<br><br>Room X04</td>
							<td>Small single bed<br><br>Room X05</td>
						</tr>
						<tr class=\"empty_row\">
							<td></td>
							<td colspan=\"3\" rowspan=\"4\">Stairs & Lobby</td>
							<td></td>
						</tr>
						<tr class=\"solid_row\">
							<td rowspan=\"2\">VIP Room<br><br>Room X13</td>
							<td>Small single bed<br><br>Room X06</td>
						</tr>
						<tr class=\"solid_row\">
							<td>Small single bed<br><br>Room X07</td>
						</tr>
						<tr class=\"empty_row\">
							<td></td>
							<td></td>
						</tr>
						<tr class=\"solid_row\">
							<td>Large double bed<br><br>Room X12</td>
							<td>Large double bed<br><br>Room X11</td>
							<td>Large single bed<br><br>Room X10</td>
							<td>Large single bed<br><br>Room X09</td>
							<td>Small single bed<br><br>Room X08</td>
						</tr>
					</table>
				");
				// Date picker.
				date_default_timezone_set('Asia/Shanghai');
				echo("
					<form id=\"form\" action=\"room_selection/index.php\" method=\"POST\">
						<input type=\"hidden\" id=\"currentDate\" name=\"currentDate\" value=\"" . date("Y-m-d") . "\">
						<br>
						<label>Check-in date:</label>
						<br>
						<select id=\"checkInDate_Y\" name=\"checkInDate_Y\"></select>
						<select id=\"checkInDate_m\" name=\"checkInDate_m\"></select>
						<select id=\"checkInDate_d\" name=\"checkInDate_d\"></select>
						<br><br>
						<label>Check-out date:</label>
						<br>
						<select id=\"checkOutDate_Y\" name=\"checkOutDate_Y\"></select>
						<select id=\"checkOutDate_m\" name=\"checkOutDate_m\"></select>
						<select id=\"checkOutDate_d\" name=\"checkOutDate_d\"></select>
						<br><br>
						<label>Type of room:</label>
						<br>
						<select id=\"type\" name=\"type\">
							<option value=\"LARGE DOUBLE\">Large double bed</option>
							<option value=\"LARGE SINGLE\">Large single bed</option>
							<option value=\"SMALL SINGLE\">Small single bed</option>
							<option value=\"VIP\">VIP</option>
						</select>
						<br>
					</form>
					<div id=\"continue\">Continue</div>
					<div id=\"back\">Back</div>
				");
			}
		?>
	</div>
</body>
</html>
