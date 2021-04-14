<?php //page pour déconnecter les sessions, elle renvoie sur l'index
    session_start();
	$_SESSION = array();
	session_destroy();
	header("Location: index.php");
?>