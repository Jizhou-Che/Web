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
	if(!isset($_POST['staffName_remove'])){
		// Error in $_POST.
		$_SESSION['notification'] = "Error in page redirection.";
		$_SESSION['notificationType'] = "error";
		exit(header("Location: ../../../"));
	}
	try{
		$conn = new PDO("mysql:host=localhost;dbname=scyjc1", "scyjc1", "Jizhou990528");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// Delete the respective staff.
		$stmt = $conn->prepare('DELETE FROM staff WHERE username = :staffName');
		$stmt->bindParam(':staffName', $_POST['staffName_remove']);
		$stmt->execute();
		$_SESSION['notification'] = "Staff deleted successfully.";
		$_SESSION['notificationType'] = "success";
		exit(header("Location: ../"));
	}catch(PDOException $e){
		$_SESSION['notification'] = $e->getMessage();
		$_SESSION['notificationType'] = "error";
		exit(header("Location: ../"));
	}
?>
