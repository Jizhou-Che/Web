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
		// Select the respective staff.
		$stmt = $conn->prepare('SELECT * FROM staff WHERE username = :username');
		$stmt->bindParam(':username', $_POST['username']);
		$stmt->execute();
		$staff = $stmt->fetch();
		if($staff == NULL){
			// Staff does not exist.
			$_SESSION['notification'] = "Log in failed: Staff does not exist.";
			$_SESSION['notificationType'] = "error";
			exit(header("Location: index.php"));
		}else{
			if($staff['password'] == $_POST['password']){
				// Log in successful.
				if($staff['isAdmin'] == TRUE){
					$_SESSION['userType'] = "administrator";
				}else{
					$_SESSION['userType'] = "staff";
				}
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
