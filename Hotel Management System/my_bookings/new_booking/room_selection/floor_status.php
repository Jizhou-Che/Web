<?php
	session_start();
	if(!isset($_SESSION['userType'])){
		// Not logged in.
		$_SESSION['notification'] = "Permission denied.";
		$_SESSION['notificationType'] = "error";
		exit(header("Location: ../../../"));
	}
	if($_SESSION['userType'] != "user"){
		// Not a user.
		$_SESSION['notification'] = "Permission denied.";
		$_SESSION['notificationType'] = "error";
		exit(header("Location: ../../../"));
	}
	if(!(isset($_POST['type']) && isset($_POST['floor']) && isset($_POST['checkInDate']) && isset($_POST['checkOutDate']))){
		// Error in $_POST.
		$_SESSION['notification'] = "Error in page redirection.";
		$_SESSION['notificationType'] = "error";
		exit(header("Location: ../../../"));
	}
	try{
		$conn = new PDO("mysql:host=localhost;dbname=scyjc1", "scyjc1", "Jizhou990528");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// Select rooms of given type and floor available during given staying period.
		$stmt = $conn->prepare('SELECT roomNo FROM room WHERE type = :type AND floor = :floor AND roomNo NOT IN (SELECT roomNo FROM room NATURAL JOIN booking WHERE type = :type AND floor = :floor AND NOT (checkInDate >= :checkOutDate OR checkOutDate <= :checkInDate))');
		$stmt->bindParam(':type', $_POST['type']);
		$stmt->bindParam(':floor', $_POST['floor']);
		$stmt->bindParam(':checkInDate', $_POST['checkInDate']);
		$stmt->bindParam(':checkOutDate', $_POST['checkOutDate']);
		$stmt->execute();
		$roomsAvailable = $stmt->fetchAll();
		echo(json_encode($roomsAvailable));
	}catch(PDOException $e){
		$_SESSION['notification'] = $e->getMessage();
		$_SESSION['notificationType'] = "error";
		exit(header("Location: ../"));
	}
?>
