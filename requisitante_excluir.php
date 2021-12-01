<?php
    require_once("session.php");
    require_once("conexao.php");

    $idrequisitante = $_GET['idrequisitante'];

    $sql = "update requisitante set
            data_exclusao = '" . date("Y-m-d H:i:s") . "',
            idusuario_exclusao = " . $_SESSION['idusuario'] . "
        where
            idrequisitante = $idrequisitante";

    if (mysqli_query($conexao, $sql)) {
        header("location: requisitante.php?erro=2");
    }
    else {
        header("location: requisitante.php?erro=3");
        //se der erro mostra o sql executado e o erro
        //echo $sql . "; " . mysqli_error($conexao);
    }
?>
