<?php
    session_start();
    require_once "connect.php";
    $db = new PDO(DNS, LOGIN, PASSWORD, $options);
    require_once "permission.inc.php";
    
    $checkteam1 = null;

    if (isset($_GET['matchid']) || $checkteam1 != null){ 
    $sqlchart = 'SELECT E1.NomEquipe as Equipe1, E2.NomEquipe as Equipe2, 
                             E1.EquipeID as ID1, E2.EquipeID as ID2, J1.Score as Score1,
                             J2.Score as Score2, R.DateRencontre, R.Lieu FROM Jouer as J1
                             INNER JOIN Equipe as E1 ON J1.EquipeID = E1.EquipeID
                             INNER JOIN Jouer as J2 ON J1.RencontreID = J2.RencontreID 
                             INNER JOIN Equipe as E2 ON J2.EquipeID = E2.EquipeID
                             INNER JOIN Rencontre as R ON J1.RencontreID = R.RencontreID;
                             WHERE J1.RencontreID = :id AND J1.EquipeID < J2.EquipeID';

$statementchart = $db->prepare($sqlchart);
$statementchart->bindParam(':id',$_GET['matchid']);
$statementchart->execute();

$row = $statementchart->fetch();

//Variables to later on check 
if (isset($_GET['matchid'])){
    $checkteam1=$row['ID1'];
    $checkteam2=$row['ID2'];    
    }
}
else { 
    header("Location: gamechart.php");
}
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
            <form action="modifygame.php" method="post">
                <select name="teamname1" id="teamname1">
                    <option value="<?php echo $row['ID1']; ?>"><?php echo $row['Equipe1']; ?></option> 
                </select>

                <label for="teamscore1">Change Score </label>
                <input type="number" id="teamscore1" name="teamscore1" value="<?php echo $row['Score1']; ?>">
                
                <select name="teamname2" id="teamname2" value="<?php echo $row['ID2']; ?>">
                    <option><?php echo $row['Equipe2']; ?></option>
                </select>
                
                <label for="teamscore2">Change Score</label>
                <input type="number" id="teamscore2" name="teamscore2" value="<?php echo $row['Score2']; ?>">
                
                <label for="date">Change Date</label>
                <input type="datetime-local" id="date" name="date" value="<?php echo $row['DateRencontre']; ?>">

                <label for="location">Change Location</label> 
                <input type="text" id="location" name="location" value="<?php echo $row['Lieu']; ?>">

                <input type="submit" value="Submit">
            </form>

            <?php if (isset($_POST['submit'])){

            }

            $db=null;
            ?>

        </main> 
    </body>
</html>
