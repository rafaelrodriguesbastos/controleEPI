<?php
    require_once("session.php");
    require_once("conexao.php");

    $idsetor = $_GET['idsetor'];

    $sql = "update setor set
            data_exclusao = '" . date("Y-m-d H:i:s") . "',
            idusuario_exclusao = " . $_SESSION['idusuario'] . "
        where
            idsetor = $idsetor";

    if (mysqli_query($conexao, $sql)) {
        header("location: setor.php?erro=2");
    }
    else {
        header("location: setor.php?erro=3");
        //se der erro mostra o sql executado e o erro
        //echo $sql . "; " . mysqli_error($conexao);
    }
?>
