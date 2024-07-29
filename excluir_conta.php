<?php
session_start();
require_once './auxi/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_cliente'])) {
    $id_cliente = $_POST['id_cliente'];

    try {
        // Conexão com o banco de dados
        global $UsuarioSenha;

        // Atualiza o nível do cliente para desativar a conta 
        $preparo = $UsuarioSenha->prepare("UPDATE clientes SET nivel = 'desativado' WHERE id_cliente = ?");
        $preparo->execute([$id_cliente]);

        // Destrói a sessão do cliente e redireciona para a página de login
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
