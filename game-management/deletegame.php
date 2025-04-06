<?php 
    session_start();
    require_once "../connect.php";
    $db = new PDO(DNS, LOGIN, PASSWORD, $options);
    include "../permission.inc.php";

    if (isset($_GET['gameid'])){
 
        $sqlRencontre = 'DELETE FROM Rencontre 
                         WHERE RencontreID = :id';
        $sqlJouer = 'DELETE FROM Jouer 
                     WHERE RencontreID = :id';

        $sqlPerformance = 'DELETE FROM Performance
                           WHERE RencontreID = :id';

        $statementPerformance = $db->prepare($sqlPerformance);
        $statementPerformance->bindParam(':id', $_GET['gameid']);
        $statementPerformance->execute();

        $statementJouer = $db->prepare($sqlJouer);
        $statementJouer->bindParam(':id', $_GET['gameid']);
        $statementJouer->execute();

        $statementRencontre = $db->prepare($sqlRencontre);
        $statementRencontre->bindParam(':id', $_GET['gameid']);
        $statementRencontre->execute();
        
    }
    $db = null;
    header('Location: gamechart.php');