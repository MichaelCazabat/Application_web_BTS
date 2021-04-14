<?php
function log_only(){
    if (session_status() == PHP_SESSION_NONE){	
        session_start();
    }

    if(!isset($_SESSION['id'])){
        $_SESSION['flash']['danger'] = "vous n'avez pas les droits d'acces sur cette page";
        header('Location: index.php');
        session_unset();
        exit();
    }
}
?>
