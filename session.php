<?php
    session_start();
    if (!isset($_SESSION['idusuario']) || $_SESSION['idusuario'] == "") {
        header("location: index.php?erro=1");
    }

    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);    

?>