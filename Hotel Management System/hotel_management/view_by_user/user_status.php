<?php
	session_start();
	if(!isset($_SESSION['userType'])){
		// Not logged in.
		$_SESSION['notification'] = "Permission denied.";
		$_SESSION['notificationType'] = "error";
		exit(header("Location: ../../"));
	}
	if($_SESSION['userType'] == "user"){
		// Not a staff.
		$_SESSION['notification'] = "Permission denied.";
		$_SESSION['notificationType'] = "error";
		exit(header("Location: ../../"));
	}
	if(!isset($_POST['username'])){
		// Error in $_POST.
		$_SESSION['notification'] = "Error in page redirection.";
		$_SESSION['notificationType'] = "error";
		exit(header("Location: ../../"));
	}
	try{
		$conn = new PDO("mysql:host=localhost;dbname=scyjc1", "scyjc1", "Jizhou990528");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// Check if the user exists.
		$stmt = $conn->prepare('SELECT * FROM user WHERE username = :username');
		$stmt->bindParam(':username', $_POST['username']);
		$stmt->execute();
		$user = $stmt->fetch();
		if($user == NULL){
			echo("WRONG USERNAME");
		}else{
			// Select all bookings for the specified user.
			$stmt = $conn->prepare('SELECT * FROM booking WHERE username = :username ORDER BY checkInDate');
			$stmt->bindParam(':username', $_POST['username']);
			$stmt->execute();
			$bookings = $stmt->fetchAll();
			if($bookings == NULL){
				echo("EMPTY SET");
			}else{
				echo(json_encode($bookings));
			}
		}
	}catch(PDOException $e){
		$_SESSION['notification'] = $e->getMessage();
		$_SESSION['notificationType'] = "error";
		exit(header("Location: index.php"));
	}
?>
