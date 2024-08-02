<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/../classe/Usuarios.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuarios = new Usuarios();
    
    // Verifica se é uma atualização
    if (isset($_POST['id_cliente']) && !empty($_POST['id_cliente'])) {
        $id_cliente = $_POST['id_cliente'];
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $telefone = $_POST['telefone'];
        $contato = $_POST['contato'];
        $sexo = $_POST['sexo'];
        $cep = $_POST['CEP'];
        $cidade = $_POST['cidade'];
        $complemento = $_POST['complemento'];
        $numero_residencia = $_POST['numero_residencia'];
        $estado = $_POST['estado'];
        $senha = isset($_POST['senha']) ? $_POST['senha'] : null;

        // Atualiza o usuário
        $resultadoUsuario = $usuarios->AtualizarUsuario($id_cliente, $nome, $cpf, $telefone, $contato, $sexo, $cep, $cidade, $complemento, $numero_residencia, $estado, $senha);

        if ($resultadoUsuario === "Usuário atualizado com sucesso!") {
            // Atualiza o pet se os dados do pet estiverem presentes
            if (isset($_POST['id_pet']) && !empty($_POST['id_pet'])) {
                $id_pet = $_POST['id_pet'];
                $nomep = $_POST['nomep'];
                $especie = $_POST['especie'];
                $data_nascimento = isset($_POST['data_nascimento']) ? $_POST['data_nascimento'] : null; 
                $raca = $_POST['raca'];
                $peso = $_POST['peso'];
                $sexo = $_POST['sexop'];
                $porte = isset($_POST['porte']) ? $_POST['porte'] : null; 

                $resultadoPet = $usuarios->AtualizarPet($id_pet, $id_cliente, $nomep, $especie, $data_nascimento, $raca, $peso, $sexop, $porte);
                echo '<p class="alert alert-success">Cliente cadastrado com sucesso!!!</p>';
                if ($resultadoPet === "Pet atualizado com sucesso!") {
                    echo '<div class="alert alert-success">Usuário e Pet atualizados com sucesso!</div>';
                    echo '<script>';
                    echo 'setTimeout(function() { window.location.href = "../perfil.php"; }, 1600);';
                    echo '</script>';
                } else {
                    echo '<div class="alert alert-danger">' . $resultadoPet . '</div>';
                }
            } else {
                echo '<div class="alert alert-success">Usuário atualizado com sucesso!</div>';
                echo '<script>';
                echo 'setTimeout(function() { window.location.href = "../perfil.php"; }, 1600);';
                echo '</script>';
            }
        } else {
            echo '<div class="alert alert-danger">' . $resultadoUsuario . '</div>';
        }
    }
}
?>
