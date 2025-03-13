<?php 
session_start();
require_once "connect.php";
$db = new PDO(DNS, LOGIN, PASSWORD, $options);
include "permission.inc.php";
?>
<!DOCTYPE html>
<head>
    <title>Workout Attendance</title>
    <link rel="stylesheet" href="css.css">
    <link rel="stylesheet" href="pico.min.css">
    <meta charset="UTF-8">
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
    <?php
    try {  
        if (isset($_GET['workID'])) {
            //Takes the workout ID and shows the players that are in it by joining tables.
            $sql = 'SELECT * FROM Entrainement INNER JOIN PARTICIPER ON Entrainement.EntrainementID = PARTICIPER.EntrainementID
                    INNER JOIN Membre ON PARTICIPER.MembreID = Membre.MembreID WHERE Entrainement.EntrainementID= :id'; //Joins Participer and entrainment to show data based on your wanted workout.
            $statement = $db->prepare($sql);
            $statement->bindParam(':id', $_GET['workID']);
            $statement->execute();

            echo 
            '<table class="attendance-table"> 
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Role</th>
                        <th>NumeroMaillot</th>
                    </tr>
                </thead>
                <tbody>';            
                    while ($row = $statement->fetch()) {
                    echo 
                    '<tr>
                        <td>' . $row['Nom'] . '</td>
                        <td>' . $row['Prenom'] . '</td>
                        <td>' . $row['Role'] . '</td>
                        <td>' . $row['NumeroMaillot'] . '</td>
                    </tr>';
            }

            echo 
            '</tbody>
            </table>';
            $statement->closeCursor();
        } 
    } catch (PDOException $e) {
        echo('echec :' . $e->getMessage());
    }
    $db = null; 
    ?>
</main>
</body>
</html>
