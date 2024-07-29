<?php
require_once 'config.php'; 
require_once '../classe/Usuarios.php';

// Verifique se a variável $UsuarioSenha está definida
if (!isset($UsuarioSenha)) {
    die('Erro: Variável de conexão $UsuarioSenha não está definida.');
}

// Processar informações do pet
$id_cliente = $_POST['id_cliente'];
$nomePet = $_POST['nomePet'];
$especiePet = $_POST['especiePet'];
$dataNascimento = $_POST['dataNascimento'];
$racaPet = $_POST['racaPet'];
$pesoPet = $_POST['pesoPet'];
$sexoPet = $_POST['sexoPet'];
$porte = $_POST['porte'];

if ($usuario->CadastroPet($id_cliente, $nomePet, $especiePet, $dataNascimento, $racaPet, $pesoPet, $sexoPet, $porte)) {
    header('Location: ../perfil.php?id_cliente=' . $id_cliente);
    exit;
} else {
    echo "Erro ao cadastrar o pet.";
}
?>
