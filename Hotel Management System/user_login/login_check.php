<?php
	session_start();
	if(isset($_SESSION['userType'])){
		// Already logged in.
		$_SESSION['notification'] = "You are already logged in.";
		$_SESSION['notificationType'] = "error";
		exit(header("Location: ../"));
	}
	try{
		$conn = new PDO("mysql:host=localhost;dbname=scyjc1", "scyjc1", "Jizhou990528");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// Select the respective user.
		$stmt = $conn->prepare('SELECT * FROM user WHERE username = :username');
		$stmt->bindParam(':username', $_POST['username']);
		$stmt->execute();
		// Comepare the password.
		$password = $stmt->fetchColumn(1);
		if($password == NULL){
			// User does not exist.
			$_SESSION['notification'] = "Log in failed: User does not exist.";
			$_SESSION['notificationType'] = "error";
			exit(header("Location: index.php"));
		}else{
			if($password === $_POST['password']){
				// Log in successful.
				$_SESSION['userType'] = "user";
				$_SESSION['username'] = $_POST['username'];
				$_SESSION['notification'] = "Log in successful.";
				$_SESSION['notificationType'] = "success";
				exit(header("Location: ../"));
			}else{
				// Wrong password.
				$_SESSION['notification'] = "Log in failed: Wrong password.";
				$_SESSION['notificationType'] = "error";
				exit(header("Location: index.php"));
			}
		}
	}catch(PDOException $e){
		$_SESSION['notification'] = $e->getMessage();
		$_SESSION['notificationType'] = "error";
		exit(header("Location: index.php"));
	}
?>
