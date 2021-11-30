<?php

    require_once("conexao.php");
    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);    

    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    if ($usuario == '' || $senha == '') {
        header("location: index.php?erro=1");
    }

    $sql = "select
            idusuario
        from
            usuario
        where
            usuario like '" . $usuario . "' 
        and
            senha like '" . $senha . "'";

    $resultado = mysqli_query($conexao, $sql);
    $dados = mysqli_fetch_array($resultado);

    if ($dados['idusuario'] == "") {
        header("location: index.php?erro=1");
    }
    else {
        session_start();
        $_SESSION['idusuario'] = $dados['idusuario'];
        header("location: main.php");
    }


?>