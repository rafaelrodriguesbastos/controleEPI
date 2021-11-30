<?php
    require_once("session.php");
    require_once("conexao.php");

    $idsetor = $_POST['idsetor'];
    $nome = $_POST['nome'];

    if ($idsetor == '') {
        $sql = "insert into setor (
                nome)
            values (
                '$nome')";
    }
    else {
        $sql = "update setor  set
                nome = '$nome' 
            where
                idsetor = $idsetor";
    }

    if (mysqli_query($conexao, $sql)) {
        header("location: setor.php?erro=0");
    }
    else {
        header("location: setor.php?erro=1");
        //se der erro mostra o sql executado e o erro
        //echo $sql . "; " . mysqli_error($conexao);
    }
?>
