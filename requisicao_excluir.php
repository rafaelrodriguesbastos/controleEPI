<?php
    require_once("session.php");
    require_once("conexao.php");

    $idrequisicao = $_GET['idrequisicao'];

    $sql = "update requisicao set
            data_exclusao = '" . date("Y-m-d H:i:s") . "',
            idusuario_exclusao = " . $_SESSION['idusuario'] . "
        where
            idrequisicao = $idrequisicao";

    if (mysqli_query($conexao, $sql)) {
        header("location: requisicao.php?erro=2");
    }
    else {
        header("location: requisicao.php?erro=3");
        //se der erro mostra o sql executado e o erro
        //echo $sql . "; " . mysqli_error($conexao);
    }
?>
