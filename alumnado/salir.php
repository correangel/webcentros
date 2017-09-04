<?php
require("../config.php");

session_start(); 
$_SESSION = array(); 
session_destroy();
header("Location:".WEBCENTROS_DOMINIO."alumnado/login.php");
exit();
?>