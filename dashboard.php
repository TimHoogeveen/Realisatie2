<!doctype html>
<?php
	require 'connect.php';
	session_start();

  $id = $_SESSION['user'];
  $sql = $conn->prepare("SELECT * FROM `user` WHERE `user_ID`='$id'");
  $sql->execute();
  $fetch = $sql->fetch();
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
            <?php
              $stmt = $conn->prepare('SELECT * FROM `hond` WHERE `user_ID` = '. $_SESSION['user'] .'');
              $stmt->execute();
              $fetch = $stmt->fetch();
            ?>
                <?php
                    $sql = 'SELECT dogs_ID, hondenfoto, naam, leeftijd, ras FROM hond WHERE `user_ID` = '. $_SESSION['user'] .'';

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
                            <th>Voornaam</th>
                            <th>Achternaam</th>
                            <th>Positie</th>
                            <th>Goals</th>
                            <th>Assists</th>
                            <th>Gele kaarten</th>
                            <th>Rode kaarten</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                            <tr>
                                <td><?php echo ("<img src='./uploads/honden/".$row['hondenfoto']."'style='border-radius:5px; margin-bottom:5px;' width='100px' >"); ?></td>
                                <td><?php echo ($row['naam']); ?></td>
                                <td><?php echo ($row['leeftijd']); ?></td>
                                <td><?php echo ($row['ras']); ?></td>
                                <td>
                                    <form method="POST" class="dog-input-form">
                                        <input type="number" class="fieldprofile" id="doginput" name="age" class="dog-input-purple" value=<?php echo $row['leeftijd']?>>
                                        <input type="submit" class="button" name="dog_update" value="Update" class="dog_update_button">
                                        <input type="hidden" name="dogs_ID" class="dog-input-purple" value=<?php echo $row['dogs_ID']?>>
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" class="dog-delete-form">
                                        <input type="submit" class="button" name="dog_delete" value="Verwijderen" class="dog_delete_button">
                                        <input type="hidden" name="dogs_ID" class="dog-input-purple" value=<?php echo $row['dogs_ID']?>>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>