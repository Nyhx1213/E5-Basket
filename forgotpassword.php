<?php 
session_start();
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Forgot Password</title>
        <link rel="stylesheet" href="css/css.css">
        <link rel="stylesheet" href="css/pico.min.css">
    </head>
    <body class="account-creation-page">
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

        <main>
            <div class="container">
                <h1>Forgot Password</h1>
                <form action="forgotpassword.php" method="post" class="forgot-password-form">
                    <label for="mail">Email</label>
                    <input type="email" id="mail" name="mail" required placeholder="Enter your email">
                    <input type="submit" value="Send" name="submit" class="submit-btn">
                </form>

                <?php 
                try {  
                    require_once "connect.php";
                    $db = new PDO(DNS, LOGIN, PASSWORD, $options);

                    if (isset($_POST['mail'])) {
                        $sql = 'SELECT * FROM User WHERE Mail=:mai';
                        $statement = $db->prepare($sql);
                        $statement->bindParam(':mai', $_POST['mail']);
                        $statement->execute();
                        $rowcount = $statement->rowCount();

                        if ($rowcount == 1) {
                            // Generate a random code
                            $bytes = random_bytes(6);
                            $code = bin2hex($bytes);

                            // Update the user's data to store the code and expiration date
                            $stm = $db->prepare('UPDATE User SET Code = :code, DateExp = :pdate WHERE UserID = :pid');
                            $date = new DateTime(date('Y-m-d H:i:s'));
                            $date->add(new DateInterval('PT2H')); // 2-hour expiration time
                            $date_str = $date->format('Y-m-d H:i:s');
                            $row = $statement->fetch();

                            // Bind parameters and execute the statement
                            $stm->bindParam(':pdate', $date_str);
                            $stm->bindParam(':code', $code);
                            $stm->bindParam(':pid', $row['UserID']);
                            $stm->execute();

                            //Gets the path and the domain name of the hosted server. 
                            $url = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);

                            // Send the email with the code
                            $to = $_POST['mail'];
                            $subject = 'Password Retrieval Link';
                            $message = 'Click the link below to retrieve your password: '.$url.'getpasswordcode.php?code=' . $code;
                            $headers = array(
                                'From' => 'do.not.reply@yourwebsite.com',
                                'Reply-To' => 'do.not.reply@yourwebsite.com',
                                'X-Mailer' => 'PHP/' . phpversion()
                            );
                            mail($to, $subject, $message, $headers);

                            echo '<div class="message success"><h2>Your email has been sent. Please check your inbox.</h2></div>';

                            $statement->closeCursor();
                            $stm->closeCursor();
                            $db = null;
                        } else {
                            echo '<div class="message error"><h2>There was an error with your email address.</h2></div>';
                        }
                    }
                } catch (PDOException $e) {
                    echo '<div class="message error"><h2>Error: ' . $e->getMessage() . '</h2></div>';
                }
                ?>
            </div>
        </main>
    </body>
</html>
