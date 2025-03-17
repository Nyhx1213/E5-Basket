<?php 
session_start();
?>

<html lang="en">
<head> 
    <meta charset="utf-8">
    <title>Password Recovery</title>
    <link rel="stylesheet" href="css.css">
    <link rel="stylesheet" href="pico.min.css">
</head>

<body>
<header>
    <nav>
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

    <?php
    try {
        require_once "connect.php";
        $db = new PDO(DNS, LOGIN, PASSWORD, $options);

        if (isset($_GET['code']) && empty($_SESSION['login'])) {  
            //If code exists it'll check if the code is in the database.
            $sql = 'SELECT * FROM Users WHERE Code = :codeunique';
            $statement = $db->prepare($sql);
            $statement->bindParam(':codeunique', $_GET['code']);
            $statement->execute();
            $row = $statement->fetch();

            if (!$row) { 

            } 
            else {
                $date = new DateTime();
                $expirationDate = new DateTime($row['DateExp']); 

                if ($_GET['code'] == $row['Code'] && $date < $expirationDate) {  
                    echo 
                    '<div>
                        <form method="post">
                            <label for="nvmdp"><h1>New Password</h1></label>
                            <input type="text" id="nvmdp" name="nvmdp" required><br>
                            <label for="mdpverf"><h1>Verify Password</h1></label>
                            <input type="text" id="mdpverf" name="mdpverf" required>
                            <input type="submit" value="Send">
                        </form> 
                    </div>';

                    if (isset($_POST['nvmdp']) && isset($_POST['mdpverf'])) {  

                        if ($_POST['nvmdp'] == $_POST['mdpverf']) {  
                            $mdp = password_hash($_POST['nvmdp'], PASSWORD_DEFAULT);
                            $sql2 = 'UPDATE Users SET Password = :nvmdpf WHERE Code = :codeunique';
                            $statement2 = $db->prepare($sql2);
                            $statement2->bindParam(':codeunique', $_GET['code']);
                            $statement2->bindParam(':nvmdpf', $mdp);
                            $statement2->execute();

                            echo '<h1>Your password has been updated!</h1>';
                            $sql3 = 'UPDATE Users SET Code = null WHERE Code = :codeunique';
                            $statement3 = $db->prepare($sql3);
                            $statement3->bindParam(':codeunique', $_GET['code']);
                            $statement3->execute();
                            $statement2->closeCursor();
                            $statement3->closeCursor();
                        } 
                        else { 
                            echo '<h1>Passwords not matching.</h1>';
                        }
                    }

                } 
                
                $statement->closeCursor();
            }

        } 

    } 
    catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
    $db = null;
    ?>

</body>
</html>
