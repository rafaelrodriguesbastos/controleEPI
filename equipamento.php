<?php
    require_once("session.php");
    require_once("conexao.php");
    require("menu.php");
    
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

<h3>Equipamentos</h3>

<a href="equipamento_editar.php">Novo registro</a>

<table width="100%">
    <tr>
        <th>ID</th>
        <th>Descrição</th>
        <th>UN</th>
        <th>Estoque atual</th>
        <th>Estoque mínimo</th>
        <th></th>
    </tr>

    <?php
        //inicializa o contador de registros
        $x = 0;

        $sql = "select
                idequipamento,
                descricao,
                un,
                estoque,
                minimo
            from
                equipamento
            where
                data_exclusao is null
            order by
                descricao";
        //executa a consulta e transforma em uma matriz $resultado
        $resultado = mysqli_query($conexao, $sql); 
        
        //percorre a matriz, extraindo a linha de cima a cada iteração e adiciona uma linha na tabela
        while ($dados = mysqli_fetch_array($resultado)) { 
            //incrementa o contador de registros
            $x++; 


            $idequipamento = $dados['idequipamento'];
            $descricao = $dados['descricao'];
            $un = $dados['un'];
            $estoque = $dados['estoque'];
            $minimo = $dados['minimo'];

            //alterna as cores conforme o resto da divisão do X por 2
            echo "<tr bgcolor=" . $cores[($x%2)] . ">
                    <td align='center'>$idequipamento</td>
                    <td>$descricao</td>
                    <td align='center'>$un</td>
                    <td align='center'>$estoque</td>
                    <td align='center'>$minimo</td>
                    <td align='center' width='120'>
                        <a href='equipamento_editar.php?idequipamento=$idequipamento'>Editar</a>                    
                        <a href='equipamento_excluir.php?idequipamento=$idequipamento' onClick='return valida_exc();'>Excluir</a>                    
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
