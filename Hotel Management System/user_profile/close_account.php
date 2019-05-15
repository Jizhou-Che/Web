<?php
	session_start();
	if(!isset($_SESSION['userType'])){
		// Not logged in.
		$_SESSION['notification'] = "You are not logged in.";
		$_SESSION['notificationType'] = "error";
		exit(header("Location: ../"));
	}
	if($_SESSION['userType'] != "user"){
		// Not a user.
		$_SESSION['notification'] = "You are not logged in as a user.";
		$_SESSION['notificationType'] = "error";
		exit(header("Location: ../"));
	}
	if(!(isset($_POST['password']))){
		// Error in $_POST.
		$_SESSION['notification'] = "Error in page redirection.";
		$_SESSION['notificationType'] = "error";
		exit(header("Location: ../"));
	}
	try{
		$conn = new PDO("mysql:host=localhost;dbname=scyjc1", "scyjc1", "Jizhou990528");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// Select the respective user.
		$stmt = $conn->prepare('SELECT * FROM user WHERE username = :username');
		$stmt->bindParam(':username', $_SESSION['username']);
		$stmt->execute();
		// Comepare the password.
		$password = $stmt->fetchColumn(1);
		if($password == $_POST['password']){
			// Password match.
			// Remove all bookings of user.
			$stmt = $conn->prepare('DELETE FROM booking WHERE username = :username');
			$stmt->bindParam(':username', $_SESSION['username']);
			$stmt->execute();
			// Delete user from user table.
			$stmt = $conn->prepare('DELETE FROM user WHERE username = :username');
			$stmt->bindParam(':username', $_SESSION['username']);
			$stmt->execute();
			// Set session variables.
			unset($_SESSION['userType']);
			unset($_SESSION['username']);
			$_SESSION['notification'] = "Account closed.";
			$_SESSION['notificationType'] = "success";
			exit(header("Location: ../"));
		}else{
			// Wrong password.
			$_SESSION['notification'] = "Failed to close account: Wrong password.";
			$_SESSION['notificationType'] = "error";
			exit(header("Location: index.php"));
		}
	}catch(PDOException $e){
		$_SESSION['notification'] = $e->getMessage();
		$_SESSION['notificationType'] = "error";
		exit(header("Location: index.php"));
	}
?>
