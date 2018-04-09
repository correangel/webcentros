<?php
require_once("../bootstrap.php");
require_once("../config.php");
require_once("session.php");

session_unset();
session_destroy();

header('Location:'.WEBCENTROS_DOMINIO.'alumnado/login.php');
exit();
?>