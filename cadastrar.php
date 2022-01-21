<?php
session_start();
include_once './conexao.php';

//insert
if (isset($_POST['cadastrar'])) {
    $nome = $_POST['nome'];
    $foto = $_FILES['foto']['name'];

    $nome = strtoupper($nome);

    if (file_exists("fotos/" . $id . '/' . $_FILES["foto"]["name"])) {
        $valida_foto = $_FILES['foto']['name'];
        $_SESSION['status'] = "Foto já existente '.$valida_foto.'";
        header('Location: index.php');
    } else {
        $query = "INSERT INTO cadastro (nome, foto) VALUES (:nome, :foto)";
        $executar = $conexao->prepare($query);
        $executar->bindParam(':nome', $nome);
        $executar->bindParam(':foto', $foto);

        if ($executar->execute()) {

            $salvar_id = $conexao->lastInsertId();

            $diretorio = 'fotos/' . $salvar_id . "/";

            mkdir($diretorio, 0755);

            if (move_uploaded_file($_FILES['foto']['tmp_name'], $diretorio . $_FILES['foto']['name'])) {
                $_SESSION['success'] = "Cadastro realizado!";
                header('Location: index.php');
            }
        } else {
            $_SESSION['status'] = "Ocorreu um erro. Cadastro não realizado!";
            header('Location: index.php');
        }
    }
}

//update
if (isset($_POST['editar_perfil'])) {
    $editar_id = $_POST['editar_id'];
    $editar_nome = $_POST['editar_nome'];
    $editar_foto = $_FILES['foto']['name'];

    $editar_nome = strtoupper($editar_nome);

    if (file_exists("fotos/" . $editar_id . '/' . $_FILES["foto"]["name"])) {
        $valida_foto = $_FILES['foto']['name'];
        $_SESSION['status'] = "Foto já existente '.$valida_foto.'";
        header('Location: index.php');
    } else {
        if ($executar) {

            $query = "UPDATE cadastro SET nome='$editar_nome', foto='$editar_foto' WHERE id='$editar_id' ";
            $executar = mysqli_query($conn, $query);

            move_uploaded_file($_FILES['foto']['tmp_name'], 'fotos/' . $editar_id . '/' . $_FILES['foto']['name']);
            $_SESSION['success'] = "Cadastro atualizado!";
            header('Location: index.php');
        } else {
            $_SESSION['status'] = "Ocorreu um erro. Cadastro não atualizado!";
            header('Location: index.php');
        }
    }
}

//delete
if (isset($_POST['deletar'])) {
    $id = $_POST['deletar_id'];

    $query = "DELETE FROM cadastro WHERE id='$id'";
    $executar = mysqli_query($conn, $query);

    if ($executar) {
        $_SESSION['success'] = "Cadastro deletado!";
        header('Location: index.php');
    } else {
        $_SESSION['status'] = "Ocorreu um erro. Tente novamente!";
        header('Location: index.php');
    }
}
