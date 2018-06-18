<?php if (! defined("WEBCENTROS_DOMINIO")) die ('No direct script access allowed');

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
