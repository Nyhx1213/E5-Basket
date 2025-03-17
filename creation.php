<?php 
session_start();
?> 
<html lang="en">
<head>
    <title>Account Creation</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css.css">
    <link rel="stylesheet" href="pico.min.css">
</head>
<body class="account-creation-page">

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
    <div class="container">
        <?php 
        try {    
            require_once "connect.php";

            if(isset($_SESSION['login'])) {
                echo '<div class="message error"><h2>You are already logged in.</h2></div>';
            } 
            else {
                $db = new PDO(DNS, LOGIN, PASSWORD, $options);
                $sql = 'INSERT INTO Users (Login, Password, Mail) VALUES (:uID, :uMDP, :uMail)'; // Insertion query for users.
                $sql2 = 'INSERT INTO DISPOSER (idRole, User_ID) VALUES (6, :userid)'; // Assigns user role.

                echo '
                <div class="form-container">
                    <form action="creation.php" method="post" class="signup-form">
                        <h2>Create Your Account</h2>
                        <label for="register">Login</label>
                        <input type="text" id="register" name="register" required>

                        <label for="mdpreg">Password</label>
                        <input type="password" id="mdpreg" name="mdpreg" required>

                        <label for="mdpregverif">Password Verification</label>
                        <input type="password" id="mdpregverif" name="mdpregverif" required>

                        <label for="mail">Email</label>
                        <input type="email" id="mail" name="mail" required>

                        <input type="submit" value="Sign Up" name="submit" class="submit-btn">
                    </form>
                </div>';

                if (isset($_POST['submit'])) { 
                    $email = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) { 
                        $password = password_hash($_POST['mdpreg'], PASSWORD_DEFAULT); // Hash password
                        $statement = $db->prepare($sql);
                        
                        // Binding parameters from form
                        $statement->bindParam(':uID', $_POST['register']);
                        $statement->bindParam(':uMDP', $password); 
                        $statement->bindParam(':uMail', $_POST['mail']);

                        if ($_POST['mdpreg'] == $_POST['mdpregverif']) { // Verify passwords match
                            $_POST['mdpreg'] = $password; 
                            $statement->execute();
                            $statement->closeCursor();
                            

                            $lastID = $db->lastInsertId();
                            $statementrole = $db->prepare($sql2);
                            $statementrole->bindParam(':userid', $lastID);
                            $statementrole->execute();
                            $statementrole->closeCursor();
                            

                            echo '<div class="message success"><h2>Account successfully created!</h2></div>';
                        } else {
                            echo '<div class="message error"><h2>Passwords do not match.</h2></div>';
                        }    
                    } else {
                        echo '<div class="message error"><h2>' . $email . ' is not a valid email address.</h2></div>';
                    }
                }
            }
        } catch (PDOException $e) {
            echo '<div class="message error"><h2>Error: ' . $e->getMessage() . '</h2></div>';
        }
        $db = null;
        ?>
    </div>
</main>

</body>
</html>
