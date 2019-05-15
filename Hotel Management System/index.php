<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Sunny Isle Hotel</title>
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
	<div id="main">
		<div id="home"></div>
		<div id="nav">
			<?php
				if(!isset($_SESSION['userType'])){
					echo("<div class=\"navLink\" id=\"login\">Log In</div>");
					echo("<div class=\"navLink\" id=\"signup\">Sign Up</div>");
				}else{
					if($_SESSION['userType'] == "user"){
						echo("<div class=\"navLink\" id=\"my_bookings\">My Bookings</div>");
						echo("<div class=\"navLink\" id=\"user_profile\">Profile</div>");
					}else{
						echo("<div class=\"navLink\" id=\"hotel_management\">Hotel Management</div>");
						echo("<div class=\"navLink\" id=\"staff_profile\">Profile</div>");
					}
					echo("<span id=\"logoff\">Log Off</span>");
				}
			?>
		</div>
		<h1 id="welcome">Welcome to Sunny Isle Hotel</h1>
	</div>
	<div id="intro">
		<p id="introduction">
			Sunny Isle is a small but famous hotel in the east region of Lukewarm Kingdom.
			People from all over the world visit here for a nice and comfortable holiday.
			We offer 130 rooms of four different kinds featuring fully equipped in-room kitchenettes, many with balconies and water views.
			Rooftop pool, deck and bar with ocean views and more await at our hotel in Sunny Isles Beach.
			Breakfast buffet, ordered meals prepared by top chefs, Wi-Fi and parking areas are available with affordable prices.
		</p>
	</div>
	<div id="large_double">
		<table>
			<tr>
				<td>
					<div id="large_double_img"></div>
				</td>
				<td>
					<div id="large_double_text">
						<h2>Large room with double beds</h2>
						<p>High quality room of large size, suitable for two.</p>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<div id="large_single">
		<table class="right">
			<tr>
				<td>
					<div id="large_single_text">
						<h2>Large room with a large single bed</h2>
						<p>Comfortable room for single person.</p>
					</div>
				</td>
				<td>
					<div id="large_single_img"></div>
				</td>
			</tr>
		</table>
	</div>
	<div id="small_single">
		<table>
			<tr>
				<td>
					<div id="small_single_img"></div>
				</td>
				<td>
					<div id="small_single_text">
						<h2>Small room with a single bed</h2>
						<p>Nice and tidy room for single person. Choice of thrifty.</p>
					</div>
				</td>
			</tr>
		</table>	
	</div>
	<div id="vip">
		<table class="right">
			<tr>
				<td>
					<div id="vip_text">
						<h2>VIP room</h2>
						<p>Luxurious suite, ultimate enjoyment.</p>
					</div>
				</td>
				<td>
					<div id="vip_img"></div>
				</td>
			</tr>
		</table>
	</div>
</body>
</html>
