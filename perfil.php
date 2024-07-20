<?php
require_once './auxi/config.php';
require_once './classe/Usuarios.php';
require_once './classe/pessoas.php';

session_start();

$clientes = null;
$pet = null;
$nivel = 'base';
require 'auxi/config.php'; 
require 'classe/pessoas.php'; 

$cliente = null; 

if (isset($_GET['id_cliente'])) {
    $id_cliente = $_GET['id_cliente'];

    try {
        $conn = new PDO('mysql:host=62.72.62.1;dbname=u687609827_edilson', 'u687609827_edilson', '>2Ana=]b');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Busca informações do cliente
        $preparo = $conn->prepare("SELECT * FROM clientes WHERE id_cliente = ?");
        $preparo->execute([$id_cliente]);
        $clientes = $preparo->fetch(PDO::FETCH_ASSOC);
        $_SESSION['id_cliente'] = $id_cliente;

        if (!$clientes) {
            header('Location: login.php');
            exit();
        }

        // Define o nível de acesso do cliente
        if (isset($clientes['nivel'])) {
            $nivel = $clientes['nivel'];
            $_SESSION['Nivel'] = $nivel;
        }

        // Consulta para obter informações do pet associado ao cliente
        $preparo = $conn->prepare("SELECT pets.*, especies.nome AS especie_nome FROM pets JOIN especies ON pets.especie = especies.id_especie WHERE pets.id_cliente = ?");
        $preparo->execute([$id_cliente]);
        $pet = $preparo->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        echo 'Erro: ' . $e->getMessage();
    }
}

$pessoas = new pessoas();
?>

    if ($UsuarioSenha) {
        $preparo = $UsuarioSenha->prepare("SELECT * FROM clientes WHERE id_cliente = ?");
        $preparo->execute([$id_cliente]);
        $cliente = $preparo->fetch(PDO::FETCH_ASSOC);

        if ($cliente) {
            $preparo = $UsuarioSenha->prepare("SELECT pets.*, especies.nome AS especie_nome FROM pets JOIN especies ON pets.especie = especies.id_especie WHERE pets.id_cliente = ?");
            $preparo->execute([$id_cliente]);
            $pet = $preparo->fetch(PDO::FETCH_ASSOC);
        } else {
            header('Location: login.php');
            exit();
        }
    } else {
        die("Erro de conexão com o banco de dados.");
    }
} 
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/perfil.css">
    <!-- http://localhost/PI-reformulando-php/perfil.php?id_cliente=8 -->
</head>

<body>
    <div class="imagens">
        <img src="assets/img/cachorros/4.png" alt="Imagem 2" class="imagem-direita">
        <img src="assets/img/cachorros/meddog.png" id="imagem-esquerda" alt="Imagem 6" class="imagem-esquerda">
    </div>
    <div class="container">
        <?php if ($clientes) : ?>
            <h2 style="text-align: center;">Bem-vindo ao Seu Perfil, Mr. <?= htmlspecialchars(ucwords(strtolower($clientes['nome']))) ?></h2><br>
            <h2 style="text-align: center;">Dados pessoais</h2><br>

            <div id="cadastroInfo" class="content" style="text-align: left;">
                <h3>Informações:</h3><br>
                <p>CPF: <?= htmlspecialchars(ucwords(strtolower($clientes['cpf']))) ?></p>
                <p>Email: <?= htmlspecialchars(ucwords(strtolower($clientes['email']))) ?></p>
                <p>Telefone: <?= htmlspecialchars(ucwords(strtolower($clientes['telefone']))) ?></p>
                <p>Contato: <?= htmlspecialchars(ucwords(strtolower($clientes['contato']))) ?></p>
                <p>Sexo: <?= htmlspecialchars(pessoas::formatarSexo(ucwords(strtolower($clientes['sexo'])))) ?></p>
                <p>Cidade: <?= htmlspecialchars(ucwords(strtolower($clientes['cidade']))) ?>, <?= htmlspecialchars(strtoupper($clientes['estado'])) ?> , Complemento: <?= htmlspecialchars(ucwords(strtolower($clientes['complemento']))) ?>, Nº: <?= htmlspecialchars($clientes['numero_residencia']) ?></p>
            </div>
        <?php else : ?>
            <h2 style="text-align: center;">Cliente não encontrado</h2>
        <?php endif; ?>

        <h2 style="text-align: center;">Dados do Pet</h2><br>
        <div id="petInfo" class="content" style="text-align: left;">
            <h3>Informações do Pet:</h3><br>
            <?php if ($pet && is_array($pet)) : ?>
                <p>Nome do Pet: <?= htmlspecialchars(ucwords(strtolower($pet['nomep']))) ?></p>
                <p>Espécie: <?= htmlspecialchars(ucwords(strtolower($pet['especie_nome']))) ?></p>
                <p>Idade: <?= htmlspecialchars($pessoas->calcularIdade(ucwords(strtolower($pet['data_nascimento'])))) ?> anos</p>
                <p>Raça: <?= htmlspecialchars(ucwords(strtolower($pet['raca']))) ?></p>
                <p>Peso: <?= htmlspecialchars(pessoas::formatarPeso(ucwords(strtolower($pet['peso'])))) ?></p>
                <p>Sexo: <?= htmlspecialchars(pessoas::formatarSexop(ucwords(strtolower($pet['sexop'])))) ?></p>
                <p>Porte: <?= htmlspecialchars(ucwords(strtolower($pet['porte']))) ?></p>
            <?php else : ?>
        <img src="assets/img/cachorros/meddog (1).png" id="imagem-esquerda" alt="Imagem 6" class="imagem-esquerda">
    </div>
    <div class="container">
        <h2 style="text-align: center;">Bem-vindo ao Seu Perfil <?= htmlspecialchars($cliente['nome']) ?></h2><br>
        <h2 style="text-align: center;">Dados pessoais</h2><br>

        <div id="cadastroInfo" class="content" style="text-align: left;">
            <h3>Informações:</h3><br>
            <p>CPF: <?= htmlspecialchars($cliente['cpf']) ?></p>
            <p>Nome: <?= htmlspecialchars($cliente['nome']) ?></p>
            <p>Email: <?= htmlspecialchars($cliente['email']) ?></p>
            <p>Telefone: <?= htmlspecialchars($cliente['telefone']) ?></p>
            <p>Cidade: <?= htmlspecialchars($cliente['cidade']) ?>, complemento: <?= htmlspecialchars($cliente['complemento']) ?>, Nº: <?= htmlspecialchars($cliente['numero_residencia']) ?></p>
        </div>

        <h2 style="text-align: center;">Dados do Pet</h2><br>
        <div id="petInfo" class="content" style="text-align: left;">
            <h3>Informações do Pet:</h3><br>
            <?php if ($pet): ?>
                <p>Nome do Pet: <?= htmlspecialchars($pet['nome']) ?></p>
                <p>Espécie: <?= htmlspecialchars($pet['especie_nome']) ?></p>
                <p>Idade: <?= htmlspecialchars($pet['idade']) ?></p>
                <p>Raça: <?= htmlspecialchars($pet['raca']) ?></p>
                <p>Peso: <?= htmlspecialchars(pessoas::formatarPeso($pet['peso'])) ?></p>
                <p>Sexo: <?= htmlspecialchars(pessoas::formatarSexo($pet['sexo'])) ?></p>
                <p>Porte: <?= htmlspecialchars($pet['porte']) ?></p>
            <?php else: ?>
                <p>Não há informações disponíveis sobre o pet.</p>
            <?php endif; ?>
        </div>

        <div id="opcoes-container">
            <button id="baixo" onclick="toggleDropdown()">Opções ▼</button>
            <div id="oculto" class="bnt_oculto">
                <p><a href="cadastro.php?id_cliente=<?= $_SESSION['id_cliente'] ?>">Editar Informações</a></p>
                <?php if (isset($_SESSION['Nivel']) && $_SESSION['Nivel'] !== 'base') : ?>
                    <p><a href="cadastrarServicos.php">Tela de Serviços</a></p>
                    <p><a href="criar_usuarioAdm.php">Cadastrar ADM</a></p>
                    <p><a href="listarUser.php">Listar Usuários</a></p>
                <?php endif; ?>
            <button class="btn_baixo" onclick="toggleDropdown()">Opções ▼ </button>
            <div id="oculto" class="bnt_oculto">
                <p><a href="cadastro.php">Editar Informações</a></p>
                <p><a href="cadastro.php">Cadastrar Suas Informações</a></p>
                <p><a href="cadastro_medico.php">Sou Médico</a></p>
                <p><a href="agendamento.php">Agendar Consulta</a></p>
                <p><a href="index.php">Sair</a></p>
            </div>
        </div>

        <script src="./assets/js/login.js"></script>
        <script src="assets/js/login.js"></script>
    </div>
</body>

</html>
