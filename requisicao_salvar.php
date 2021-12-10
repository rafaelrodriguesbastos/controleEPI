<?php
    require_once("session.php");
    require_once("conexao.php");

    $idrequisicao = $_POST['idrequisicao'];
    $data_hora = $_POST['data_hora'];
    $motivo = $_POST['motivo'];
    $requisitante_idrequisitante = $_POST['requisitante_idrequisitante'];

    if ($idrequisicao == '') {
        $sql = "insert into requisicao (
                data_hora,
                motivo,
                requisitante_idrequisitante)
            values (
                '$data_hora',
                '$motivo',
                $requisitante_idrequisitante)";
    }
    else {
        $sql = "update requisicao  set
                data_hora = '$data_hora',
                motivo = '$motivo',
                requisitante_idrequisitante = $requisitante_idrequisitante 
            where
                idrequisicao = $idrequisicao";
    }

    if (mysqli_query($conexao, $sql)) {
        header("location: requisicao_item.php?idrequisicao=$idrequisicao");
    }
    else {
        header("location: requisicao.php?erro=1");
        //se der erro mostra o sql executado e o erro
        //echo $sql . "; " . mysqli_error($conexao);
    }

?>
