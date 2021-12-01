<?php
    require_once("session.php");
    require_once("conexao.php");

    $idrequisitante = $_POST['idrequisitante'];
    $nome = $_POST['nome'];
    $cargo = $_POST['cargo'];
    $setor_idsetor = $_POST['setor_idsetor'];

    if ($idrequisitante == '') {
        $sql = "insert into requisitante (
                nome,
                cargo,
                setor_idsetor)
            values (
                '$nome',
                '$cargo',
                $setor_idsetor)";
    }
    else {
        $sql = "update requisitante  set
                nome = '$nome',
                cargo = '$cargo',
                setor_idsetor = $setor_idsetor 
            where
                idrequisitante = $idrequisitante";
    }

    if (mysqli_query($conexao, $sql)) {
        header("location: requisitante.php?erro=0");
    }
    else {
        header("location: requisitante.php?erro=1");
        //se der erro mostra o sql executado e o erro
        //echo $sql . "; " . mysqli_error($conexao);
    }
?>
