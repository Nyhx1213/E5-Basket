<?php 
session_start();
require_once "connect.php";
$db= new PDO(DNS, LOGIN, PASSWORD, $options);
require_once "permission.inc.php";
?>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css.css">
    <link rel="stylesheet" href="pico.min.css">
    <title>Manage Game</title>
</head>
    
<body>       
<header>
    <nav>
    <ul>
        <li>
        <?php if(isset($_SESSION['login'])){
                echo'<a href="profile.php">Welcome '.$_SESSION['login'].'</a>';
            }
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
    <h1 class="title">Games not played/filled</h1>
    <table> 
            <tr>
                <th>Date</th>
                <th>Participants</th>
                <th>Lieu</th>
                <th>Modifier</th>
            </tr>
        <?php
            $sqlchart = 'SELECT R.DateRencontre, R.Lieu, E.NomEquipe as Equipe1, E.NomEquipe as Equipe2 FROM Rencontre as R
                    INNER JOIN JOUER as J ON R.RencontreID = J.RencontreID
                    INNER JOIN Equipe as E ON J.EquipeID = E.EquipeID
                    WHERE J.Score = null';
                    
            $statementchart= $db->prepare($sqlchart);
            $statementchart->execute();

            while($row=$statementchart->fetch()){
                echo
                '<tr>
                    <td>'.$row['R.DateRencontre'].'</td>
                    <td>.'.$row['Equipe1'].'-'.$row['Equipe2'].'</td>
                    <td>.'.$row['R.Lieu'].'</td>
                    <td> link </td>
                <tr>';
            }


        ?>
    </table>


</main>
</body>
</html>