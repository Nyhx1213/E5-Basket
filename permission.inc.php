<?php
try{
    //This page retrieves the name of the page, checks in the database if ur role has access to the page and redirects you
    //to a 403 page if it has no access.

    $page=basename($_SERVER['SCRIPT_FILENAME']); //Retrieves the name of the page
    $sqlPerm = 'SELECT count(A.PageID) FROM Acceder as A
    INNER JOIN Disposer as D on A.RoleID = D.RoleID
    INNER JOIN Page as P on A.PageID = P.PageID
    INNER JOIN User as U on D.UserID = U.UserID
    WHERE U.UserID = :id AND P.NomPage = :nompage';

    $statementPerm = $db->prepare($sqlPerm);
    $statementPerm->bindParam(":id",$_SESSION['id']);
    $statementPerm->bindParam(":nompage", $page);
    $statementPerm->execute();

    $rowcount= $statementPerm->fetchColumn();
    if($rowcount<1){
        header('Location: 403.php?page='.$page); //If there are less than 1 results in the authorized pages for ur role then go to 403
    }
    }
    catch (PDOException $e){
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }