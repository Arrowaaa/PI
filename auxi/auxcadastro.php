<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/../classe/Usuarios.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Cadastro de novo usuário com apenas e-mail e senha
    if (isset($_POST['email']) && !isset($_POST['id_para_alterar'])) {
        $email = $_POST['email'];
        $password = $_POST['senha'];
        $passwordConfirm = $_POST['confirmSenha'];
        $usuarios = new Usuarios();

        if ($password === $passwordConfirm) {
            $resultado = $usuarios->CadastroCliente($email, $password, $passwordConfirm);

            if ($resultado === "Usuário cadastrado com sucesso") {
                header('Location: login.php');
                exit();
            } elseif ($resultado === "Usuário já existe") {
                header('Location: criar-usuario.php?erro=usuario_existe');
                exit();
            } else {
                echo $resultado;
            }
        } else {
            header('Location: criar-usuario.php?erro=senhas_nao_iguais');
            exit();
        }
    }

    // Atualização de informações do usuário logado
    if (isset($_POST['id_para_alterar'])) {
        $email = $_POST['email'];
        $password = $_POST['senha'];
        $passwordConfirm = $_POST['confirmSenha'];
        $id_para_alterar = $_POST['id_para_alterar'];

        $usuarios = new Usuarios();

        if ($password === $passwordConfirm) {
            $resultado = $usuarios->AtualizarUsuario($id_para_alterar, $email, $password, $passwordConfirm);
            if ($resultado === "Usuário atualizado com sucesso") {
                header('Location: perfil.php?id_cliente=' . $id_para_alterar);
                exit();
            } else {
                echo $resultado;
            }
        } else {
            header('Location: editar-usuario.php?erro=senhas_nao_iguais&id_cliente=' . $id_para_alterar);
            exit();
        }
    }

    // Lógica nova para cadastro de cliente e pet
    if (isset($_POST['tutor'])) {
        $nome = $_POST['tutor'];
        $cpf = $_POST['cpf'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $contato = $_POST['contato'];
        $sexo = $_POST['sexo'];
        $cep = $_POST['CEP'];
        $cidade = $_POST['cidade'];
        $complemento = $_POST['complemento'];
        $numero = $_POST['numero_residencia'];
        $nomep = $_POST['nomep'];
        $data_nascimento = $_POST['data_nascimento'];
        $especie = $_POST['especie'];
        $raca = $_POST['raca'];
        $peso = $_POST['peso'];
        $sexop = $_POST['sexop'];
        $porte = $_POST['porte'];

        try {
            $UsuarioSenha = new PDO('mysql:host=62.72.62.1;dbname=seu_banco_de_dados', 'u687609827_edilson', '>2Ana=]b');
            $UsuarioSenha->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $preparo = $UsuarioSenha->prepare("UPDATE  clientes SET(nome, cpf, email, telefone, contato, sexo, CEP, cidade, complemento, numero_residencia,nivel) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'base')");
            $preparo->execute([$nome, $cpf, $email, $telefone, $contato, $sexo, $cep, $cidade, $complemento, $numero]);

            $id_cliente = $UsuarioSenha->lastInsertId();

            $preparo = $UsuarioSenha->prepare("UPDATE pets SET(id_cliente, nome, especie, idade, raca, peso, sexo, porte) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $preparo->execute([$id_cliente, $nomePet, $especie, $idadePet, $raca, $peso, $sexoPet, $porte]);

            echo "Cadastro realizado com sucesso!";

            header('Location: perfil.php?id_cliente=' . $id_cliente);
            exit();
        } catch (PDOException $e) {
            echo "Erro ao cadastrar: " . $e->getMessage();
        }
    }
}
?>
