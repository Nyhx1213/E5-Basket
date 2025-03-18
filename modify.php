<?php
session_start();
require_once "connect.php";
$db = new PDO(DNS, LOGIN, PASSWORD, $options);
require_once "permission.inc.php";
?> 
<html>
    <head> 
        <title> Modify Game </title>
        <link rel="stylesheet" href="pico.min.css">
        <link rel="stylesheet" href="css.css">
        <meta charset="utf-8">
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
           if (isset($_GET['idRencontre']) && !empty($_GET['idRencontre'])){

                /* This section joins up multiple tables to show which teams the user has selected.*/
                $sqlchart = 'SELECT E1.NomEquipe as Equipe1, E2.NomEquipe as Equipe2, 
                             E1.EquipeID as ID1, E2.EquipeID as ID2 FROM JOUER as J1
                             INNER JOIN Equipe as E1 ON J1.EquipeID = E1.EquipeID
                             INNER JOIN JOUER as J2 ON J1.RencontreID = J2.RencontreID 
                             Inner JOIN Equipe as E2 ON J2.EquipeID = E2.EquipeID
                             WHERE J1.RencontreID = :id AND J1.EquipeID < J2.EquipeID';

                $statementchart = $db->prepare($sqlchart);
                $statementchart->bindParam(':id',$_GET['idRencontre']);
                $statementchart->execute();
                
                $row = $statementchart->fetch();
                
                echo'
                <form action="modify.php" method="post" class="workout-form">
                <select id="team1" name="team1" required>
                        <option value="'.$row['ID1'].'">'.$row['Equipe1'].'</option>
                    </select>

                    <label for="scoreteam1"> Insert Score </label>
                    <input type="number" id="scoreteam1" name="scoreteam1" min="0" required>
                    <select id="team2" name="team2" required>
                        <option value="'.$row['ID2'].'">'.$row['Equipe2'].'</option>
                        </select>
                        
                        <label for="scoreteam2"> Insert Score </label>
                    <input type="number" id="scoreteam2" name="scoreteam2" min="0" required>
                    <input type="hidden" name="idRencontre" id="idRencontre" value="'.$_GET['idRencontre'].'">
                    <input type="submit" name="submit" value="Submit">
                </form>';
           }
                
                //If variables from my form are not empty and are set.
                if(isset($_POST['submit'])){ 

                    if (isset($_POST['scoreteam1'], $_POST['scoreteam2'], $_POST['team1'], $_POST['team2'], $_POST['idRencontre'])) {
                    

                    // Binding variables
                    $scoreteam1 = $_POST['scoreteam1'];
                    $scoreteam2 = $_POST['scoreteam2'];
                    $team1 = $_POST['team1'];
                    $team2 = $_POST['team2'];
                    $idRencontre = $_POST['idRencontre'];
                    

                    /*  The below section updates the Rencontre Table and JOUER table the scores which
                        the user has inputted in the forms. There are no verifications yet but they will
                        be added soon.*/

                    // Updates Rencontre Table
                    $sqlupdaterencontre = 'UPDATE Rencontre
                                           SET ScoreEquipe1 = :score1, ScoreEquipe2 = :score2
                                           WHERE RencontreID = :idRencontre AND (ScoreEquipe1 OR ScoreEquipe2 IS NULL)';
                    
                    // Updates JOUER Table
                    $sqlupdatejouer = 'UPDATE JOUER 
                                       SET Score = :score 
                                       WHERE EquipeID = :equipeid AND RencontreID = :idRencontre AND Score IS null' ; 


                    $statementupdaterencontre = $db->prepare($sqlupdaterencontre);
                    
                    //Parameters for the Rencontre Update
                    $statementupdaterencontre->bindParam(':score1', $scoreteam1);
                    $statementupdaterencontre->bindParam(':score2', $scoreteam2);
                    $statementupdaterencontre->bindParam(':idRencontre', $idRencontre);
                    
                    $statementupdaterencontre->execute();

                    // Parameters for the first team's score 
                    $statementupdatejouer1= $db->prepare($sqlupdatejouer);
                    $statementupdatejouer1->bindParam(':score',$scoreteam1);
                    $statementupdatejouer1->bindParam(':equipeid',$team1);
                    $statementupdatejouer1->bindParam(':idRencontre',$idRencontre);

                    $statementupdatejouer1->execute();

                    // Parameters for the second team's score
                    $statementupdatejouer2= $db->prepare($sqlupdatejouer);  
                    $statementupdatejouer2->bindParam(':score', $scoreteam2);
                    $statementupdatejouer2->bindParam(':equipeid', $team2);
                    $statementupdatejouer2->bindParam(':idRencontre', $idRencontre);

                    $statementupdatejouer2->execute();

                    echo 'works';
                    }
                }
            ?>
        </main>
    </body>
</html>