<?php
require 'auxi/config.php'; 
require 'classe/pessoas.php'; 

$cliente = null; 

if (isset($_GET['id_cliente'])) {
    $id_cliente = $_GET['id_cliente'];

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/perfil.css">
    <!-- http://localhost/PI-reformulando-php/perfil.php?id_cliente=8 -->
</head>

<body>
    <div class="imagens">
        <img src="assets/img/cachorros/4.png" alt="Imagem 2" class="imagem-direita">
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
            <button class="btn_baixo" onclick="toggleDropdown()">Opções ▼ </button>
            <div id="oculto" class="bnt_oculto">
                <p><a href="cadastro.php">Editar Informações</a></p>
                <p><a href="cadastro.php">Cadastrar Suas Informações</a></p>
                <p><a href="cadastro_medico.php">Sou Médico</a></p>
                <p><a href="agendamento.php">Agendar Consulta</a></p>
                <p><a href="index.php">Sair</a></p>
            </div>
        </div>

        <script src="assets/js/login.js"></script>
    </div>
</body>

</html>
