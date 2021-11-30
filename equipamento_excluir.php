<?php
    require_once("session.php");
    require_once("conexao.php");

    $idequipamento = $_GET['idequipamento'];

    $sql = "update equipamento set
            data_exclusao = '" . date("Y-m-d H:i:s") . "',
            idusuario_exclusao = " . $_SESSION['idusuario'] . "
        where
            idequipamento = $idequipamento";

    if (mysqli_query($conexao, $sql)) {
        header("location: equipamento.php?erro=2");
    }
    else {
        header("location: equipamento.php?erro=3");
        //se der erro mostra o sql executado e o erro
        //echo $sql . "; " . mysqli_error($conexao);
    }
?>
