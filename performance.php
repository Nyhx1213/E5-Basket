<?php 
session_start();
require_once "connect.php";
$db= new PDO(DNS, LOGIN, PASSWORD, $options);
include "permission.inc.php";
?>
<!DOCTYPE html>
<head>
    <title>Performance</title>
    <meta charset="UTF-8">
    <link rel="Stylesheet" href="css.css">
    <link rel="stylesheet" href="pico.min.css">
</head>
<body>
<header>
    <nav>
    <ul>
        <li>
        <?php if(isset($_SESSION['login'])){
                echo'<a href="profile.php">Welcome '.$_SESSION['login'].'</a>';
            }
            else echo '';
        ?>
        </li>
    </ul>
    <ul>
        <li>
            <strong><a href="index.php">Basketball Management Application</a></strong>
        </li>
    </ul>
    <ul>
        <li> 
            <?php if(isset($_SESSION['login'])){
                echo'<a href="disconnect.php"> Disconnect</a>';
            }
                else echo '<a href="index.php">Login</a>';
            ?>
        </li>
    </ul>
    </nav>
</header>
<main>
    <?php
    try {
    if(isset($_GET['match'])){

        $sql= 'SELECT M.Nom, P.Points, P.Assists, P.Rebonds, P.MinutesJouees as MJ, E.NomEquipe as N
           FROM PERFORMANCE as P 
           INNER JOIN Membre as M ON P.MembreID=M.MembreID
           INNER JOIN MembresEquipe as ME ON M.MembreID=ME.MembreID
           INNER JOIN Equipe as E ON ME.EquipeID=E.EquipeID
           WHERE P.RencontreID=:rID'; //Makes it so it selects data based on the team the member is in based on the match I chose.
        $statement= $db->prepare($sql);
        $statement->bindParam(':rID',$_GET['match']); 
        $statement->execute();
    
        echo
        '<table>
            <tr>
                <th>Name</th>
                <th>Team</th>
                <th>Points</th>
                <th>Assists</th>
                <th>Rebounds</th>
                <th>Time Played</th>
            
                </tr>';
    while($row=$statement->fetch()){
        
        echo 
        '<tr>
            <td>'.$row['Nom'].'</td>
            <td>'.$row['N'].'</td>
            <td>'.$row['Points'].'</td>
            <td>'.$row['Assists'].'</td>
            <td>'.$row['Rebonds'].'</td>
            <td>'.$row['MJ'].'</td>
        </tr>';
    }

    echo '</table>';
    $statement->closeCursor();
    $db=null;
        }
    }
    catch (PDOException $e){
        echo('echec :'.$e->getMessage());
    }
    ?> 
</main>
</body>
</html>