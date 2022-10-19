<!doctype html>
<?php
	require 'connect.php';
	session_start();

  //$id = $_SESSION['user'];
  //$sql = $conn->prepare("SELECT * FROM `user` WHERE `user_ID`='$id'");
  //$sql->execute();
  //$fetch = $sql->fetch();
?>
<html>
    <head>
    <title>Dashboard</title>
    <link rel="icon" type="image/x-icon" href="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="">
    </head>
    <body>
    <div id="menugebied">
                <br>
                        <a class="button1" href="dashboard.php.php">Home</a><br>
                        <?php if($_SESSION["ROL"] == 1) : ?>
                    <a class="button1" href="<?= ('./invoeren.php') ?>"> Stats invoeren</a><br>
                    <a class="button1" href="<?= ('./logout.php') ?>"> Uitloggen</a>
                <?php else : ?>
                    <a class="button1" href="<?= ('./invoeren.php') ?>">Stats invoeren</a><br>
                    <a class="button1" href="<?= ('./logout.php') ?>"> Uitloggen</a>
                <?php endif; ?>
                         
            </div>
                <?php
                    $sql = 'SELECT naam, goals, assists, team FROM user';

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
                            <th>Team</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                            <tr>
                                <td><?php echo ($row['naam']); ?></td>
                                <td><?php echo ($row['goals']); ?></td>
                                <td><?php echo ($row['assists']); ?></td>
                                <td><?php echo ($row['team']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>