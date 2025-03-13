<?php 
session_start();
require_once "connect.php";
$db= new PDO(DNS, LOGIN, PASSWORD, $options);
include "permission.inc.php";
?>
<!DOCTYPE html>
    <head>
        <title>Teams</title>
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
            //Fetches my teams
            $sql= 'SELECT * FROM Equipe';
            //$sql= 'SELECT * FROM Equipe INNER JOIN JOUER ON Equipe.EquipeID = JOUER.EquipeID'; 
            $statement= $db->prepare($sql);

            //This will enable me to get the number of victories.
            $sqlWIN= 'SELECT count(EST_GAGNANT) FROM JOUER WHERE EquipeID=:equipeid AND EST_GAGNANT=1';
            $statementWIN=$db->prepare($sqlWIN);

            //This will enable me to get the number of losses.
            $sqlLOSS= 'SELECT count(EST_GAGNANT) FROM JOUER WHERE EquipeID=:equipeid AND EST_GAGNANT=0';
            $statementLOSS=$db->prepare($sqlLOSS);

            //This will enable me to get the number of ties.
            $sqlTIE= 'SELECT count(EST_GAGNANT) FROM JOUER WHERE EquipeID=:equipeid AND EST_GAGNANT=-1';
            $statementTIE=$db->prepare($sqlTIE);
            

            $statement->execute();

            echo 
            '<table> 
                <tr> 
                    <th> Team </th>
                    <th> City </th>
                    <th> Wins </th> 
                    <th> Losses </th>
                    <th> Ties </th>
                    <th> Lineup </th>
                </tr>';
                    
            //Start of the table building (fetch)
            while($row=$statement->fetch()){
                //bind param for win
                $statementWIN->bindParam(':equipeid', $row['EquipeID']);
    
                //bind param for loss
                $statementLOSS->bindParam(':equipeid', $row['EquipeID']);
                
                //bind param for tie
                $statementTIE->bindParam(':equipeid', $row['EquipeID']);

                $statementWIN->execute();
                $statementLOSS->execute();
                $statementTIE->execute();

                $wins = $statementWIN->fetchColumn();  
                $losses = $statementLOSS->fetchColumn();  
                $ties = $statementTIE->fetchColumn();
                //CHANGE THE LINKS
                echo   
                '<tr> 
                    <td>'.$row['NomEquipe'].'</td>
                    <td>'.$row['Ville'].'</td>
                    <td>'.$wins.'</td>
                    <td>'.$losses.'</td>
                    <td>'.$ties.'</td>
                    <td><a href="tdetails.php?teamID='.$row['EquipeID'].'">Members</a></td>
                </tr>';

                $statementWIN->closeCursor();
                $statementLOSS->closeCursor();
                $statementTIE->closeCursor();
            } 

                $statement->closeCursor();
                $db=NULL;
        ?>
        </table>
        </main>
    </body>
</html>