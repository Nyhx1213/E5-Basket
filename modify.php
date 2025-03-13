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
                $sqlchart= 'SELECT Scoreteam1, Scoreteam2 FROM Rencontre
                            WHERE RencontreID = :id';
                            
            }
        ?>
    </body>
