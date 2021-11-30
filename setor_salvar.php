<?php
    require_once("session.php");
    require_once("conexao.php");

    $nome = $_POST['nome'];

    $sql = "insert into setor (
            nome)
        values (
            '$nome')";

    if (mysqli_query($conexao, $sql)) {
        header("location: setor.php?erro=0");
    }
    else {
        header("location: setor.php?erro=1");
        //se der erro mostra o sql executado e o erro
        //echo $sql . "; " . mysqli_error($conexao);
    }
?>
