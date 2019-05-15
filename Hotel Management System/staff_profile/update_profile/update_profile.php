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
	if(!(isset($_POST['realname']) && isset($_POST['tel']) && isset($_POST['email']))){
		// Error in $_POST.
		$_SESSION['notification'] = "Error in page redirection.";
		$_SESSION['notificationType'] = "error";
		exit(header("Location: ../../"));
	}
	try{
		$conn = new PDO("mysql:host=localhost;dbname=scyjc1", "scyjc1", "Jizhou990528");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// Update profile for the staff.
		$stmt = $conn->prepare('UPDATE staff SET realname = :realname, tel = :tel, email = :email WHERE username = :username');
		$stmt->bindParam(':realname', $_POST['realname']);
		$stmt->bindParam(':tel', $_POST['tel']);
		$stmt->bindParam(':email', $_POST['email']);
		$stmt->bindParam(':username', $_SESSION['username']);
		$stmt->execute();
		$_SESSION['notification'] = "Profile updated successfully.";
		$_SESSION['notificationType'] = "success";
		exit(header("Location: ../"));
	}catch(PDOException $e){
		$_SESSION['notification'] = $e->getMessage();
		$_SESSION['notificationType'] = "error";
		exit(header("Location: index.php"));
	}
?>
