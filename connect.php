<?php
    define('DNS', 'mysql:host=falbala.futaie.org;port=3306;dbname=adjedjm_basket');
    define('LOGIN', 'adjedjm');
    define ('PASSWORD', 'Iagh3heike8f');
    $options = array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
                     PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
                     PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES utf8");
?>
