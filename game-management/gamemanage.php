<?php 
session_start();
require_once "../connect.php";
$db = new PDO(DNS, LOGIN, PASSWORD, $options);
include "../permission.inc.php";
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="Stylesheet" href="../css/css.css">
    <link rel="stylesheet" href="../css/pico.min.css">
    <title>Game Management</title>
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
            $one = 1;
            $zero = 0;
            $minus = -1;

            $sqlteam1 = 'SELECT * FROM Equipe ';
            $statementteam1 = $db->prepare($sqlteam1);
            $statementteam1->execute(); // Selects all the teams in the form
    
            // Form for selecting the first team
            echo 
            '<div>
                <form action="gamemanage.php" method="post" class="workout-form">
                    <h2>Select the first team and its Score</h2>
                    <label for="teamname1">First Team</label>
                    <select id="teamname1" name="teamname1" required>';
    
                while ($row = $statementteam1->fetch()) {
                    echo '<option value="' . $row['EquipeID'] . '">' . $row['NomEquipe'] . '</option>';
            }
            echo '
                    </select>
                    <label for="scoreteam1">Score</label>
                    <input type="number" id="scoreteam1" name="scoreteam1">
                    <p class="form-text">(the input of a score may be filled at a later date)</p>
                    <input type="submit" value="Submit">
                </form>
            </div>';
            $statementteam1->closeCursor();

            // Check if first team is selected, then fetch second team options
            if (isset($_POST['teamname1']) && !empty($_POST['teamname1'])) {
                $sqlcheckteam1='SELECT count(EquipeID) as CountTeam FROM Equipe 
                                WHERE EquipeID = :id';
                $statementcheckteam1= $db->prepare($sqlcheckteam1);
                $statementcheckteam1->bindParam(':id',$_POST['teamname1']);
                $statementcheckteam1->execute();

                $rowcheckteam1=$statementcheckteam1->fetch();

                if($rowcheckteam1['CountTeam']<1){
                    echo'<h2 class="message error"> An error as occured with your team input, please try again or contact support.</h2>';
                    exit();
                }
                else {

                    $statementcheckteam1->closeCursor();
                    $teamname1=$_POST['teamname1'];
                    $sqlteam2 = 'SELECT * FROM Equipe WHERE EquipeID != :team1'; // Prevents team playing against itself
                $statementteam2 = $db->prepare($sqlteam2);
                $statementteam2->bindParam(':team1', $teamname1);
                $statementteam2->execute(); 
                
                // Form for selecting the second team and score
                echo 
                '<div>
                    <form action="gamemanage.php" method="post" class="workout-form">
                        <h2>Select Second Team and its Score</h2>
                        <label for="teamname2">Second Team</label>
                        <select id="teamname2" name="teamname2" required>';

                        while ($row = $statementteam2->fetch()) {
                            echo '<option value="' . $row['EquipeID'] . '">' . $row['NomEquipe'] . '</option>';
                        }
                        echo 
                        '</select>
                        <label for="scoreteam2">Score</label>
                        <input type="number" id="scoreteam2" name="scoreteam2">
                        <p class="form-text">(the input of a score may be filled at a later date)</p> 
                        <label for="gamedate">Game Date</label>
                        <input type="datetime-local" id="gamedate" name="gamedate" max="9999-12-31T23:59" required>
                        <label for="gamelocation">Game Location</label>
                        <input type="text" id="gamelocation" name="gamelocation" required>
                        <input type="hidden" id="teamname1" name="teamname1" value="'.$_POST['teamname1'].'">
                        <input type="hidden" id="scoreteam1" name="scoreteam1" value="'.$_POST['scoreteam1'].'">
                        <input type="submit" value="Submit">
                        </form>
                        </div>';
                        $statementteam2->closeCursor();
                    }
                    
                    // Handling the game submission
                    if (isset($_POST['gamelocation']) && !empty($_POST['gamelocation'])) {
                        $sqlcheckteam2='SELECT count(EquipeID) as CountEquipe FROM Equipe
                                        WHERE EquipeID = :id';
                        $statementcheckteam2= $db->prepare($sqlcheckteam2);
                        $statementcheckteam2->bindParam(':id',$_POST['teamname2']);
                        $statementcheckteam2->execute();
                        
                        $rowcheckteam2= $statementcheckteam2->fetch();
                        if($rowcheckteam2['CountEquipe']<1){
                            echo'<h2 class="message error"> An error as occured with the input of your team, please try again or contact support</h2>';
                            exit();
                        }
                        else{
                            $statementcheckteam2->closeCursor();
                            $teamname2=$_POST['teamname2'];
                            $scoreteam1=$_POST['scoreteam2'];
                            $scoreteam2=$_POST['scoreteam1'];

                            //Time limit to avoid user putting in random years.
                            $datelimitadd = new DateTime(date('Y-m-d H:i:s'));
                            $datelimitadd->add(new DateInterval('P1Y'));
                            $datelimitsub = new DateTime(date('Y-m-d H:i:s'));
                            $datelimitsub->sub(new DateInterval('P1Y'));

                            //Puts the user input into datetime format for comparison.
                            $userDate = DateTime::createFromFormat('Y-m-d\TH:i', $_POST['gamedate']);
                            
                        if ($userDate > $datelimitadd || $userDate < $datelimitsub) {
                            echo '<h2 class="message error">Please input a valid date</h2>';
                        } 

                        else {

                            $sql = 'INSERT INTO Rencontre (DateRencontre, ScoreEquipe1, ScoreEquipe2, Lieu) 
                            VALUES (:gamedate, :scoreteam1, :scoreteam2, :gamelocation)'; // Inserts into the database
                            $statement = $db->prepare($sql);
                            $statement->bindParam(':gamedate', $_POST['gamedate']);
                            
                            //Adds scores if it exist
                            if (isset ($_POST['scoreteam1'])){
                                $statement->bindParam(':scoreteam1', $scoreteam1);
                            }
                            //Adds score if it exist 
                            if (isset ($_POST['scoreteam2'])){
                                $statement->bindParam(':scoreteam2', $scoreteam2);
                            }

                            $statement->bindParam(':gamelocation', $_POST['gamelocation']); // Preparing to insert data I will get later.
                            $statement->execute(); // Creates the game

                            if (isset($_POST['scoreteam1']) && isset($_POST['scoreteam2'])){
                                             
                            // After game creation, insert into the JOUER table and set winners/losers
                            $lastID = $db->lastInsertId(); // Get the game ID
                            
                            $sql2 = 'INSERT INTO Jouer (RencontreID, EquipeID, Score, EST_GAGNANT) 
                                     VALUES (:rencontreid, :equipeid, :score, :win)';

                            $statement2 = $db->prepare($sql2);
                            $statement2->bindParam(':rencontreid', $lastID); 
                            
                            $sqlplayers = 'SELECT M.MembreID FROM Membre as M 
                                        INNER JOIN MembresEquipe as ME ON M.MembreID = ME.MembreID
                                        INNER JOIN Equipe as E ON ME.EquipeID = E.EquipeID
                                        WHERE E.EquipeID = :equipeid1 OR E.EquipeID = :equipeid2
                                        ORDER BY M.MembreID ASC';

                            $statementplayers = $db->prepare($sqlplayers);
                            $statementplayers->bindParam(':equipeid1', $teamname1);
                            $statementplayers->bindParam(':equipeid2', $teamname2);
                            $statementplayers->execute(); 
                            
                            $sqlinsert = 'INSERT INTO Performance (MembreID, RencontreID, Points, Assists, Rebonds, MinutesJouees)
                                        VALUES (:mID, :rencontreid, :points, :assists, :rebounds, :mjouer)';
                                        
                            $statementinsert = $db->prepare($sqlinsert);
                            
                            while ($row = $statementplayers->fetch()) {
                                $points = rand(0, 40);
                                $assists = rand(1, 20);
                                $rebounds = rand(1, 20);
                                $fourty = 40;
                                
                                $statementinsert->bindParam(':mID', $row['MembreID']);
                                $statementinsert->bindParam(':rencontreid', $lastID);
                                $statementinsert->bindParam(':points', $points);
                                $statementinsert->bindParam(':assists', $assists);
                                $statementinsert->bindParam(':rebounds', $rebounds);
                                $statementinsert->bindParam(':mjouer', $fourty);
                                $statementinsert->execute();
                            }
                            
                            // Determining the winner and loser based on scores
                            if ($scoreteam1 > $scoreteam2) {
                                $statement2->bindParam(':equipeid', $teamname2); // Winner
                                $statement2->bindParam(':score',$scoreteam1);
                                $statement2->bindParam(':win', $one);
                                $statement2->execute();
                                $statement2->bindParam(':equipeid', $teamname1); // Loser
                                $statement2->bindParam(':score',$scoreteam2);
                                $statement2->bindParam(':win', $zero);
                                $statement2->execute();
                            } 
                            else if ($scoreteam2 > $scoreteam1) {
                                $statement2->bindParam(':equipeid', $teamname1); // Winner
                                $statement2->bindParam(':score',$scoreteam2);
                                $statement2->bindParam(':win', $one);
                                $statement2->execute();
                                $statement2->bindParam(':equipeid', $teamname2); // Loser
                                $statement2->bindParam(':score',$scoreteam1);
                                $statement2->bindParam(':win', $zero);
                                $statement2->execute();
                            } 
                            else {
                                // Tie
                                $statement2->bindParam(':equipeid', $teamname1);
                                $statement2->bindParam(':win', $minus);
                                $statement2->bindParam(':score', $scoreteam2);
                                $statement2->execute();
                                $statement2->bindParam(':equipeid', $teamname2);
                                $statement2->bindParam(':win', $minus);
                                $statement2->bindParam(':score',$scoreteam1);
                                $statement2->execute();
                            }
                        }
                            echo '<h2 class="message success">The game has been successfully added!</h2>';
                    }
                }
            }
        }
    } 
    catch (PDOException $e) {
        echo '<h3>Error: ' . $e->getMessage() . '</h3>';
    }
    $db = null;
    ?>
    </main>
    </body>
    </html>