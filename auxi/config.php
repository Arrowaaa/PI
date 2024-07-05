<?php

$host = '62.72.62.1';
$db = 'u687609827_edilson';
$user = 'u687609827_edilson';
$pass = '>2Ana=]b';

try {

    $UsuarioSenha = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

    $UsuarioSenha->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {

    die("Erro de conexão: " . $e->getMessage());
}

