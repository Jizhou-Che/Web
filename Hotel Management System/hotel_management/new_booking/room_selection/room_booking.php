<?php
	session_start();
	if(!isset($_SESSION['userType'])){
		// Not logged in.
		$_SESSION['notification'] = "Permission denied.";
		$_SESSION['notificationType'] = "error";
		exit(header("Location: ../../../"));
	}
	if($_SESSION['userType'] == "user"){
		// Not a staff.
		$_SESSION['notification'] = "Permission denied.";
		$_SESSION['notificationType'] = "error";
		exit(header("Location: ../../../"));
	}
	if(!(isset($_POST['username']) && isset($_POST['passport']) && isset($_POST['roomNo']) && isset($_POST['checkInDate']) && isset($_POST['checkOutDate']))){
		// Error in $_POST.
		$_SESSION['notification'] = "Error in page redirection.";
		$_SESSION['notificationType'] = "error";
		exit(header("Location: ../../../"));
	}
	try{
		$conn = new PDO("mysql:host=localhost;dbname=scyjc1", "scyjc1", "Jizhou990528");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		// Select the first available room if user did not specify any.
		if($_POST['roomNo'] == ""){
			$stmt = $conn->prepare('SELECT roomNo FROM room WHERE type = :type AND roomNo NOT IN (SELECT roomNo FROM room NATURAL JOIN booking WHERE type = :type AND NOT (checkInDate >= :checkOutDate OR checkOutDate <= :checkInDate))');
			$stmt->bindParam(':type', $_POST['type']);
			$stmt->bindParam(':checkInDate', $_POST['checkInDate']);
			$stmt->bindParam(':checkOutDate', $_POST['checkOutDate']);
			$stmt->execute();
			$firstAvailableRoom = $stmt->fetch();
			if($firstAvailableRoom != NULL){
				$_POST['roomNo'] = $firstAvailableRoom['roomNo'];
			}else{
				// No room available.
				$_SESSION['notification'] = "Failed to book room: No room available.";
				$_SESSION['notificationType'] = "error";
				exit(header("Location: ../"));
			}
		}
		// Check for valid username.
		$stmt = $conn->prepare('SELECT * FROM user WHERE username = :username');
		$stmt->bindParam(':username', $_POST['username']);
		$stmt->execute();
		$user = $stmt->fetch();
		if($user == NULL){
			// User does not exist.
			$_SESSION['notification'] = "Failed to book room: User does not exist.";
			$_SESSION['notificationType'] = "error";
			exit(header("Location: ../"));
		}
		// Check for errors.
		$stmt = $conn->prepare('SELECT * FROM booking WHERE roomNo = :roomNo AND NOT (checkInDate >= :checkOutDate OR checkOutDate <= :checkInDate)');
		$stmt->bindParam(':roomNo', $_POST['roomNo']);
		$stmt->bindParam(':checkInDate', $_POST['checkInDate']);
		$stmt->bindParam(':checkOutDate', $_POST['checkOutDate']);
		$stmt->execute();
		$error = $stmt->fetchColumn(1);
		if($error != NULL){
			$_SESSION['notification'] = "Failed to book room: Room taken by someone else.";
			$_SESSION['notificationType'] = "error";
			exit(header("Location: ../"));
		}
		// Record the booking.
		$stmt = $conn->prepare('INSERT INTO booking VALUES (:username, :passport, :roomNo, :checkInDate, :checkOutDate)');
		$stmt->bindParam(':username', $_POST['username']);
		$stmt->bindParam(':passport', $_POST['passport']);
		$stmt->bindParam(':roomNo', $_POST['roomNo']);
		$stmt->bindParam(':checkInDate', $_POST['checkInDate']);
		$stmt->bindParam(':checkOutDate', $_POST['checkOutDate']);
		$stmt->execute();
		$_SESSION['notification'] = "Room booked successfully.";
		$_SESSION['notificationType'] = "success";
		exit(header("Location: ../"));
	}catch(PDOException $e){
		$_SESSION['notification'] = $e->getMessage();
		$_SESSION['notificationType'] = "error";
		exit(header("Location: ../"));
	}
?>
