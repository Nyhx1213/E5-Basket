<?php
session_start();
require_once "connect.php";
$db = new PDO(DNS, LOGIN, PASSWORD, $options);
include "permission.inc.php";
$workoutcreated = false;

if (isset($_POST['workoutname']) && !empty($_POST['workoutname'])) { // Is the form filled?
    try {
        // Create a workout section
        $sqlW = 'INSERT INTO Entrainement (DateEntrainement, Duree, TypeEntrainement) 
           VALUES (:dateentr, :dureeentr , :typeentr)'; // SQL request to insert a workout.

        $statementW = $db->prepare($sqlW);
        $statementW->bindParam(':typeentr', $_POST['workoutname']); // Param binds for date/length/name of workout.
        $statementW->bindParam(':dureeentr', $_POST['workoutlength']);
        $statementW->bindParam(':dateentr', $_POST['workoutdate']);

        $datelimit = new DateTime(date('Y-m-d H:i:s'));
        $datelimit->add(new Dateinterval('P1Y'));

        $workoutdate = Datetime::createFromFormat('Y-m-d\TH:i',$_POST['workoutdate']); //Converts the datetime local string into a datetime object
        if ($workoutdate > $datelimit) {

        } 
        else {
            $statementW->execute(); // Creates the workout.
            $workoutcreated = true;
        }

        $statementW->closeCursor();
    } catch (PDOException $e) {
        echo('Error: ' . $e->getMessage());
    }
}
$db = null;
?>

<html lang="en">

    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css.css">
        <link rel="stylesheet" href="pico.min.css">
        <title>Create Workout</title>
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
            <section>
                <?php if (isset($_POST['workoutdate']) && $workoutcreated == true) {
                    echo '<div class="message success"> Your workout has been created !</div>';
                } else if (isset($_POST['workoutdate']) && $workoutcreated == false) {
                    echo '<div class="message error">Please input a valid date and a valid duration</div>';
                } ?>
                <form action="createworkout.php" method="post" class="workout-form">
                    <label for="workoutname">Name your workout</label>
                    <input type="text" id="workoutname" name="workoutname" required>

                    <label for="workoutlength">The length of the workout (in hours)</label>
                    <input type="number" id="workoutlength" name="workoutlength" min="1" max="8" required>

                    <label for="workoutdate">Date of the workout</label>
                    <input type="datetime-local" id="workoutdate" name="workoutdate" max="9999-12-31T23:59" required>
                    <input type="submit" value="Submit" class="submit-btn">
                </form>
            </section>
        </main>
    </body>
</html>
