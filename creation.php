<?php 
session_start();
?> 
<html lang="en">
<head>
    <title>Account Creation</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/css.css">
    <link rel="stylesheet" href="css/pico.min.css">
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
                $sql = 'INSERT INTO User (Login, Password, Mail, DateCreation) VALUES (:uID, :uMDP, :uMail, :uDatecreation)'; // Insertion query for users.
                $sql2 = 'INSERT INTO Disposer (RoleID, UserID) VALUES (6, :userid)'; // Assigns user role.

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
                        $sqlcheckmail = 'SELECT Mail  FROM User
                                         WHERE Mail = :mail';
                        
                        $statementcheckmail = $db->prepare($sqlcheckmail);
                        $statementcheckmail->bindParam(':mail', $_POST['mail']);
                        $statementcheckmail->execute();

                        $rowcountmail = $statementcheckmail->rowcount();

                        if ($rowcountmail == 1){
                            echo '<h1 class="message-error">The mail already exists</h1>';
                            exit();
                        }
                        $statementcheckmail->closeCursor();

                        $sqlchecklogin = 'SELECT Login as Log FROM User
                                          WHERE Login = :nom;';
                        $statementchecklogin = $db->prepare($sqlchecklogin);
                        $statementchecklogin->bindParam(':nom', $_POST['register']);
                        $statementchecklogin->execute();
                        
                        $rowcountlog = $statementchecklogin->rowcount();

                        if ($rowcountlog == 1) {
                            echo '<h1 class="message-error"> The username already exists </h1>';
                            exit();
                        }

                        $statementchecklogin->closeCursor();

                        $password = password_hash($_POST['mdpreg'], PASSWORD_DEFAULT); // Hash password
                        
                        $creation = new DateTime(date('Y-m-d H:i:s'));
                        $creation_str = $creation->format('Y-m-d');

                        $statement = $db->prepare($sql);
                        
                        // Binding parameters from form
                        $statement->bindParam(':uID', $_POST['register']);
                        $statement->bindParam(':uMDP', $password); 
                        $statement->bindParam(':uMail', $_POST['mail']);
                        $statement->bindParam(':uDatecreation', $creation_str);

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
