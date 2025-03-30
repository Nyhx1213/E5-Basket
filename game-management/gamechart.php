<?php
session_start(); 
require_once "../connect.php";
$db = new PDO(DNS, LOGIN, PASSWORD, $options);
include "../permission.inc.php";
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Game Chart</title>
        <link rel="stylesheet" href="../css/css.css">
        <link rel="stylesheet" href="../css/pico.min.css">
    </head>
    <body>
        <header>
            <nav>
            <ul>
                <li>
                <?php if(isset($_SESSION['login'])){
                        echo'<a href="../profile.php">Welcome '.$_SESSION['login'].'</a>';
                    }
                ?>
                </li>
            </ul>
            <ul>
                <li>
                    <strong><a href="../index.php">Basketball Management Application</a></strong>
                </li>
            </ul>
            <ul>
                <li> 
                    <?php if(isset($_SESSION['login'])){
                        echo'<a href="../disconnect.php"> Disconnect</a>';
                    }
                        else echo '<a href="../index.php">Login</a>';
                    ?>
                </li>
            </ul>
            </nav>
        </header>
        <main>
            <?php 
            try {
                //echo '<h1>G</h1>';

                // SQL query to join the tables for game details
                if(!isset($_GET['sort'])){

                    $sql = 'SELECT E1.NomEquipe as e1, E2.NomEquipe as e2, R.ScoreEquipe1, R.ScoreEquipe2, 
                                R.DateRencontre, J1.EST_GAGNANT as w1, J2.EST_GAGNANT as w2, R.RencontreID, R.Lieu
                            FROM Rencontre as R
                            INNER JOIN Jouer as J1 ON R.RencontreID = J1.RencontreID
                            INNER JOIN Equipe as E1 ON J1.EquipeID = E1.EquipeID
                            INNER JOIN Jouer as J2 ON R.RencontreID = J2.RencontreID
                            INNER JOIN Equipe as E2 ON J2.EquipeID = E2.EquipeID
                            WHERE J1.EquipeID > J2.EquipeID AND (R.ScoreEquipe1 IS NOT NULL OR R.ScoreEquipe2 IS NOT NULL)
                            ORDER BY R.DateRencontre DESC';
                }
                else {
                    $sql = 'SELECT E1.NomEquipe as e1, E2.NomEquipe as e2, R.ScoreEquipe1, R.ScoreEquipe2, 
                                R.DateRencontre, J1.EST_GAGNANT as w1, J2.EST_GAGNANT as w2, R.RencontreID, R.Lieu
                            FROM Rencontre as R
                            INNER JOIN Jouer as J1 ON R.RencontreID = J1.RencontreID
                            INNER JOIN Equipe as E1 ON J1.EquipeID = E1.EquipeID
                            INNER JOIN Jouer as J2 ON R.RencontreID = J2.RencontreID
                            INNER JOIN Equipe as E2 ON J2.EquipeID = E2.EquipeID
                            WHERE J1.EquipeID > J2.EquipeID 
                            AND (R.ScoreEquipe1 IS NOT NULL OR R.ScoreEquipe2 IS NOT NULL)';
                    
                    switch($_GET['sort']){
                        case 1: $sql .= ' ORDER BY R.DateRencontre DESC'; break;
                        case 2: $sql .= ' ORDER BY R.DateRencontre ASC'; break;   
                    }
                }

                $statement = $db->prepare($sql);
                $statement->execute();

                echo 
                '<table>
                        <tr>
                            <th>Date <a href="gamechart.php?sort=1" class="arrow"> &uarr; </a> <a href="gamechart.php?sort=2" class="arrow"> &darr; </a></th>
                            <th>Equipe 1</th>
                            <th>Score</th>
                            <th>Equipe 2</th>
                            <th>Lieu</th>
                            <th>Performance</th>
                            <th>Modify</th>';
                            if ($_SESSION['roleid'] == 1 || $_SESSION['roleid'] == 2){
                                echo '<th>Delete</th>';
                            }
                        echo '</tr>';

                // Display games data
                while ($row = $statement->fetch()) {
                    // Logic to display the winner first and order scores accordingly
                    if ($row['w1'] == 1) { //If the team on the first row is the winner then 

                        //onclick permet d'avoir le message de confirmation.
                        
                        if ($row['ScoreEquipe1'] > $row['ScoreEquipe2']) {
                            echo 
                            '<tr>
                                <td>'.$row['DateRencontre'].'</td>
                                <td>'.$row['e1'].'</td>
                                <td> <span class="won">'.$row['ScoreEquipe1'].'</span> - <span class="lost">'.$row['ScoreEquipe2'].'</span></td>
                                <td>'.$row['e2'].'</td>
                                <td>'.$row['Lieu'].'</td>
                                <td><a href="performance.php?match='.$row['RencontreID'].'">Performance</a></td>
                                <td><a href="modifygame.php?matchid='.$row['RencontreID'].'">Modify</a></td>';
                                if ($_SESSION['roleid'] == 1 || $_SESSION['roleid'] == 2){
                                echo '<td><a href="deletegame.php?gameid='.$row['RencontreID'].'" onclick="return confirm(\'Are you sure you want to delete this game?\')"><button class="button-suppression">X</button></a></td>';
                                }
                                echo '</tr>';
                        }
                        else {
                            echo 
                            '<tr>
                                <td>' . $row['DateRencontre'] . '</td>
                                <td>' . $row['e1'] . '</td>
                                <td>'.$row['ScoreEquipe2'].' - '.$row['ScoreEquipe1'].'</td>
                                <td>' . $row['e2'] . '</td>
                                <td>' . $row['Lieu'] . '</td>
                                <td><a href="performance.php?match=' . $row['RencontreID'] . '">Performance</a></td>
                                <td><a href="modifygame.php?matchid='.$row['RencontreID'].'">Modify</a></td>';
                                if ($_SESSION['roleid'] == 1 || $_SESSION['roleid'] == 2){
                                    echo '<td><a href="deletegame.php?gameid='.$row['RencontreID'].'" onclick="return confirm(\'Are you sure you want to delete this game?\')"><button class="button-suppression">X</button></a></td>';
                                }
                                echo '</tr>';
                        }
                    } 
                    elseif ($row['w2'] == 1) { //If the team in the second row is the winner and not on the first row.

                        if ($row['ScoreEquipe1'] > $row['ScoreEquipe2']) {
                            echo 
                            '<tr>
                                <td>' . $row['DateRencontre'] . '</td>
                                <td>' . $row['e2'] . '</td>
                                <td>'.$row['ScoreEquipe1'].' - '.$row['ScoreEquipe2'].'</td>
                                <td>' . $row['e1'] . '</td>
                                <td>' . $row['Lieu'] . '</td>
                                <td><a href="performance.php?match=' . $row['RencontreID'] . '">Performance</a></td>
                                <td><a href="modifygame.php?matchid='.$row['RencontreID'].'">Modify</a></td>';
                                if ($_SESSION['roleid'] == 1 || $_SESSION['roleid'] == 2){
                                    echo '<td><a href="deletegame.php?gameid='.$row['RencontreID'].'" onclick="return confirm(\'Are you sure you want to delete this game?\')"><button class="button-suppression">X</button></a></td>';
                                }
                                echo '</tr>';
                        } 
                        else {
                            echo 
                            '<tr>
                                <td>' . $row['DateRencontre'] . '</td>
                                <td>' . $row['e2'] . '</td>
                                <td>'.$row['ScoreEquipe2'].' - '.$row['ScoreEquipe1'].'</td>
                                <td>' . $row['e1'] . '</td>
                                <td>' . $row['Lieu'] . '</td>
                                <td><a href="performance.php?match=' . $row['RencontreID'] . '">Performance</a></td>
                                <td><a href="modifygame.php?matchid='.$row['RencontreID'].'">Modify</a></td>';
                                if ($_SESSION['roleid'] == 1 || $_SESSION['roleid'] == 2){
                                    echo '<td><a href="deletegame.php?gameid='.$row['RencontreID'].'" onclick="return confirm(\'Are you sure you want to delete this game?\')"><button class="button-suppression">X</button></a></td>';
                                }
                                echo '</tr>';
                        }
                    } 
                    else {
                        // If it's a tie
                        echo 
                        '<tr>
                            <td>' . $row['DateRencontre'] . '</td>
                            <td>' . $row['e1'] . '</td>
                            <td>'.$row['ScoreEquipe1'].' - '.$row['ScoreEquipe2'].'</td>
                            <td>' . $row['e2'] . '</td>
                            <td>' . $row['Lieu'] . '</td>
                            <td><a href="performance.php?match=' . $row['RencontreID'] . '">Performance</a></td>
                            <td><a href="modifygame.php?matchid='.$row['RencontreID'].'">Modify</a></td>';
                            if ($_SESSION['roleid'] == 1 || $_SESSION['roleid'] == 2){
                                echo '<td><a href="deletegame.php?gameid='.$row['RencontreID'].'" onclick="return confirm(\'Are you sure you want to delete this game?\')"><button class="button-suppression">X</button></a></td>';
                            }
                            echo '</tr>';
                    }
                }

                echo '</table>';
                $statement->closeCursor();
                $db = null;

            } catch (PDOException $e) {
                echo '<div class="message error"><h2>Error: ' . $e->getMessage() . '</h2></div>';
            }
            ?>
        </main>
    </body>
</html>
