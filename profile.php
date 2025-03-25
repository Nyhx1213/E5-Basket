<?php 
session_start();
require_once "connect.php";
$db = new PDO(DNS, LOGIN, PASSWORD, $options);
include "permission.inc.php";
try {

    $sqlinformation = 'SELECT * FROM User';
    
    $statementinformation= $db->prepare($sqlinformation);
    $statementinformation->execute();
    $row = $statementinformation->fetch();
    
    $date = $row['DateCreation'];
}
catch (PDOException $e) {
    echo '<div class="message error"><h2>Error: ' . $e->getMessage() . '</h2></div>';
}

?>
<html>
    <head>
        <title> Profile </title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css.css">
        <link rel="stylesheet" href="pico.min.css">
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
            <div class="container"> 
                    <h1><?php echo $_SESSION['login']?></h1>
                    <h2>Date de creation de compte: <?php echo $date; ?> </h2>
                    <h2>Adresse Mail: <?php echo $row['Mail'] </h2>

            </div>
        </main>
    </body>
</html>