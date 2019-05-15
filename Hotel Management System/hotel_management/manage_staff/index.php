<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Manage Staff - Sunny Isle</title>
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
			}else if($_SESSION['userType'] != "administrator"){
				echo("
					<h1>You are not logged in as administrator!</h1>
				");
			}else{
				try{
					echo("
						<h1>Manage Staff - Sunny Isle</h1>
						<table>
							<caption>Staffs</caption>
							<tr>
								<th>Username</th>
								<th>Real Name</th>
								<th>ID</th>
								<th>Telephone</th>
								<th>Email</th>
								<th>Privilege</th>
								<th>Operations</th>
							</tr>
					");
					$conn = new PDO("mysql:host=localhost;dbname=scyjc1", "scyjc1", "Jizhou990528");
					$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $conn->prepare('SELECT * FROM staff ORDER BY ID');
					$stmt->execute();
					$staffs = $stmt->fetchAll();
					foreach($staffs as $staff){
						echo("<tr>");
						echo("<td>" . $staff["username"] . "</td>");
						echo("<td>" . $staff["realname"] . "</td>");
						echo("<td>" . $staff["ID"] . "</td>");
						echo("<td>" . $staff["tel"] . "</td>");
						echo("<td>" . $staff["email"] . "</td>");
						if($staff["isAdmin"] == TRUE){
							echo("<td>Administrator</td>");
						}else{
							echo("<td>Staff</td>");
						}
						echo("<td>");
						if($_SESSION["username"] != $staff["username"]){
							echo("<button onclick=\"update_staff('" . $staff["username"] . "');\">Update</button>");
						}
						echo("</td>");
						echo("</tr>");
					}
					echo("
						</table>
						<form id=\"form\" action=\"update_staff/index.php\" method=\"POST\">
							<input type=\"hidden\" id=\"staffName\" name=\"staffName\">
						</form>
						<div id=\"add_staff\">Add Staff</div>
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
