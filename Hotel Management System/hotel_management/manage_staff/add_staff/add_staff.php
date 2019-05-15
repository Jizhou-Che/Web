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
	if(!(isset($_POST['username']) && isset($_POST['password1']) && isset($_POST['realname']) && isset($_POST['ID']) && isset($_POST['tel']) && isset($_POST['email']) && isset($_POST['isAdmin']))){
		// Error in $_POST.
		$_SESSION['notification'] = "Error in page redirection.";
		$_SESSION['notificationType'] = "error";
		exit(header("Location: ../../../"));
	}
	try{
		$conn = new PDO("mysql:host=localhost;dbname=scyjc1", "scyjc1", "Jizhou990528");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// Check for duplication.
		$stmt = $conn->prepare('SELECT * FROM staff WHERE username = :username');
		$stmt->bindParam(':username', $_POST['username']);
		$stmt->execute();
		if(sizeof($stmt->fetchAll()) != 0){
			// Username already taken.
			$_SESSION['notification'] = "Failed to add staff: Username already taken.";
			$_SESSION['notificationType'] = "error";
			exit(header("Location: index.php"));
		}
		$stmt = $conn->prepare('SELECT * FROM staff WHERE ID = :ID');
		$stmt->bindParam(':ID', $_POST['ID']);
		$stmt->execute();
		if(sizeof($stmt->fetchAll()) != 0){
			// ID already taken.
			$_SESSION['notification'] = "Failed to add staff: Staff ID already taken.";
			$_SESSION['notificationType'] = "error";
			exit(header("Location: index.php"));
		}
		// Insert the new staff.
		$stmt = $conn->prepare('INSERT INTO staff VALUES (:username, :password, :realname, :ID, :tel, :email, :isAdmin)');
		$stmt->bindParam(':username', $_POST['username']);
		$stmt->bindParam(':password', $_POST['password1']);
		$stmt->bindParam(':realname', $_POST['realname']);
		$stmt->bindParam(':ID', $_POST['ID']);
		$stmt->bindParam(':tel', $_POST['tel']);
		$stmt->bindParam(':email', $_POST['email']);
		if($_POST['isAdmin'] == "Administrator"){
			$stmt->bindValue(':isAdmin', 1);
		}else{
			$stmt->bindValue(':isAdmin', 0);
		}
		$stmt->execute();
		$_SESSION['notification'] = "Staff added successfully.";
		$_SESSION['notificationType'] = "success";
		exit(header("Location: ../"));
	}catch(PDOException $e){
		$_SESSION['notification'] = $e->getMessage();
		$_SESSION['notificationType'] = "error";
		exit(header("Location: index.php"));
	}
?>
