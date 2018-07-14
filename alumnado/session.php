<?php if (! defined("WEBCENTROS_DOMINIO")) die ('No direct script access allowed');

// CONFIGURACIÓN DE LA SESIÓN
ini_set("session.use_cookies", 1);
ini_set("session.use_only_cookies", 1);
if ($_SERVER["HTTPS"] == "on") {
	ini_set("session.cookie_secure", 1);
}
ini_set("session.cookie_httponly", 1);
session_set_cookie_params(1800); // Duración de la sesión: 1800 segundos (30 minutos)
ini_set("session.gc_maxlifetime", 1800);
session_name("es");
session_start();

// Regeneramos ID de sesión
if (!isset($_SESSION['SERVER_GENERATED_SID_TIME']) || $_SESSION['SERVER_GENERATED_SID_TIME'] < (time() - 30)) {
  session_regenerate_id();
  $_SESSION['SERVER_GENERATED_SID_TIME'] = time();
}
