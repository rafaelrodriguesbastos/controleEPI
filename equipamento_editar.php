<?php
    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);    
    require_once("session.php");
    require("menu.php");
    require("conexao.php");

	if (isset($_GET['idequipamento']) && $_GET['idequipamento'] != '') {
		$sql = "select
				descricao,
				un,
				estoque,
				minimo
			from
				equipamento
			where
				idequipamento = " . $_GET['idequipamento'];
		$resultado = mysqli_query($conexao, $sql);

		if (mysqli_num_rows($resultado) > 0) {
			$dados = mysqli_fetch_array($resultado);
			$idequipamento = $_GET['idequipamento'];
			$descricao = $dados['descricao'];
			$un = $dados['un'];
			$estoque = $dados['estoque'];
			$minimo = $dados['minimo'];
		}
		else {
			$idequipamento = "";
			$descricao = "";
			$un = "";
			$estoque = "";
			$minimo = "";
		}
	}
	else {
		$idequipamento = "";
		$descricao = "";
		$un = "";
		$estoque = "";
		$minimo = "";
	}	


?>

<h3>Equipamento</h3>

<form action="equipamento_salvar.php" method="POST">
	<input type="hidden" name="idequipamento" value="<?php echo $idequipamento; ?>">
    <label>Descrição</label> <input type="text" name="descricao" maxlength="45" size="45" value="<?php echo $descricao; ?>"><br/>
    <label>UN</label> <input type="text" name="un" maxlength="10" size="10" value="<?php echo $un; ?>"><br/>
    <label>Estoque atual</label> <input type="text" name="estoque" maxlength="5" size="5" value="<?php echo $estoque; ?>"><br/>
    <label>Estoque mínimo</label> <input type="text" name="minimo" maxlength="5" size="5" value="<?php echo $minimo; ?>"><br/>
    <br/>
    <br/>
    <input type="submit" value="Salvar">
    <input type="reset" value="Limpar">
</form>
