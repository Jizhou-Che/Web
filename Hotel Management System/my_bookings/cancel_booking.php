<?php
	session_start();
	if(!isset($_SESSION['userType'])){
		// Not logged in.
		$_SESSION['notification'] = "Permission denied.";
		$_SESSION['notificationType'] = "error";
		exit(header("Location: ../"));
	}
	if($_SESSION['userType'] != "user"){
		// Not a user.
		$_SESSION['notification'] = "Permission denied.";
		$_SESSION['notificationType'] = "error";
		exit(header("Location: ../"));
	}
	if(!(isset($_POST['roomNo']) && isset($_POST['checkInDate']))){
		// Error in $_POST.
		$_SESSION['notification'] = "Error in page redirection.";
		$_SESSION['notificationType'] = "error";
		exit(header("Location: ../"));
	}
	try{
		$conn = new PDO("mysql:host=localhost;dbname=scyjc1", "scyjc1", "Jizhou990528");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// Remove the respective booking.
		$stmt = $conn->prepare('DELETE FROM booking WHERE roomNo = :roomNo AND checkInDate = :checkInDate');
		$stmt->bindParam(':roomNo', $_POST['roomNo']);
		$stmt->bindParam(':checkInDate', $_POST['checkInDate']);
		$stmt->execute();
		$_SESSION['notification'] = "Booking cancelled.";
		$_SESSION['notificationType'] = "success";
		exit(header("Location: index.php"));
	}catch(PDOException $e){
		$_SESSION['notification'] = $e->getMessage();
		$_SESSION['notificationType'] = "error";
		exit(header("Location: index.php"));
	}
?>
