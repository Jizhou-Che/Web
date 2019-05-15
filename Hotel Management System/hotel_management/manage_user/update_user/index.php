<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Update User - Sunny Isle</title>
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
			}else if(!isset($_POST['userName'])){
				;
			}else{
				try{
					$conn = new PDO("mysql:host=localhost;dbname=scyjc1", "scyjc1", "Jizhou990528");
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare('SELECT * FROM user WHERE username = :username');
					$stmt->bindParam(':username', $_POST['userName']);
					$stmt->execute();
					$info = $stmt->fetch();
					echo("
						<h1>Update User - " . $_POST['userName'] . "</h1>
						<form id=\"form_update\" action=\"update_user.php\" method=\"POST\">
							<input type=\"hidden\" id=\"userName_update\" name=\"userName_update\" value=\"" . $_POST['userName'] . "\">
							<br>
							<label>Real Name:</label>
							<br>
							<input type=\"text\" id=\"realname\" name=\"realname\" value=\"" . $info["realname"] . "\">
							<br><br>
							<label>Passport ID:</label>
							<br>
							<input type=\"text\" id=\"passport\" name=\"passport\" value=\"" . $info["passport"] . "\">
							<br><br>
							<label>Telephone Number:</label>
							<br>
							<input type=\"text\" id=\"tel\" name=\"tel\" value=\"" . $info["tel"] . "\">
							<br><br>
							<label>Email:</label>
							<br>
							<input type=\"text\" id=\"email\" name=\"email\" value=\"" . $info["email"] . "\">
						</form>
						<form id=\"form_remove\" action=\"remove_user.php\" method=\"POST\">
							<input type=\"hidden\" id=\"userName_remove\" name=\"userName_remove\" value=\"" . $_POST['userName'] . "\">
						</form>
						<div id=\"update\">Update</div>
						<div id=\"remove\">Remove</div>
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
