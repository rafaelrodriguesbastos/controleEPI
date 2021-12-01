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


<h3>Requisitantes</h3>

<a href="requisitante_editar.php">Novo registro</a>

<table width="100%">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Cargo</th>
        <th>Setor</th>
        <th></th>
    </tr>

    <?php
        //inicializa o contador de registros
        $x = 0;

        $sql = "select
                r.idrequisitante,
                r.nome,
                r.cargo,
                s.nome as setor
            from
                requisitante r
                left join setor s on s.idsetor = r.setor_idsetor
            where
                r.data_exclusao is null
            order by
                r.nome";
        //executa a consulta e transforma em uma matriz $resultado
        $resultado = mysqli_query($conexao, $sql); 
        
        //percorre a matriz, extraindo a linha de cima a cada iteração e adiciona uma linha na tabela
        while ($dados = mysqli_fetch_array($resultado)) { 
            //incrementa o contador de registros
            $x++; 


            $idrequisitante = $dados['idrequisitante'];
            $nome = $dados['nome'];
            $cargo = $dados['cargo'];
            $setor = $dados['setor'];

            //alterna as cores conforme o resto da divisão do X por 2
            echo "<tr bgcolor=" . $cores[($x%2)] . ">
                    <td align='center'>$idrequisitante</td>
                    <td>$nome</td>
                    <td>$cargo</td>
                    <td>$setor</td>
                    <td align='center' width='120'>
                        <a href='requisitante_editar.php?idrequisitante=$idrequisitante'>Editar</a>                    
                        <a href='requisitante_excluir.php?idrequisitante=$idrequisitante' onClick='return valida_exc();'>Excluir</a>                    
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
