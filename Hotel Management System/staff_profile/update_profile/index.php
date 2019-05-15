<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Update Profile - Sunny Isle</title>
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
				echo("<h1>You are not logged in as a staff!</h1>");
			}else{
				try{
					$conn = new PDO("mysql:host=localhost;dbname=scyjc1", "scyjc1", "Jizhou990528");
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					// Select the respective staff.
					$stmt = $conn->prepare('SELECT * FROM staff WHERE username = :username');
					$stmt->bindParam(':username', $_SESSION['username']);
					$stmt->execute();
					$info = $stmt->fetch();
					echo("
						<h1>Update Profile - " . $_SESSION['username'] . "</h1>
						<form id=\"form\" action=\"update_profile.php\" method=\"POST\">
							<br>
							<label>Real Name:</label>
							<br>
							<input type=\"text\" id=\"realname\" name=\"realname\" value=\"" . $info["realname"] . "\">
							<br><br>
							<label>Telephone Number:</label>
							<br>
							<input type=\"text\" id=\"tel\" name=\"tel\" value=\"" . $info["tel"] . "\">
							<br><br>
							<label>Email:</label>
							<br>
							<input type=\"text\" id=\"email\" name=\"email\" value=\"" . $info["email"] . "\">
							<br>
						</form>
						<div id=\"update\">Update</div>
						<div id=\"back\">Back</div>
					");
				}catch(PDOException $e){
					$_SESSION['notification'] = $e->getMessage();
					$_SESSION['notificationType'] = "error";
					exit(header("Location: ../"));
				}
			}
		?>
	</div>
</body>
</html>
