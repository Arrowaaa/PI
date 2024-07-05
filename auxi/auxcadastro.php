<?php
include 'classe/Usuarios.php';
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['usuario'])) {
        $user = $_POST['usuario'];
        $password = $_POST['senha'];
        $passwordConfirm = $_POST['confirma'];

        $usuario = new Usuarios();
        $resultado = $usuario->CadastroUsuario($user, $password, $passwordConfirm);

        if ($resultado === "Usuário cadastrado com sucesso") {

            header('Location: login.php');
            exit();
        }
        if ($resultado === "Usuário já existe") {

            header('Location: criar-usuario.php?erro=usuario_existe');
            exit();
        }
        if ($resultado === "Senhas não são iguais") {

            header('Location: criar-usuario.php?erro=senhas_nao_iguais');
            exit();
        } else {

            echo $resultado;
        }
    }

    if (!empty($_POST['id_para_alterar'])) {
        $user = $_POST['usuario'];
        $password = $_POST['senha'];
        $passwordConfirm = $_POST['confirma'];
        $id_para_alterar = $_POST['id_para_alterar'];

        $usuario = new Usuarios();

        $resultado = $usuario->AtualizarUsuario($id_para_alterar, $user, $password, $passwordConfirm);
    }

    // Lógica nova para cadastro de cliente e pet
    if (isset($_POST['tutor'])) {
        $nome = $_POST['tutor'];
        $cpf = $_POST['cpf'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $contato = $_POST['contato'];
        $sexo = $_POST['sexo'];
        $cep = $_POST['cep'];
        $endereco = $_POST['endereco'];
        $complemento = $_POST['complemento'];
        $numero = $_POST['Numero'];
        $nomePet = $_POST['paciente'];
        $idadePet = $_POST['idade'];
        $especie = $_POST['especie'];
        $raca = $_POST['raca'];
        $peso = $_POST['peso'];
        $sexoPet = $_POST['sexop'];
        $porte = $_POST['porte'];

        try {

            $preparo = $UsuarioSenha->prepare("INSERT INTO clientes (nome, cpf, email, telefone, contato, sexo, CEP, cidade, complemento, numero_residencia) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $preparo->execute([$nome, $cpf, $email, $telefone, $contato, $sexo, $cep, $endereco, $complemento, $numero]);

            $id_cliente = $UsuarioSenha->lastInsertId();

            $preparo = $UsuarioSenha->prepare("INSERT INTO pets (id_cliente, nome, especie, idade, raca, peso, sexo, porte) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $preparo->execute([$id_cliente, $nomePet, $especie, $idadePet, $raca, $peso, $sexoPet, $porte]);

            echo "Cadastro realizado com sucesso!";

            header('Location: perfil.php?id_cliente=' . $id_cliente);
            exit();
        } catch (PDOException $e) {
            echo "Erro ao cadastrar: " . $e->getMessage();
        }
    }
}
