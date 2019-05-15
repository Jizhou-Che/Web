<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>My Profile - Sunny Isle</title>
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
				echo("<h1>You are not logged in as a staff!</h1>");
			}else{
				echo("<h1>My Profile - Sunny Isle</h1>");
				try{
					$conn = new PDO("mysql:host=localhost;dbname=scyjc1", "scyjc1", "Jizhou990528");
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					// Select the respective staff.
					$stmt = $conn->prepare('SELECT * FROM staff WHERE username = :username');
					$stmt->bindParam(':username', $_SESSION['username']);
					$stmt->execute();
					$info = $stmt->fetch();
					// Display staff profile.
					if($info['isAdmin'] == TRUE){
						echo("<span>Privilege: Administrator</span><br><br>");
					}else{
						echo("<span>Privilege: Staff</span><br><br>");
					}
					echo("
						<span>Username: " . $info['username'] . "</span>
						<br><br>
						<span>Real Name: " . $info['realname'] . "</span>
						<br><br>
						<span>Staff ID: " . $info['ID'] . "</span>
						<br><br>
						<span>Telephone Number: " . $info['tel'] . "</span>
						<br><br>
						<span>Email Address: " . $info['email'] . "</span>
						<br><br>
						<a class=\"links\" href=\"update_profile\">Update My Profile</a>
						<br><br>
						<a class=\"links\" href=\"update_password\">Update Password</a>
						<br>
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
