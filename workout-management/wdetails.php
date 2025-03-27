<?php 
session_start();
require_once "../connect.php";
$db= new PDO(DNS, LOGIN, PASSWORD, $options);
include "../permission.inc.php";
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/css.css">
        <link rel="stylesheet" href="../css/pico.min.css">
        <title>Workoutlist</title>
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
                        else echo '<a ../href="index.php">Login</a>';
                    ?>
                </li>
            </ul>
            </nav>
        </header>
        <main>
            <h1> List of workouts</h1> 
            <?php
                $sqlR='SELECT * FROM Entrainement';
                if(isset($_GET['sort'])){
                    //Orders by arrows
                    switch($_GET['sort']){
                        case 1: $sqlR .=' ORDER BY TypeEntrainement'; break;
                        case 2: $sqlR .=' ORDER BY TypeEntrainement DESC'; break;
                        case 3: $sqlR .=' ORDER BY Duree'; break;
                        case 4: $sqlR .=' ORDER BY Duree DESC'; break;
                        case 5: $sqlR .=' ORDER BY DateEntrainement'; break;
                        case 6: $sqlR .=' ORDER BY DateEntrainement DESC'; break;
                    } 
                }
                
                else {
                    //If no arrow selected orders by date
                    $sqlR .=' ORDER BY DateEntrainement DESC';
                }
                
                $statementR= $db->prepare($sqlR);
                $statementR->execute();
            
                echo 
                '<table> 
                    <tr>
                        <th>Workout Name<a href="wdetails.php?sort=1" class="arrow">&uarr;</a><a href="wdetails.php?sort=2" class="arrow">&darr;</a></th>
                        <th>Length(H,M) <a href="wdetails.php?sort=3" class="arrow">&uarr;</a><a href="wdetails.php?sort=4" class="arrow">&darr;</a></th>
                        <th>Date <a href="wdetails.php?sort=5" class="arrow">&uarr;</a><a href="wdetails.php?sort=6" class="arrow">&darr;</a></th>
                        <th>info</th>
                        <th>Delete</th>
                    </tr>';   


                //onclick permet d'avoir le message de confirmation.
                
                while ($row=$statementR->fetch()){
                    echo 
                    '<tr>
                        <td>'.$row['TypeEntrainement'].'</td>
                        <td>'.$row['Duree'].'</td>
                        <td>'.$row['DateEntrainement'].'</td>
                        <td> <a href="participants.php?workID='.$row['EntrainementID'].'">link</a> </td>
                        <td><a href="deleteworkout.php?workid='.$row['EntrainementID'].'" onclick="return confirm(\'Are you sure you want to delete this workout?\')"><button class="button-suppression">X</button></a> </td>  
                    </tr>';
                }
                
                $statementR->closeCursor();
                $db=null;
            
            ?>
            </table>
        </main>
    </body>
</html>