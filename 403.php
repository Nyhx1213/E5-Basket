<?php 
    session_start();
    http_response_code(403);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 Forbidden</title>
    <link href="css.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1>403 Forbidden</h1>
        <p>You don't have permission to access <?php if(isset($_GET['page'])&& !empty($_GET['page'])){
            echo basename($_GET['page'], '.php');}?>.</p>
        <p>If you believe this is an error, please contact support.</p>
        <a href="index.php" class="button">Go Back to Home</a>
    </div>
</body>
</html>
