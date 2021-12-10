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


<h3>Requisições</h3>

<a href="requisicao_editar.php">Novo registro</a>

<table width="100%">
    <tr>
        <th>ID</th>
        <th>Data / Hora</th>
        <th>Requisitante</th>
        <th></th>
    </tr>

    <?php
        //inicializa o contador de registros
        $x = 0;

        $sql = "select
                r.idrequisicao,
                r.data_hora,
                rt.nome as requisitante
            from
                requisicao r
                left join requisitante rt on rt.idrequisitante = r.requisitante_idrequisitante
            where
                r.data_exclusao is null
            order by
                r.data_hora"; //colocar 'desc' para ordenar pela mais recente primeiro";
        //executa a consulta e transforma em uma matriz $resultado
        $resultado = mysqli_query($conexao, $sql); 
        
        //percorre a matriz, extraindo a linha de cima a cada iteração e adiciona uma linha na tabela
        while ($dados = mysqli_fetch_array($resultado)) { 
            //incrementa o contador de registros
            $x++; 


            $idrequisicao = $dados['idrequisicao'];
            $data_hora = $dados['data_hora'];
            $requisitante = $dados['requisitante'];

            //alterna as cores conforme o resto da divisão do X por 2
            echo "<tr bgcolor=" . $cores[($x%2)] . ">
                    <td align='center'>$idrequisicao</td>
                    <td>$data_hora</td>
                    <td>$requisitante</td>
                    <td align='center' width='200'>
                        <a href='requisicao_item.php?idrequisicao=$idrequisicao'>Itens</a>                    
                        <a href='requisicao_editar.php?idrequisicao=$idrequisicao'>Editar</a>                    
                        <a href='requisicao_excluir.php?idrequisicao=$idrequisicao' onClick='return valida_exc();'>Excluir</a>                    
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
