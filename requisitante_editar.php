<?php
    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);    
    require_once("session.php");
    require("menu.php");
    require("conexao.php");

	if (isset($_GET['idrequisitante']) && $_GET['idrequisitante'] != '') {
		$sql = "select
				nome,
				cargo,
				setor_idsetor
			from
				requisitante
			where
				idrequisitante = " . $_GET['idrequisitante'];
		$resultado = mysqli_query($conexao, $sql);

		if (mysqli_num_rows($resultado) > 0) {
			$dados = mysqli_fetch_array($resultado);
			$idrequisitante = $_GET['idrequisitante'];
			$nome = $dados['nome'];
			$cargo = $dados['cargo'];
			$setor_idsetor = $dados['setor_idsetor'];
		}
		else {
			$idrequisitante = "";
			$nome = "";
			$cargo = "";
			$setor_idsetor = "";
		}
	}
	else {
		$idrequisitante = "";
		$nome = "";
		$cargo = "";
		$setor_idsetor = "";
	}	


?>

<h3>Requisitante</h3>

<form action="requisitante_salvar.php" method="POST">
	<input type="hidden" name="idrequisitante" value="<?php echo $idrequisitante; ?>"><br/>
    <label>Nome</label> <input type="text" name="nome" maxlength="80" size="80" value="<?php echo $nome; ?>"><br/>
    <label>Cargo</label> <input type="text" name="cargo" maxlength="45" size="45" value="<?php echo $cargo; ?>"><br/>
    <label>Setor</label> 
	<select name="setor_idsetor">
		<option value="">--Selecione uma opção--</option>
		<?php
			//$sql temporário para preeencher o "combo" do setor
			$sql_temp = "select
					idsetor,
					nome
				from
					setor
				where
					data_exclusao is null
				order by
					nome";
			$resultado_temp = mysqli_query($conexao, $sql_temp);
			while ($dados_temp = mysqli_fetch_array($resultado_temp)) {
				$idsetor = $dados_temp['idsetor'];
				$setor = $dados_temp['nome'];

				if ($idsetor == $setor_idsetor) {
					echo "<option value='$idsetor' selected>$setor</option>";
				}
				else {
					echo "<option value='$idsetor'>$setor</option>";
				}
			}
		?>
	</select>
	<br/>
    <br/>
    <input type="submit" value="Salvar">
    <input type="reset" value="Limpar">
</form>
