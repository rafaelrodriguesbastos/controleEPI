<?php

session_start();

unset($_SESSION['idusuario']);

header("Location: index.php");

?>