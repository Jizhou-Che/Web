<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>My Bookings - Sunny Isle</title>
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
					<p>You may wish to <a href=\"../user_login\">log in</a> first.</p>
				");
			}else if($_SESSION['userType'] != "user"){
				echo("
					<h1>You are not logged in as a user!</h1>
				");
			}else{
				echo("<h1>My Bookings - Sunny Isle</h1>");
				try{
					$conn = new PDO("mysql:host=localhost;dbname=scyjc1", "scyjc1", "Jizhou990528");
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					// Get user bookings.
					$stmt = $conn->prepare('SELECT * FROM booking WHERE username = :username ORDER BY checkInDate, roomNo');
					$stmt->bindParam(':username', $_SESSION['username']);
					$stmt->execute();
					$bookings = $stmt->fetchAll();
					if($bookings == NULL){
						echo("<h1>You haven't got any room booking.</h1>");
					}else{
						echo("
							<table>
								<caption>My Bookings</caption>
								<tr>
									<th>Room number</th>
									<th>Type</th>
									<th>Passport ID</th>
									<th>Check-in date</th>
									<th>Check-out date</th>
									<th>Status</th>
								</tr>
						");
						foreach($bookings as $booking){
							echo("<tr>");
							echo("<td>" . $booking["roomNo"] . "</td>");
							$stmt = $conn->prepare('SELECT * FROM room WHERE roomNo = :roomNo');
							$stmt->bindParam(':roomNo', $booking['roomNo']);
							$stmt->execute();
							$room = $stmt->fetch();
							echo("<td>" . $room["type"] . "</td>");
							echo("<td>" . $booking["passport"] . "</td>");
							echo("<td>" . $booking["checkInDate"] . "</td>");
							echo("<td>" . $booking["checkOutDate"] . "</td>");
							// Define current room status.
							date_default_timezone_set('Asia/Shanghai');
							$currentDate = date("Y-m-d");
							if($currentDate < $booking["checkInDate"]){
								echo("<td>Booked <button onclick=\"cancel_booking(" . $booking["roomNo"] . ", '" . $booking["checkInDate"] . "');\">cancel</button></td>");
							}elseif($currentDate > $booking["checkOutDate"]){
								echo("<td>Completed</td>");
							}else{
								echo("<td>Checked in</td>");
							}
							echo("</tr>");
						}
						echo("
							</table>
							<form id=\"form\" action=\"cancel_booking.php\" method=\"POST\">
								<input type=\"hidden\" id=\"roomNo\" name=\"roomNo\">
								<input type=\"hidden\" id=\"checkInDate\" name=\"checkInDate\">
							</form>
						");
					}
				}catch(PDOException $e){
					echo($e->getMessage());
				}
				echo("
					<div id=\"new_booking\">New Booking</div>
					<div id=\"back\">Back</div>
				");
			}
		?>
	</div>
</body>
</html>
