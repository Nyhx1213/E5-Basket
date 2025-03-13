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
        <?php
            if (isset($_GET['idRencontre']) && !empty($_GET['idRencontre'])){
                $sqlchart = 'SELECT DISTINCT E1.NomEquipe, E2.NomEquipe FROM JOUER as J1
                             INNER JOIN Equipe as E1 ON J1.EquipeID = E1.EquipeID
                             INNER JOIN JOUER as J2 ON J1.RencontreID = J2.RencontreID 
                             Inner JOIN Equipe as E2 ON J2.EquipeID = E2.EquipeID
                             WHERE J1.RencontreID = 1 AND J1.EquipeID < J2.EquipeID';

                $statementchart = $db->prepare($sqlchart);
                $statementchart->bindParam(":id",$_GET['idRencontre']);

                $sqlinsertrencontre = 'INSERT INTO Rencontre (Scoreteam1, Scoreteam2) Values(:score1, :score2)';
 
                $sqlinsertjouer = 'INSERT INTO JOUER (Score' ; 

                echo'
                <form action="modify.php" method=post class="workout-form">
                    <label for="scoreteam1"> ';
            }
        ?>
    </body>
