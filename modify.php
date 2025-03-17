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
                $sqlchart = 'SELECT E1.NomEquipe as Equipe1, E2.NomEquipe as Equipe2 FROM JOUER as J1
                             INNER JOIN Equipe as E1 ON J1.EquipeID = E1.EquipeID
                             INNER JOIN JOUER as J2 ON J1.RencontreID = J2.RencontreID 
                             Inner JOIN Equipe as E2 ON J2.EquipeID = E2.EquipeID
                             WHERE J1.RencontreID = :id AND J1.EquipeID < J2.EquipeID';

                $statementchart = $db->prepare($sqlchart);
                $statementchart->bindParam(":id",$_GET['idRencontre']);
                $statementchart->execute();
                
                $sqlinsertrencontre = 'INSERT INTO Rencontre (Scoreteam1, Scoreteam2) Values(:score1, :score2)';
                
                $sqlinsertjouer = 'INSERT INTO JOUER (Score' ; 
                
                $row = $statementchart->fetch();

                echo'
                <form action="modify.php" method=post class="workout-form">
                <select id="team1" name="team1" required>
                        <option value="'.$row['Equipe1'].'">'.$row['Equipe1'].'</option>
                    </select>

                    <label for="scoreteam1"> Insert Score </label>
                    <input type="number" id="scoreteam1" name="scoreteam1">
                    <select id="team2" name="team2" required>
                        <option value="'.$row['Equipe2'].'">'.$row['Equipe2'].'</option>
                        </select>
                        
                        <label for="scoreteam2"> Insert Score </label>
                    <input type="number" id="scoreteam2" name="scoreteam2">
                    <input type="submit" value="Submit">
                </form>';

                if (isset($_POST['submit'])){
                    
                }
                }
            ?>
        </main>
    </body>
</html>