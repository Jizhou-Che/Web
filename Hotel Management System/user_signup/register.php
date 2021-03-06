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
		// Check for duplication.
		$stmt = $conn->prepare('SELECT * FROM user WHERE username = :username');
		$stmt->bindParam(':username', $_POST['username']);
		$stmt->execute();
		if(sizeof($stmt->fetchAll()) != 0){
			// Username already taken.
			$_SESSION['notification'] = "Sign up failed: Username already taken.";
			$_SESSION['notificationType'] = "error";
			exit(header("Location: index.php"));
		}
		$stmt = $conn->prepare('SELECT * FROM user WHERE passport = :passport');
		$stmt->bindParam(':passport', $_POST['passport']);
		$stmt->execute();
		if(sizeof($stmt->fetchAll()) != 0){
			// Passport ID already taken.
			$_SESSION['notification'] = "Sign up failed: Passport ID already taken.";
			$_SESSION['notificationType'] = "error";
			exit(header("Location: index.php"));
		}
		// Insert the new user.
		$stmt = $conn->prepare('INSERT INTO user VALUES (:username, :password, :realname, :passport, :tel, :email)');
		$stmt->bindParam(':username', $_POST['username']);
		$stmt->bindParam(':password', $_POST['password1']);
		$stmt->bindParam(':realname', $_POST['realname']);
		$stmt->bindParam(':passport', $_POST['passport']);
		$stmt->bindParam(':tel', $_POST['tel']);
		$stmt->bindParam(':email', $_POST['email']);
		$stmt->execute();
		$_SESSION['userType'] = "user";
		$_SESSION['username'] = $_POST['username'];
		$_SESSION['notification'] = "Sign up successful.";
		$_SESSION['notificationType'] = "success";
		exit(header("Location: ../"));
	}catch(PDOException $e){
		$_SESSION['notification'] = $e->getMessage();
		$_SESSION['notificationType'] = "error";
		exit(header("Location: index.php"));
	}
?>
