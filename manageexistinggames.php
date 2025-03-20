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
            /*The SQL Query below is going to get the names of each team that has no score implemented yet in a table. 
              The link on the side sends the user to a form where he can add a score to the matches. */

            $sqlchart = 'SELECT  R.RencontreID ,R.DateRencontre, R.Lieu, E1.NomEquipe as Equipe1, E2.NomEquipe as Equipe2 FROM Rencontre as R
                         INNER JOIN Jouer as J1 ON R.RencontreID = J1.RencontreID
                         INNER JOIN Equipe as E1 ON J1.EquipeID = E1.EquipeID
                         INNER JOIN Jouer as J2 ON R.RencontreID = J2.RencontreID
                         INNER JOIN Equipe as E2 ON J2.EquipeID = E2.EquipeID
                         WHERE (J1.Score IS NULL OR J2.Score IS NULL) AND J1.EquipeID > J2.EquipeID
                         ORDER BY R.DateRencontre desc';

            $statementchart= $db->prepare($sqlchart);
            $statementchart->execute();

            while($row=$statementchart->fetch()){
                echo
                '<tr>
                    <td>'.$row['DateRencontre'].'</td>
                    <td>'.$row['Equipe1'].'-'.$row['Equipe2'].'</td>
                    <td>'.$row['Lieu'].'</td>
                    <td><a href="modify.php?idRencontre='.$row['RencontreID'].'">Link</a></td>
                <tr>';
            }
            $statementchart->closeCursor();
            $db=null;
        ?>
    </table>
</main>
</body>
</html>