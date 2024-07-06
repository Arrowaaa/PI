<?php

$serve = "62.72.62.1";
$banco = "u687609827_edilson";
$nome = "u687609827_edilson";
$senha = ">2Ana=]b";

try {

    $UsuarioSenha = new PDO("mysql:host=$serve;dbname=$banco", $nome, $senha);

    $UsuarioSenha->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {

    die("Erro de conexão: " . $e->getMessage());
}


