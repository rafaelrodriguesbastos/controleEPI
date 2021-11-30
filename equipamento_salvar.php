<?php
    require_once("session.php");
    require_once("conexao.php");

    $idequipamento = $_POST['idequipamento'];
    $descricao = $_POST['descricao'];
    $un = $_POST['un'];
    $estoque = $_POST['estoque'];
    $minimo = $_POST['minimo'];

    if ($idequipamento == '') {
        $sql = "insert into equipamento (
                descricao,
                un,
                estoque,
                minimo)
            values (
                '$descricao',
                '$un',
                $estoque,
                $minimo)";
    }
    else {
        $sql = "update equipamento  set
                descricao = '$descricao',
                un = '$un',
                estoque = $estoque,
                minimo = $minimo
            where
                idequipamento = $idequipamento";
    }

    if (mysqli_query($conexao, $sql)) {
        header("location: equipamento.php?erro=0");
    }
    else {
        header("location: equipamento.php?erro=1");
        //se der erro mostra o sql executado e o erro
        //echo $sql . "; " . mysqli_error($conexao);
    }
?>
