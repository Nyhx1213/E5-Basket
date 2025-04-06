<?php
    define('DNS', 'mysql:host=yourhost;port=3306;dbname=your_database');
    define('LOGIN', 'your_login');
    define ('PASSWORD', 'your_password');
    $options = array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
                     PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
                     PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8");
?>