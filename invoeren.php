<!doctype html>
<?php
	require 'connect.php';
	session_start();

  //$sql = $conn->prepare("SELECT * FROM `user` WHERE `user_ID`='$id'");
  //$sql->execute();
  //$fetch = $sql->fetch();

    if(ISSET($_POST['goals_update'])){
		if($_POST['goals'] != ""){
			try{
        $goals = $_POST['goals'];
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "UPDATE user SET goals='$goals'";
				$conn->exec($sql);
			}catch(PDOException $e){
				echo $e->getMessage();
			}
			$_SESSION['message']=array("text"=>"Goals succesvol ingevoerd!","alert"=>"info");
			$conn = null;
			header('location:invoeren.php');
			exit();
		}else{
			echo "
				<script>alert('Vul alle velden in!')</script>
				<script>window.location = 'invoeren.php'</script>
			";
		}
	}

  if(ISSET($_POST['assists_update'])){
		if($_POST['assists'] != ""){
			try{
        $assists = $_POST['assists'];
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "UPDATE user SET assists='$assists'";
				$conn->exec($sql);
			}catch(PDOException $e){
				echo $e->getMessage();
			}
			$_SESSION['message']=array("text"=>"Assists succesvol ingevoerd!","alert"=>"info");
			$conn = null;
			header('location:invoeren.php');
			exit();
		}else{
			echo "
				<script>alert('Vul alle velden in!')</script>
				<script>window.location = 'invoeren.php'</script>
			";
		}
	}
?>
<html>
    <head>
    <title>Stats invoeren</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>
    <div id="pagina">
        <div id="bovenbalk"><h2>Stats invoeren</h2></div>
        <div id="menugebied">
                <br>
                        <a class="button1" href="./dashboard.php">Home</a><br>
                        <a class="button1" href="./invoeren.php">Stats Invoeren</a><br>
                        <a class="button1" href="profiel.php">Mijn profiel</a><br>
                        <a class="button1" href="logout.php">Uitloggen</a> 
            </div>
                <?php
                    $sql = 'SELECT user_ID, naam, goals, assists FROM user';

                    try{
                        $stmt = $conn->query($sql);
                        
                        if($stmt === false){
                        die("Error");
                        }
                        
                    }catch (PDOException $e){
                        echo $e->getMessage();
                    }
                ?>
                <table width="100%">
                    <thead>
                        <tr>
                            <th>Naam</th>
                            <th>Goals</th>
                            <th>Assists</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                            <tr>
                                <td><?php echo ($row['naam']); ?></td>
                                <td>
                                    <form method="POST" class="dog-input-form">
                                        <input type="number" class="fieldprofile" id="goals" name="goals" class="" value=<?php echo $row['goals']?>>
                                        <input type="submit" class="button" name="goals_update" value="Update" class="">
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" class="dog-input-form">
                                        <input type="number" class="fieldprofile" id="assists" name="assists" class="" value=<?php echo $row['assists']?>>
                                        <input type="submit" class="button" name="assists_update" value="Update" class="">
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>