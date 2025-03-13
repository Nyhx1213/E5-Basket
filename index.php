<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="pico.min.css">
    <link rel="stylesheet" href="css.css">
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
            <strong><a href="index.php" class="contrast">Basketball Management Application</a></strong>
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
    <?php 
    require_once 'connect.php'; 
    $db = new PDO(DNS, LOGIN, PASSWORD, $options);

    if (!isset($_SESSION['login'])) { // If there's no login session, show the form
        $sql = 'SELECT * FROM Users WHERE Login = :log';

        echo 
        '<div>
            <form action="index.php" method="post">
                <h2>Login</h2>
                <label for="login">Username</label>
                <input type="text" id="login" name="login" required><br>
                <label for="mdp">Password</label>
                <input type="password" id="mdp" name="mdp" required><br>
                <p> <a href="forgotpassword.php">Forgot Password?</a></p>
                <input type="submit" value="Login">
            </form>
            <p><a href="creation.php">Create an account</a></p>
        </div>';

        $statement = $db->prepare($sql);
        $statement->bindParam(':log', $_POST['login']);
        $statement->execute(); // Checks if the user is in the database

        if (isset($_POST['login']) && isset($_POST['mdp'])) { 
            $rowcount = $statement->rowcount(); 
        
            if ($rowcount == '1') { // if user exists, proceed to check password.
                $str = $_POST['mdp'];
                $row = $statement->fetch();

                if (password_verify($_POST['mdp'], $row['Password'])) { // Compare the entered password with the one in the database.
                    $_SESSION['login'] = $_POST['login'];
                    $_SESSION['id']=$row['User_ID'];
                    header("Refresh:0");
            } 
            
            else {
                echo '<p>Invalid password.</p>';
            } 

        } 
        
        else {
            echo '<p>Username not found.</p>';
        }

        $statement->closeCursor();
        $db = null; 
    } 
    } 

    else {
    echo '
    <div class="grid">
      <div class="button-container"><a href="createworkout.php" class="contrast">Create a Workout</a></div>
      <div class="button-container"><a href="workout.php" class="contrast">Manage Workout Attendance</a></div>
      <div class="button-container"><a href="wdetails.php" class="contrast">Workout List</a></div>
      <div class="button-container"><a href="teams.php" class="contrast">Teams and Players charts</a></div>
      <div class="button-container"><a href="gamemanage.php" class="contrast">Manage Games</a></div>
      <div class="button-container"><a href="gamechart.php" class="contrast">Game Chart</a></div>
    </div>';
    }
    ?> 
</main>
</body>
</html>
