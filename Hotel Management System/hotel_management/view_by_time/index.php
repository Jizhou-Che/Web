<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Booking Status - Sunny Isle</title>
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
				date_default_timezone_set('Asia/Shanghai');
				echo("
					<h1>Booking Status - Sunny Isle</h1>
					<form id=\"form\" action=\"room_selection/index.php\" method=\"POST\">
						<input type=\"hidden\" id=\"currentDate\" name=\"currentDate\" value=\"" . date("Y-m-d") . "\">
						<br>
						<label>Check-in date:</label>
						<select id=\"checkInDate_Y\" name=\"checkInDate_Y\"></select>
						<select id=\"checkInDate_m\" name=\"checkInDate_m\"></select>
						<select id=\"checkInDate_d\" name=\"checkInDate_d\"></select>
						<br><br>
						<label>Check-out date:</label>
						<select id=\"checkOutDate_Y\" name=\"checkOutDate_Y\"></select>
						<select id=\"checkOutDate_m\" name=\"checkOutDate_m\"></select>
						<select id=\"checkOutDate_d\" name=\"checkOutDate_d\"></select>
						<br><br>
						<label>Type of room:</label>
						<select id=\"type\" name=\"type\">
							<option value=\"ALL\">All</option>
							<option value=\"LARGE DOUBLE\">Large double bed</option>
							<option value=\"LARGE SINGLE\">Large single bed</option>
							<option value=\"SMALL SINGLE\">Small single bed</option>
							<option value=\"VIP\">VIP</option>
						</select>
						<br><br>
						<label>Floor:</label>
						<select id=\"floor\" name=\"floor\">
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
							<option>6</option>
							<option>7</option>
							<option>8</option>
							<option>9</option>
							<option>10</option>
						</select>
					</form>
					<table>
						<caption>Sunny Isle - Plan View</caption>
						<tr class=\"solid_row\">
							<td id=\"01\">Large double bed<br><br><span id=\"X01\"></span></td>
							<td id=\"02\">Large double bed<br><br><span id=\"X02\"></span></td>
							<td id=\"03\">Large single bed<br><br><span id=\"X03\"></span></td>
							<td id=\"04\">Large single bed<br><br><span id=\"X04\"></span></td>
							<td id=\"05\">Small single bed<br><br><span id=\"X05\"></span></td>
						</tr>
						<tr class=\"empty_row\">
							<td></td>
							<td colspan=\"3\" rowspan=\"4\">Stairs & Lobby</td>
							<td></td>
						</tr>
						<tr class=\"solid_row\">
							<td id=\"13\" rowspan=\"2\">VIP Room<br><br><span id=\"X13\"></span></td>
							<td id=\"06\">Small single bed<br><br><span id=\"X06\"></span></td>
						</tr>
						<tr class=\"solid_row\">
							<td id=\"07\">Small single bed<br><br><span id=\"X07\"></span></td>
						</tr>
						<tr class=\"empty_row\">
							<td></td>
							<td></td>
						</tr>
						<tr class=\"solid_row\">
							<td id=\"12\">Large double bed<br><br><span id=\"X12\"></span></td>
							<td id=\"11\">Large double bed<br><br><span id=\"X11\"></span></td>
							<td id=\"10\">Large single bed<br><br><span id=\"X10\"></span></td>
							<td id=\"09\">Large single bed<br><br><span id=\"X09\"></span></td>
							<td id=\"08\">Small single bed<br><br><span id=\"X08\"></span></td>
						</tr>
					</table>
					<br>
					<div id=\"back\">Back</div>
				");
			}
		?>
	</div>
</body>
</html>
