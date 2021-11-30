<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="login.php" method="POST">
        <label>Usuário</label> <input type="text" name="usuario" size="16"><br />
        <label>Senha</label> <input type="password" name="senha" size="16"><br />
        <br />
        <input type="submit" value="OK">
    </form>

    <?php
        if (isset($_GET['erro']) && $_GET['erro'] == 1){
            echo "<script>
                    alert('Usuário ou senha inválidos!')
                </script>";
                unset($_SESSION['idusuario']);
            }
    ?>
</body>

</html>