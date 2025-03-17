<?php
session_start();
require_once "connect.php";
$db= new PDO(DNS, LOGIN, PASSWORD, $options);
include "permission.inc.php";
?>
<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <link rel="Stylesheet" href="css.css">
        <link rel="stylesheet" href="pico.min.css">
        <title>Players</title>
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
            if (isset($_GET['teamID'])&& !empty($_GET['teamID'])) { 
                //sql request that is supposed to link up my team and the specific members performance.
                $sql = 'SELECT M.MembreID, M.Nom, M.Prenom, M.NumeroMaillot, M.Role FROM Membre AS M INNER JOIN MembresEquipe AS ME ON M.MembreID = ME.MembreID
                        INNER JOIN Equipe as E ON ME.EquipeID = E.EquipeID WHERE E.EquipeID = :teamID';
                $statement = $db->prepare($sql);
                $statement->bindParam(':teamID', $_GET['teamID']); //bind my parameter above to teamid
                $statement->execute();
                
                echo 
                '<table>
                    <tr>
                        <th> First Name </th>
                        <th> Last Name </th>
                        <th> Position </th>
                        <th> Jersey Number</th> 
                        <th> Performance </th>
                    </tr>';
                        
                while ($row = $statement->fetch()) {
                    echo 
                    '<tr> 
                        <td>'.$row['Prenom'].'</td>
                        <td>'.$row['Nom'].'</td>
                        <td>'.$row['Role'].'</td>
                        <td>'.$row['NumeroMaillot'].'</td>
                        <td><a href="playerstats.php?playerID='.$row['MembreID'].'">Stats</a></td>
                </tr>';
                }

                $statement->closeCursor();
                $db=null;
            }
        
         ?>
            </table>
        </main>
    </body>
</html>