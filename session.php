<?php
    session_start();
    if (!isset($_SESSION['idusuario']) || $_SESSION['idusuario'] == "") {
        header("location: index.php?erro=1");
    }
?>