<!doctype html>
<?php
	require 'connect.php';
	session_start();

  $id = $_SESSION['user'];
  $sql = $conn->prepare("SELECT * FROM `user` WHERE `user_ID`='$id'");
  $sql->execute();
  $fetch = $sql->fetch();

  if(ISSET($_POST['update-profiel'])){
		if($_POST['leeftijd-update'] != ""){
			try{
        $email = $_POST['email-update'];
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "UPDATE user SET email='$email' WHERE user_ID='$id'";
				$conn->exec($sql);
			}catch(PDOException $e){
				echo $e->getMessage();
			}
			$_SESSION['message']=array("text"=>"Gebruiker succesvol geupdate!","alert"=>"info");
			$conn = null;
			header('location:profiel.php');
      exit();
		}else{
			echo "
				<script>alert('Vul alle velden in!')</script>
				<script>window.location = 'profiel.php'</script>
			";
		}
	}
?>
<html>
    <head>
    <title>Dinder - Mijn Profiel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>
    <div id="pagina">
        <div id="bovenbalk"><h2>Mijn Profiel</h2></div>
        <div id="menugebied">
                <br>
                        <a class="button1" href="./dashboard.php">Home</a><br>
                        <a class="button1" href="./invoeren.php">Stats Invoeren</a><br>
                        <a class="button1" href="profiel.php">Mijn profiel</a><br>
                        <a class="button1" href="logout.php">Uitloggen</a> 
            </div>
          <br><br><h5><?php echo $fetch['naam']; ?></h5></div><br>
          <div id="info">E-mail adres:</div>
          <form method="POST">
          <div id="gegevens">
            <input type="email" class="fieldprofile" name="email-update" placeholder="E-mail adres" value=<?php echo $fetch['email'] ?>>
          </div><br>
          <input type="submit" name="update-profiel" class="button" value="Updaten">
        </form>
                