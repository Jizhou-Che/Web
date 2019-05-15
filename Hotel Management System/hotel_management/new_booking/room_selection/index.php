<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Room Selection - Sunny Isle</title>
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
			}else if(!(isset($_POST['type']) && isset($_POST['checkInDate_Y']) && isset($_POST['checkInDate_m']) && isset($_POST['checkInDate_d']) && isset($_POST['checkOutDate_Y']) && isset($_POST['checkOutDate_m']) && isset($_POST['checkOutDate_d']))){
				// Error in $_POST.
				$_SESSION['notification'] = "Error in page redirection.";
				$_SESSION['notificationType'] = "error";
				exit(header("Location: ../../../"));
			}else{
				function month2indexstr($month){
					switch($month){
						case "January":
							return "01";
						case "February":
							return "02";
						case "March":
							return "03";
						case "April":
							return "04";
						case "May":
							return "05";
						case "June":
							return "06";
						case "July":
							return "07";
						case "August":
							return "08";
						case "September":
							return "09";
						case "October":
							return "10";
						case "November":
							return "11";
						case "December":
							return "12";
						default:
							return "00";
					}
				}
				echo("
					<h1>Room Selection - Sunny Isle</h1>
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
					<br><br>
					<form id=\"form\" action=\"room_booking.php\" method=\"POST\">
						<input type=\"hidden\" id=\"type\" name=\"type\" value=\"" . $_POST['type'] . "\">
						<input type=\"hidden\" id=\"checkInDate\" name=\"checkInDate\" value=\"" . $_POST['checkInDate_Y'] . "-" . month2indexstr($_POST['checkInDate_m']) . "-" . $_POST['checkInDate_d'] . "\">
						<input type=\"hidden\" id=\"checkOutDate\" name=\"checkOutDate\" value=\"" . $_POST['checkOutDate_Y'] . "-" . month2indexstr($_POST['checkOutDate_m']) . "-" . $_POST['checkOutDate_d'] . "\">
						<input type=\"hidden\" id=\"roomNo\" name=\"roomNo\" value=\"\">
						<label>Username:</label>
						<input type=\"text\" id=\"username\" name=\"username\">
						<label id=\"passport_label\">Passport ID:</label>
						<input type=\"text\" id=\"passport\" name=\"passport\">
					</form>
					<div id=\"book\">Book</div>
					<div id=\"back\">Back</div>
				");
			}
		?>
	</div>
</body>
</html>
