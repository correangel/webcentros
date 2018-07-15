<?php
require_once("../bootstrap.php");
require_once("../config.php");

session_unset();
session_destroy();

header('Location:'.WEBCENTROS_DOMINIO.'alumnado/login.php');
exit();
?>
