<?php
session_start();
include_once './conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
</head>

<body>

    <?php
    if (isset($_SESSION['success']) && $_SESSION['success'] != '') {
        echo $_SESSION['success'];
        unset($_SESSION['success']);
    }
    if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
        echo $_SESSION['status'];
        unset($_SESSION['status']);
    }
    ?>

    <form action="cadastrar.php" method="POST" enctype="multipart/form-data"><br>
        nome: <input type="text" name="nome" placeholder="Digite o Nome"><br>
        Clique para <input type="file" name="foto"><br>
        <input type="submit" name="cadastrar" value="Cadastrar"><br>
    </form>
    <br><br>

    <?php
    $query = "SELECT * FROM cadastro";
    $executa_query = mysqli_query($conn, $query);

    if (mysqli_num_rows($executa_query) > 0) {
    ?>
        <table border="1cm">
            <tr>
                <td>ID</td>
                <td>Nome</td>
                <td>Foto</td>
                <td>Editar</td>
                <td>Apagar</td>
            </tr>

            <?php
            while ($row = mysqli_fetch_assoc($executa_query)) {
            ?>

                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td> <?php echo $row['nome']; ?></td>
                    <td><?php echo '<img src="fotos/' . $row['foto'] . '" width="100px" height="100px" alt="Foto">' ?></td>
                    <td> <a href="#">Editar</a></td>
                    <td> <a href="#">Apagar</a></td>
                </tr>

            <?php
                }
            ?>

        </table>

    <?php
    } else {
        echo "Sem dados a serem exibidos!";
    }
    ?>

</body>

</html>