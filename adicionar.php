<?php
require_once('conexao.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>adicionar</title>
</head>

<body>
    <h1>Criar novo perfil de usuario</h1>

    <div>

        <form action="." method="POST">
            <input hidden type="number" name="id" id="id">
            Nome: <input type="text" name="nome" id="nome"><br><br>
            Clique para <input type="file" name="foto" id="foto"><br><br>
            <input type="submit" name="enviar" id="enviar" value="Enviar">
        </form>

    </div>

    <br><br>

    <a href="index.php"> voltar </a>

</body>

</html>

<?php
$enviar = filter_input(INPUT_POST, 'enviar', FILTER_SANITIZE_STRING);

$id = filter_input(INPUT_POST, "id");

if($enviar){
    $nome = filter_input(INPUT_POST, "nome");
    $foto = $_FILES['foto']['name'];

    $query = "INSERT INTO usuarios (id, nome, foto) VALUES (:id, :nome, :foto)";
    $inserir = $conexao->prepare($query);
    $inserir->bindParam(':id', $id);
    $inserir->bindParam(':nome', $nome);
    $inserir->bindParam(':foto', $foto);


}