<?php
    require_once("session.php");
    require("menu.php");

?>

<h3>Setor</h3>

<form action="setor_salvar.php" method="POST">
    <label>Nome</label> <input type="text" name="nome" maxlength="45" size="45">
    <br/>
    <br/>
    <input type="submit" value="Salvar">
    <input type="reset" value="Limpar">
</form>