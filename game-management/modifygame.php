<?php
    session_start();
    require_once "../connect.php";
    $db = new PDO(DNS, LOGIN, PASSWORD, $options);
    require_once "../permission.inc.php";

    if (isset($_GET['matchid'])){ 
    $sqlchart = 'SELECT E1.NomEquipe as Equipe1, E2.NomEquipe as Equipe2, 
                             E1.EquipeID as ID1, E2.EquipeID as ID2, J1.Score as Score1,
                             J2.Score as Score2, R.DateRencontre, R.Lieu FROM Jouer as J1
                             INNER JOIN Equipe as E1 ON J1.EquipeID = E1.EquipeID
                             INNER JOIN Jouer as J2 ON J1.RencontreID = J2.RencontreID 
                             INNER JOIN Equipe as E2 ON J2.EquipeID = E2.EquipeID
                             INNER JOIN Rencontre as R ON J1.RencontreID = R.RencontreID
                             WHERE J1.RencontreID = :id AND J1.EquipeID < J2.EquipeID';

$statementchart = $db->prepare($sqlchart);
$statementchart->bindParam(':id',$_GET['matchid']);
$statementchart->execute();

$row = $statementchart->fetch();

//Variables to later on check 
$_SESSION['team1'] = $row['ID1'];
$_SESSION['team2'] = $row['ID2'];
$_SESSION['matchid'] = $_GET['matchid'];    

}
else if (!isset($_SESSION['matchid'])) { 
    header("Location: gamechart.php");
}
?>
<html>
    <head>
        <title> Modify Game </title>
        <link rel="stylesheet" href="../css/pico.min.css">
        <link rel="stylesheet" href="../css/css.css">
        <meta charset="utf-8">
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <li>
                        <?php if(isset($_SESSION['login'])){
                            echo'<a href="../profile.php">Welcome '.$_SESSION['login'].'</a>';
                        }
                        else echo '';
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
            if (isset($_GET['matchid'])){

                echo '
                <form action="modifygame.php" method="post">
                <select name="teamname1" id="teamname1">
                <option value="'.$row['ID1'].'">'.$row['Equipe1'].'</option> 
                    </select>

                    <label for="teamscore1">Change Score </label>
                    <input type="number" id="teamscore1" name="teamscore1" value="'.$row['Score1'].'">
                    
                    <select name="teamname2" id="teamname2" value="'.$row['ID2'].'">
                    <option value="'.$row['ID2'].'">'.$row['Equipe2'].'</option>
                    </select>
                    
                    <label for="teamscore2">Change Score</label>
                    <input type="number" id="teamscore2" name="teamscore2" value="'.$row['Score2'].'">
                    
                    <label for="date">Change Date</label>
                    <input type="datetime-local" id="date" name="date" min="0000-01-01" max="9999-12-31" value="'.$row['DateRencontre'].'">
                    
                    <label for="location">Change Location</label> 
                    <input type="text" id="location" name="location" value="'.$row['Lieu'].'">
                    
                    <input type="submit" value="Submit" name="submit" id="submit">
                    </form>';
                }

                if (isset($_POST['submit'])){ 

                    if (empty($_POST['teamscore1']) || empty($_POST['teamscore2']) || empty($_POST['date']) || empty($_POST['location'])) {
                        
                        echo '<h1 class="message error"> Please fill in all fields correctly </h1>';
                        header('refresh:3;url=gamechart.php');
                        exit;
                    
                    }
                    
                
                
                else { 
                    try {
                    //Time limit to avoid user putting in random years.
                    $datelimitadd = new DateTime(date('Y-m-d H:i:s'));
                    $datelimitadd->add(new DateInterval('P1Y'));
                    $datelimitsub = new DateTime(date('Y-m-d H:i:s'));
                    $datelimitsub->sub(new DateInterval('P1Y'));
                    
                    //Puts the user input into datetime format for comparison.
                    $userDate = DateTime::createFromFormat('Y-m-d\TH:i', $_POST['date']);
                    $gameDate = $userDate->format('Y-m-d H:i:s');
                                                
                    if ($userDate > $datelimitadd || $userDate < $datelimitsub) {
                        echo '<h2 class="message error">Please input a valid date</h2>';
                        header('refresh:3;url=gamechart.php');
                    }
                    else {  
                    $sqlupdaterencontre = 'UPDATE Rencontre
                                           SET ScoreEquipe1 = :scoreteam1, ScoreEquipe2 = :scoreteam2, Lieu= :lieu, DateRencontre = :date
                                           WHERE Rencontreid = :id ';
                    $statementupdaterencontre = $db->prepare($sqlupdaterencontre);
                    $statementupdaterencontre->bindParam(':id', $_SESSION['matchid']);
                    $statementupdaterencontre->bindParam(':scoreteam1', $_POST['teamscore1']);
                    $statementupdaterencontre->bindParam(':scoreteam2', $_POST['teamscore2']);
                    $statementupdaterencontre->bindParam(':lieu', $_POST['location']);
                    $statementupdaterencontre->bindParam(':date', $gameDate);
                    $statementupdaterencontre->execute();

                    if ($_POST['teamscore1'] > $_POST['teamscore2']){
                        $sqlupdatejouer1 = 'UPDATE Jouer 
                                            SET Score = :score, EST_GAGNANT = 1
                                            WHERE RencontreID = :idrencontre AND EquipeID = :equipeid';

                        $sqlupdatejouer2 = 'UPDATE Jouer 
                                            SET Score = :score, EST_GAGNANT = 0
                                            WHERE RencontreID = :idrencontre AND EquipeID = :equipeid';
                    }
                    
                    else if ($_POST['teamscore1'] < $_POST['teamscore2']){
                        $sqlupdatejouer1 = 'UPDATE Jouer 
                                            SET Score = :score, EST_GAGNANT = 0
                                            WHERE RencontreID = :idrencontre AND EquipeID = :equipeid';

                        $sqlupdatejouer2 = 'UPDATE Jouer 
                                            SET Score = :score, EST_GAGNANT = 1
                                            WHERE RencontreID = :idrencontre AND EquipeID = :equipeid';
                    }

                    else {
                        $sqlupdatejouer1 = 'UPDATE Jouer 
                                            SET Score = :score, EST_GAGNANT = -1
                                            WHERE RencontreID = :idrencontre AND EquipeID = :equipeid';

                        $sqlupdatejouer2 = 'UPDATE Jouer 
                                            SET Score = :score, EST_GAGNANT = -1
                                            WHERE RencontreID = :idrencontre AND EquipeID = :equipeid';
                    }

                    $statementupdatejouer1 = $db->prepare($sqlupdatejouer1);
                    $statementupdatejouer1->bindParam(':score', $_POST['teamscore1']);
                    $statementupdatejouer1->bindParam(':idrencontre', $_SESSION['matchid']);
                    $statementupdatejouer1->bindParam(':equipeid', $_SESSION['team1']);
                    $statementupdatejouer1->execute();

                    $statementupdatejouer2 = $db->prepare($sqlupdatejouer2);
                    $statementupdatejouer2->bindParam(':score', $_POST['teamscore2']);
                    $statementupdatejouer2->bindParam(':idrencontre', $_SESSION['matchid']);
                    $statementupdatejouer2->bindParam(':equipeid', $_SESSION['team2']);
                    $statementupdatejouer2->execute();

                    $_SESSION['team1'] = null;
                    $_SESSION['team2'] = null;
                    $_SESSION['matchid'] = null;

                    echo '<h1 class="message success"> The modification is successful please wait a few seconds to be redirected back';
                    header('refresh:4;url=gamechart.php');
                }
                }
                catch (PDOException $e) {
                    echo '<h3>Error: ' . $e->getMessage() . '</h3>';
                }
                }

            }
            

            $db=null;
            ?>

        </main> 
    </body>
</html>