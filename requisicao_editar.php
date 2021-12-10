<?php
    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);    
    require_once("session.php");
    require("menu.php");
    require("conexao.php");

	if (isset($_GET['idrequisicao']) && $_GET['idrequisicao'] != '') {
		$sql = "select
				data_hora,
				motivo,
				requisitante_idrequisitante
			from
				requisicao
			where
				idrequisicao = " . $_GET['idrequisicao'];
		$resultado = mysqli_query($conexao, $sql);

		if (mysqli_num_rows($resultado) > 0) {
			$dados = mysqli_fetch_array($resultado);
			$idrequisicao = $_GET['idrequisicao'];
			$data_hora = $dados['data_hora'];
			$motivo = $dados['motivo'];
			$requisitante_idrequisitante = $dados['requisitante_idrequisitante'];
		}
		else {
			$idrequisicao = "";
			$data_hora = "";
			$motivo = "";
			$requisitante_idrequisitante = "";
		}
	}
	else {
		$idrequisicao = "";
		$data_hora = "";
		$motivo = "";
		$requisitante_idrequisitante = "";
	}	


?>

<h3>Requisição</h3>

<form action="requisicao_salvar.php" method="POST">
	<input type="hidden" name="idrequisicao" value="<?php echo $idrequisicao; ?>"><br/>
    <label>Data / Hora</label> <input type="text" name="data_hora" maxlength="19" size="20" value="<?php echo $data_hora; ?>"><br/>
    <label>Motivo</label><br />
	<textarea name="motivo" cols="80" rows="6"><?php echo $motivo; ?></textarea><br/>
    <label>Requisitante</label> 
	<select name="requisitante_idrequisitante">
		<option value="">--Selecione uma opção--</option>
		<?php
			//$sql temporário para preeencher o "combo" do setor
			$sql_temp = "select
					idrequisitante,
					nome
				from
					requisitante
				where
					data_exclusao is null
				order by
					nome";
			$resultado_temp = mysqli_query($conexao, $sql_temp);
			while ($dados_temp = mysqli_fetch_array($resultado_temp)) {
				$idrequisitante = $dados_temp['idrequisitante'];
				$nome = $dados_temp['nome'];

				if ($idrequisitante == $requisitante_idrequisitante) {
					echo "<option value='$idrequisitante' selected>$nome</option>";
				}
				else {
					echo "<option value='$idrequisitante'>$nome</option>";
				}
			}
		?>
	</select>
	<br/>
    <br/>
    <input type="submit" value="Salvar">
    <input type="reset" value="Limpar">
</form>
