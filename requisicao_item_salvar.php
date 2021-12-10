<?php
    require_once("session.php");
    require_once("conexao.php");

    $requisicao_idrequisicao = $_POST['requisicao_idrequisicao'];
    $equipamento_idequipamento = $_POST['equipamento_idequipamento'];
    $qtd = $_POST['qtd'];

    $sql = "insert into item (
            requisicao_idrequisicao,
            equipamento_idequipamento,
            qtd)
        values (
            $requisicao_idrequisicao,
            $equipamento_idequipamento,
            $qtd)";


    if (mysqli_query($conexao, $sql)) {
        $qtd*=(-1);
        mysqli_query($conexao, "call atualiza_estoque($equipamento_idequipamento, $qtd)");
        header("location: requisicao_item.php?idrequisicao=$requisicao_idrequisicao");
    }
    else {
        header("location: requisicao_item.php?idrequisicao=$requisicao_idrequisicao&erro=1");
        //se der erro mostra o sql executado e o erro
        //echo $sql . "; " . mysqli_error($conexao);
    }
?>
