<?php
session_start();
include './auxi/config.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_cliente'])) {
    $id_cliente = $_POST['id_cliente'];

    try {
        global $UsuarioSenha;
        $preparo = $UsuarioSenha->prepare("UPDATE clientes SET nivel = 'desativado' WHERE id_cliente = ?");
        $preparo->execute([$id_cliente]);
        session_unset();
        session_destroy();
        header('Location: login.php');
        exit();

    } catch (PDOException $e) {
        echo 'Erro: ' . $e->getMessage();
    }
} else {
    header('Location: perfil.php');
    exit();
}
?>
