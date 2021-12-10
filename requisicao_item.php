<?php
    require_once("session.php");
    require_once("conexao.php");
    require("menu.php");

	if (!isset($_GET['idrequisicao']) || $_GET['idrequisicao'] == '') {
        header("location: requisicao.php");
    }    

    $sql = "select
            r.data_hora,
            r.motivo,
            rt.nome
        from
            requisicao r
            left join requisitante rt on rt.idrequisitante = r.requisitante_idrequisitante
        where
            r.idrequisicao = " . $_GET['idrequisicao'];

    $resultado = mysqli_query($conexao, $sql);
    $dados = mysqli_fetch_array($resultado);
    $idrequisicao = $_GET['idrequisicao'];
    $data_hora = $dados['data_hora'];
    $motivo = $dados['motivo'];
    $nome = $dados['nome'];

    //cria um vetor de cores para o "zebrado" da tabela
    $cores[0] = "#CCCCCC";
    $cores[1] = "#FFFFFF";

?>

<script type="text/javascript" language="javascript">
    function valida_exc() {
        var retorno = confirm('Confirma exclusão do registro?');

        return (retorno);
    }
</script>


<h3>Requisição</h3>

<label>Data / Hora:</label><?php echo $data_hora; ?><br />
<label>Motivo:</label><br />
<textarea cols="80" rows="6" disabled><?php echo $motivo; ?></textarea><br />
<label>Requisitante:</label><?php echo $nome; ?><br />
<br />

<h3>Itens</h3>

<form action="requisicao_item_salvar.php" method="POST">
	<input type="hidden" name="requisicao_idrequisicao" value="<?php echo $idrequisicao; ?>"><br/>
    <label>Equipamento</label> 
	<select name="equipamento_idequipamento">
		<option value="">--Selecione uma opção--</option>
		<?php
			//$sql temporário para preeencher o "combo" do setor
			$sql_temp = "select
					idequipamento,
					descricao
				from
					equipamento
				where
					data_exclusao is null
				order by
					descricao";
			$resultado_temp = mysqli_query($conexao, $sql_temp);
			while ($dados_temp = mysqli_fetch_array($resultado_temp)) {
				$idequipamento = $dados_temp['idequipamento'];
				$descricao = $dados_temp['descricao'];

				echo "<option value='$idequipamento'>$descricao</option>";
			}
		?>
	</select>
	<br/>
    <label>QTD</label> <input type="text" name="qtd" maxlength="5" size="5"><br/>
    <br/>
    <input type="submit" value="Salvar">
    <input type="reset" value="Limpar">
</form>

<table width="100%">
    <tr>
        <th>Seq</th>
        <th>Equipamento</th>
        <th>QTD</th>
        <th></th>
    </tr>

    <?php
        //inicializa o contador de registros
        $x = 0;

        $sql = "select
                i.sequencia,
                e.descricao,
                i.qtd
            from
                item i
                left join equipamento e on e.idequipamento = i.equipamento_idequipamento
            where
                i.data_exclusao is null
            order by
                i.sequencia";
        //executa a consulta e transforma em uma matriz $resultado
        $resultado = mysqli_query($conexao, $sql); 
        
        //percorre a matriz, extraindo a linha de cima a cada iteração e adiciona uma linha na tabela
        while ($dados = mysqli_fetch_array($resultado)) { 
            //incrementa o contador de registros
            $x++; 

            $sequencia = $dados['sequencia'];
            $descricao = $dados['descricao'];
            $qtd = $dados['qtd'];

            //alterna as cores conforme o resto da divisão do X por 2
            echo "<tr bgcolor=" . $cores[($x%2)] . ">
                    <td align='center'>$x</td>
                    <td>$descricao</td>
                    <td align='center'>$qtd</td>
                    <td align='center' width='60'>
                        <a href='requisicao_item_excluir.php?sequencia=$sequencia&idrequisicao=$idrequisicao' onClick='return valida_exc();'>Excluir</a>
                    </td>
                </tr>";
        }

    ?>

</table>
<br/>
<?php echo "$x registro(s) encontrado(s)"; ?>
<?php
    if (isset($_GET['erro'])){

        switch ($_GET['erro']) {
            case 0:
                echo "<script>
                    alert('Registro salvo com sucesso!')
                </script>";
                break;
            case 1:
                echo "<script>
                    alert('Erro ao salvar o registro!')
                </script>";
                break;
            case 2:
                echo "<script>
                    alert('Registro excluído com sucesso!')
                </script>";
                break;
            case 3:
                echo "<script>
                    alert('Erro ao excluir o registro!')
                </script>";
                break;
            }
    }
?>
