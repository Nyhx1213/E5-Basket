<?php
    session_start();
    require_once "connect.php";
    $db = new PDO(DNS, LOGIN, PASSWORD, $options);
    include "permission.inc.php";


    // Deletes all rows whom are related to the workout.
    if (isset($_GET['workid'])){
        
        $sqlWorkout= 'DELETE FROM Entrainement 
                      WHERE EntrainementID= :id';

        $sqlPlayer= 'DELETE FROM Participer 
                     WHERE EntrainementID = :id';

        $statementPlayer= $db->prepare($sqlPlayer);
        $statementPlayer->bindParam(':id', $_GET['workid']);
        $statementPlayer->execute();

        $statementWorkout = $db->prepare($sqlWorkout);
        $statementWorkout->bindParam(':id', $_GET['workid']);
        $statementWorkout->execute();

    }
    
    $db = null;
    header('Location: wdetails.php');