<?php 
    session_start();
    require_once "connect.php";
    $db = new PDO(DNS, LOGIN, PASSWORD, $options);
    include "permission.inc.php";
?>
<html>
    <head>
        <meta charset="utf-8">
        <title> Admin Panel </title>
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
            
        </main>
    </body>
</html>