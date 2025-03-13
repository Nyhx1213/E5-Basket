<?php 
session_start(); 
require "connect.php";
$db = new PDO(DNS, LOGIN, PASSWORD, $options);
include "permission.inc.php";
        if (isset($_SESSION['login'])) { 
                $_SESSION = array(); // If it's submitted, unset and destroy the session.
                session_destroy();
                header("Location: index.php");
            }