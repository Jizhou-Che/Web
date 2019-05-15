<?php
	session_start();
	if(!isset($_SESSION['userType'])){
		// Not logged in.
		$_SESSION['notification'] = "You are not logged in.";
		$_SESSION['notificationType'] = "error";
		exit(header("Location: ../../"));
	}
	if($_SESSION['userType'] == "user"){
		// Not a staff.
		$_SESSION['notification'] = "You are not logged in as a staff.";
		$_SESSION['notificationType'] = "error";
		exit(header("Location: ../../"));
	}
	if(!(isset($_POST['password0']) && isset($_POST['password1']))){
		// Error in $_POST.
		$_SESSION['notification'] = "Error in page redirection.";
		$_SESSION['notificationType'] = "error";
		exit(header("Location: ../../"));
	}
	try{
		$conn = new PDO("mysql:host=localhost;dbname=scyjc1", "scyjc1", "Jizhou990528");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// Select the respective staff.
		$stmt = $conn->prepare('SELECT * FROM staff WHERE username = :username');
		$stmt->bindParam(':username', $_SESSION['username']);
		$stmt->execute();
		// Comepare the password.
		$password = $stmt->fetchColumn(1);
		if($password == $_POST['password0']){
			// Update password for the staff.
			$stmt = $conn->prepare('UPDATE staff SET password = :newPassword WHERE username = :username');
			$stmt->bindParam(':username', $_SESSION['username']);
			$stmt->bindParam(':newPassword', $_POST['password1']);
			$stmt->execute();
			$_SESSION['notification'] = "Password updated successfully.";
			$_SESSION['notificationType'] = "success";
			exit(header("Location: ../"));
		}else{
			// Wrong password.
			$_SESSION['notification'] = "Failed to update password: Wrong password.";
			$_SESSION['notificationType'] = "error";
			exit(header("Location: index.php"));
		}
	}catch(PDOException $e){
		$_SESSION['notification'] = $e->getMessage();
		$_SESSION['notificationType'] = "error";
		exit(header("Location: index.php"));
	}
?>
