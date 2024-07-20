<?php
include './includes/header.php';

include './classe/Usuarios.php';


var_dump($_GET );

$id_usuario = $_GET['id_usuario'];

$usuario = new Usuarios();

$resultado = $usuario->deletarUsuario($id_usuario);


if ($resultado == 1){
    header('location:lista.php?deletado=1');
}