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
				echo("
					<h1>Booking Status - Sunny Isle</h1>
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
					<br><br>
					<label>Floor:</label>
					<select id=\"floor\">
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
					<label id=\"room_label\">Room:</label>
					<select id=\"room\">
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
						<option>11</option>
						<option>12</option>
						<option>13</option>
					</select>
					<table id=\"table\">
						<caption id=\"table_caption\"></caption>
						<tr>
							<th>Username</th>
							<th>Passport ID</th>
							<th>Check-in date</th>
							<th>Check-out date</th>
							<th>Operations</th>
						</tr>
					</table>
					<form id=\"form\" action=\"remove_booking.php\" method=\"POST\">
						<input type=\"hidden\" id=\"roomNo\" name=\"roomNo\">
						<input type=\"hidden\" id=\"checkInDate\" name=\"checkInDate\">
					</form>
					<div id=\"back\">Back</div>
				");
			}
		?>
	</div>
</body>
</html>
