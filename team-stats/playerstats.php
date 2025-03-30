<?php
session_start();
require_once "../connect.php";
$db= new PDO(DNS, LOGIN, PASSWORD, $options);
include "../permission.inc.php";
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="Stylesheet" href="../css/css.css">
        <link rel="stylesheet" href="../css/pico.min.css">
        <title>Player Stats</title>
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
                if (isset($_GET['playerID'])&& !empty($_GET['playerID'])) { 
                    
                    //SQl request that links my player to his stats page inside of my database and the team name they are on.

                    $sql= 'SELECT M.Nom, M.Prenom, M.NumeroMaillot, M.Role, AVG(P.Points) AS Points, AVG(P.Assists) AS Assists, AVG(P.Rebonds) AS Rebounds
                        FROM Membre M INNER JOIN Performance P ON M.MembreID = P.MembreID
                        INNER JOIN MembresEquipe ME ON M.MembreID = ME.MembreID
                        INNER JOIN Equipe E ON ME.EquipeID = E.EquipeID WHERE M.MembreID = :playerID';
                    $statement = $db->prepare($sql);
                    $statement->bindParam(':playerID', $_GET['playerID']); //bind my parameter above to teamid
                    $statement->execute();
                    echo 
                    '<table>
                        <tr>
                            <th> First Name </th>
                            <th> Last Name </th>
                            <th> Position </th>
                            <th> Jeresy Number</th> 
                            <th> AVG Points </th>
                            <th> AVG Assists </th>
                            <th> AVG Reboudns </th>
                        </tr>';
                            
                    while ($row = $statement->fetch()) {
                        echo 
                        '<tr> 
                            <td>'.$row['Prenom'].'</td>
                            <td>'.$row['Nom'].'</td>
                            <td>'.$row['Role'].'</td>
                            <td>'.$row['NumeroMaillot'].'</td>
                            <td>'.$row['Points'].'</td>
                            <td>'.$row['Assists'].'</td>
                            <td>'.$row['Rebounds'].'</td>
                        </tr>';
                    }
                    echo '</table>';

                    $sqlChart1='SELECT R.RencontreID, R.ScoreEquipe1 AS S1, R.ScoreEquipe2 AS S2, R.Lieu, E1.NomEquipe AS E1,  R.DateRencontre, 
                    J1.EST_GAGNANT AS W1, J2.EST_GAGNANT AS W2, E2.NomEquipe AS E2 FROM Membre AS M
                    INNER JOIN MembresEquipe AS ME ON M.MembreID = ME.MembreID
                    INNER JOIN Equipe AS E1 ON ME.EquipeID = E1.EquipeID  
                    INNER JOIN Jouer AS J1 ON J1.EquipeID = E1.EquipeID  
                    INNER JOIN Rencontre AS R ON J1.RencontreID = R.RencontreID  
                    INNER JOIN Jouer AS J2 ON J2.RencontreID = R.RencontreID  
                    INNER JOIN Equipe AS E2 ON J2.EquipeID = E2.EquipeID  
                    WHERE M.MembreID = :id  AND J1.EquipeID != J2.EquipeID  
                    ORDER BY R.DateRencontre DESC';
                    
                    $statementChart= $db->prepare($sqlChart1);
                    $statementChart->bindParam(':id',$_GET['playerID']);
                    $statementChart->execute();

                    echo 
                    '<table> 
                        <legend class="ha2">Match List</legend>
                        <tr> 
                            <th>Equipe1</th>
                            <th>Score1</th>
                            <th>Score2</th>
                            <th>Equipe 2</th>
                            <th>Date</th>
                            <th>Information</th>
                        </tr>';
                    
                    while($row=$statementChart->fetch()){    
                        echo 
                        '<tr> 
                            <td>'.$row['E2'].'</td>
                            <td>'.$row['S1'].'</td>
                            <td>'.$row['S2'].'</td>
                            <td>'.$row['E1'].' </td>
                            <td>'.$row['DateRencontre'].'</td>
                            <td> <a href="../game-management/performance.php?match='.$row['RencontreID'].'">More Information </a> </td>
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