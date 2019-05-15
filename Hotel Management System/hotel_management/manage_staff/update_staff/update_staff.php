<?php
	session_start();
	if(!isset($_SESSION['userType'])){
		// Not logged in.
		$_SESSION['notification'] = "Permission denied.";
		$_SESSION['notificationType'] = "error";
		exit(header("Location: ../../../"));
	}
	if($_SESSION['userType'] != "administrator"){
		// Not administrator.
		$_SESSION['notification'] = "Permission denied.";
		$_SESSION['notificationType'] = "error";
		exit(header("Location: ../../../"));
	}
	if(!(isset($_POST['realname']) && isset($_POST['ID']) && isset($_POST['tel']) && isset($_POST['email']) && isset($_POST['isAdmin']) && isset($_POST['staffName_update']))){
		// Error in $_POST.
		$_SESSION['notification'] = "Error in page redirection.";
		$_SESSION['notificationType'] = "error";
		exit(header("Location: ../../../"));
	}
	try{
		$conn = new PDO("mysql:host=localhost;dbname=scyjc1", "scyjc1", "Jizhou990528");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// Check for duplicate ID.
		$stmt = $conn->prepare('SELECT * FROM staff WHERE username != :username AND ID = :ID');
		$stmt->bindParam(':username', $_POST["staffName_update"]);
		$stmt->bindParam(':ID', $_POST["ID"]);
		$stmt->execute();
		if(sizeof($stmt->fetchAll()) != 0){
			// Staff ID already taken.
			$_SESSION['notification'] = "Failed to update staff profile: Staff ID already taken.";
			$_SESSION['notificationType'] = "error";
			exit(header("Location: ../"));
		}
		// Update profile for the staff.
		$stmt = $conn->prepare('UPDATE staff SET realname = :realname, ID = :ID, tel = :tel, email = :email, isAdmin = :isAdmin WHERE username = :username');
		$stmt->bindParam(':realname', $_POST['realname']);
		$stmt->bindParam(':ID', $_POST['ID']);
		$stmt->bindParam(':tel', $_POST['tel']);
		$stmt->bindParam(':email', $_POST['email']);
		if($_POST['isAdmin'] == "Administrator"){
			$stmt->bindValue(':isAdmin', 1);
		}else{
			$stmt->bindValue(':isAdmin', 0);
		}
		$stmt->bindParam(':username', $_POST["staffName_update"]);
		$stmt->execute();
		$_SESSION['notification'] = "Staff profile updated.";
		$_SESSION['notificationType'] = "success";
		exit(header("Location: ../"));
	}catch(PDOException $e){
		$_SESSION['notification'] = $e->getMessage();
		$_SESSION['notificationType'] = "error";
		exit(header("Location: ../"));
	}
?>
