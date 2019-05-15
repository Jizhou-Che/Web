<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Update Staff - Sunny Isle</title>
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
			}else if($_SESSION['userType'] != "administrator"){
				echo("
					<h1>You are not logged in as administrator!</h1>
				");
			}else if(!isset($_POST['staffName'])){
				// Error in $_POST.
				$_SESSION['notification'] = "Error in page redirection.";
				$_SESSION['notificationType'] = "error";
				exit(header("Location: ../../../"));
			}else{
				try{
					$conn = new PDO("mysql:host=localhost;dbname=scyjc1", "scyjc1", "Jizhou990528");
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare('SELECT * FROM staff WHERE username = :username');
					$stmt->bindParam(':username', $_POST['staffName']);
					$stmt->execute();
					$info = $stmt->fetch();
					echo("
						<h1>Update Staff - " . $_POST['staffName'] . "</h1>
						<form id=\"form_update\" action=\"update_staff.php\" method=\"POST\">
							<input type=\"hidden\" id=\"staffName_update\" name=\"staffName_update\" value=\"" . $_POST['staffName'] . "\">
							<br>
							<label>Real Name:</label>
							<br>
							<input type=\"text\" id=\"realname\" name=\"realname\" value=\"" . $info["realname"] . "\">
							<br><br>
							<label>ID:</label>
							<br>
							<input type=\"text\" id=\"ID\" name=\"ID\" value=\"" . $info["ID"] . "\">
							<br><br>
							<label>Telephone Number:</label>
							<br>
							<input type=\"text\" id=\"tel\" name=\"tel\" value=\"" . $info["tel"] . "\">
							<br><br>
							<label>Email:</label>
							<br>
							<input type=\"text\" id=\"email\" name=\"email\" value=\"" . $info["email"] . "\">
							<br><br>
							<label>Privilege:</label>
							<select name=\"isAdmin\">
					");
					if($info["isAdmin"] == TRUE){
						echo("
							<option selected=\"selected\">Administrator</option>
							<option>Staff</option>
						");
					}else{
						echo("
							<option>Administrator</option>
							<option selected=\"selected\">Staff</option>
						");
					}
					echo("
							</select>
						</form>
						<form id=\"form_remove\" action=\"remove_staff.php\" method=\"POST\">
							<input type=\"hidden\" id=\"staffName_remove\" name=\"staffName_remove\" value=\"" . $_POST['staffName'] . "\">
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
