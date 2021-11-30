<?php
    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);    
    require_once("session.php");
    require("menu.php");
    require("conexao.php");

	if (isset($_GET['idsetor']) && $_GET['idsetor'] != '') {
		$sql = "select
				nome
			from
				setor
			where
				idsetor = " . $_GET['idsetor'];
		$resultado = mysqli_query($conexao, $sql);

		if (mysqli_num_rows($resultado) > 0) {
			$dados = mysqli_fetch_array($resultado);
			$idsetor = $_GET['idsetor'];
			$nome = $dados['nome'];
		}
		else {
			$idsetor = "";
			$nome = "";
		}
	}
	else {
		$idsetor = "";
		$nome = "";
	}	


?>

<h3>Setor</h3>

<form action="setor_salvar.php" method="POST">
	<input type="hidden" name="idsetor" value="<?php echo $idsetor; ?>">
    <label>Nome</label> <input type="text" name="nome" maxlength="45" size="45" value="<?php echo $nome; ?>">
    <br/>
    <br/>
    <input type="submit" value="Salvar">
    <input type="reset" value="Limpar">
</form>
