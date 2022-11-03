<?php
	session_start();
 
	require_once 'connect.php';
 
	if(ISSET($_POST['login'])){
		if($_POST['email-inlog'] != "" || $_POST['password-inlog'] != ""){
			$email = $_POST['email-inlog'];
			$password = md5($_POST['password-inlog']);
			$sql = "SELECT * FROM `user` WHERE `email`=? AND `wachtwoord`=? ";
			$query = $conn->prepare($sql);
			$query->execute(array($email,$password));
			$row = $query->rowCount();
			$fetch = $query->fetch();
			if($row > 0) {
				$_SESSION['username'] = $fetch['gebruikersnaam'];
				$_SESSION['user'] = $fetch['user_ID'];
				$_SESSION["ROL"] = $result["is_admin"];
				header("location: dashboard.php");
			} else{
				echo "
				<script>alert('Gebruikersnaam of wachtwoord incorrect!')</script>
				<script>window.location = 'inloggen.php'</script>
				";
			}
		}else{
			echo "
				<script>alert('Gelieve alle velden in te vullen!')</script>
				<script>window.location = 'inloggen.php'</script>
			";
		}
	}
	/* */
?>