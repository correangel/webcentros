<?php
require_once("../bootstrap.php");
require_once("../config.php");

session_start(); 
$_SESSION = array(); 
session_destroy();
header('Location:'.WEBCENTROS_DOMINIO.'alumnado/login.php');
exit();
?>