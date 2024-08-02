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
                $nomePet = $_POST['nomePet'];
                $especiePet = $_POST['especiePet'];
                $dataNascimento = isset($_POST['dataNascimento']) ? $_POST['dataNascimento'] : null; // Adicione este campo se for necessário
                $racaPet = $_POST['racaPet'];
                $pesoPet = $_POST['pesoPet'];
                $sexoPet = $_POST['sexoPet'];
                $porte = isset($_POST['porte']) ? $_POST['porte'] : null; // Adicione este campo se for necessário

                $resultadoPet = $usuarios->AtualizarPet($id_pet, $id_cliente, $nomePet, $especiePet, $dataNascimento, $racaPet, $pesoPet, $sexoPet, $porte);
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
