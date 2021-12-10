<?php
    require_once("session.php");
    require_once("conexao.php");

    $sequencia = $_GET['sequencia'];
    $idrequisicao = $_GET['idrequisicao'];

    $sql = "update item set
            data_exclusao = '" . date("Y-m-d H:i:s") . "',
            idusuario_exclusao = " . $_SESSION['idusuario'] . "
        where
            sequencia = $sequencia";

    if (mysqli_query($conexao, $sql)) {
        $sql_estoque = "select equipamento_idequipamento, qtd from item where sequencia = $sequencia";
        $resultado = mysqli_query($conexao, $sql_estoque);
        $dados = mysqli_fetch_array($resultado);
        $equipamento_idequipamento = $dados['equipamento_idequipamento'];
        $qtd = $dados['qtd'];
        mysqli_query($conexao, "call atualiza_estoque($equipamento_idequipamento, $qtd)");
        header("location: requisicao_item.php?idrequisicao=$idrequisicao&erro=2");
    }
    else {
        header("location: requisicao_item.php?idrequisicao=$idrequisicao&erro=3");
        //se der erro mostra o sql executado e o erro
        //echo $sql . "; " . mysqli_error($conexao);
    }
?>
