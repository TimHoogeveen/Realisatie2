<?php
	session_start();
	require_once 'connect.php';
	
	if(ISSET($_POST['inschrijven'])){
		$name = $_POST['naam'];
		$email = $_POST['email'];
		$password = md5($_POST['wachtwoord']);

		$stmt = $conn->prepare("INSERT INTO voetbal_stats2.user (naam, email, wachtwoord) VALUES ('$name', '$email', '$password');");
		$stmt->execute();
		header("location: ./inloggen.php");
	}
?>