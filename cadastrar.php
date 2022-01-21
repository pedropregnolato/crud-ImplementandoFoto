<?php
session_start();
include_once './conexao.php';

if (isset($_POST['cadastrar'])) {
    $nome = $_POST['nome'];
    $foto = $_FILES['foto']['name'];

    if (file_exists("fotos/" . $_FILES["foto"]["name"])) {
        $valida_foto = $_FILES['foto']['name'];
        $_SESSION['status'] = "Foto já existente '.$valida_foto.'";
        header('Location: index.php');
    } else {
        $query = "INSERT INTO cadastro (nome, foto) VALUES (:nome, :foto)";
        $executar = $conexao->prepare($query);
        $executar->bindParam(':nome', $nome);
        $executar->bindParam(':foto', $foto);

        if ($executar->execute()) {
            move_uploaded_file($_FILES['foto']['tmp_name'], 'fotos/' . $_FILES['foto']['name']);
            $_SESSION['success'] = "Cadastro realizado!";
            header('Location: index.php');
        } else {
            $_SESSION['success'] = "Ocorreu um erro. Cadastro não realizado!";
            header('Location: index.php');
        }
    }
}
