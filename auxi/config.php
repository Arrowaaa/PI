<?php

$serve = "62.72.62.1";
$banco = "u687609827_edilson";
$nome = "u687609827_edilson";
$senha = ">2Ana=]b";

try {
    // Criação da conexão PDO
    $UsuarioSenha = new PDO("mysql:host=$serve;dbname=$banco", $nome, $senha);
    // Configuração do modo de erro
    $UsuarioSenha->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    // Mensagem de erro
    die("Erro de conexão: " . $e->getMessage());
}


