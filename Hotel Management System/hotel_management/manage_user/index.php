<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Manage User - Sunny Isle</title>
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
				try{
					echo("
						<h1>Manage User - Sunny Isle</h1>
						<table>
							<caption>Users</caption>
							<tr>
								<th>Username</th>
								<th>Real Name</th>
								<th>Passport ID</th>
								<th>Telephone</th>
								<th>Email</th>
								<th>Operations</th>
							</tr>
					");
					$conn = new PDO("mysql:host=localhost;dbname=scyjc1", "scyjc1", "Jizhou990528");
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare('SELECT * FROM user ORDER BY passport');
					$stmt->execute();
					$users = $stmt->fetchAll();
					foreach($users as $user){
						echo("<tr>");
						echo("<td>" . $user["username"] . "</td>");
						echo("<td>" . $user["realname"] . "</td>");
						echo("<td>" . $user["passport"] . "</td>");
						echo("<td>" . $user["tel"] . "</td>");
						echo("<td>" . $user["email"] . "</td>");
						echo("<td><button onclick=\"update_user('" . $user["username"] . "');\">Update</button></td>");
						echo("</tr>");
					}
					echo("
						</table>
						<form id=\"form\" action=\"update_user/index.php\" method=\"POST\">
							<input type=\"hidden\" id=\"userName\" name=\"userName\">
						</form>
						<div id=\"add_user\">Add User</div>
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
