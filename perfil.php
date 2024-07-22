<?php
require_once './auxi/config.php';
require_once './classe/Usuarios.php';
require_once './classe/pessoas.php';

session_start();

$clientes = null;
$pet = null;
$nivel = 'base';
$agendamentos = [];

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

        // Consulta para obter os agendamentos do cliente, incluindo especialização e médico
        $preparo = $conn->prepare("
            SELECT agendamentos.*, especializacao.especializacao AS especializacao_nome, medicos.nome AS medico_nome, medicos.crm 
            FROM agendamentos 
            JOIN medicos ON agendamentos.id_medico = medicos.id_medico 
            JOIN especializacao ON medicos.especializacao = especializacao.id_especializacao 
            WHERE agendamentos.id_cliente = ?
        ");
        $preparo->execute([$id_cliente]);
        $agendamentos = $preparo->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        echo 'Erro: ' . $e->getMessage();
    }
}

$pessoas = new pessoas();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="./assets/img/favicon-32x32.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/perfil.css">
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
                <p>Nome: <?= htmlspecialchars(ucwords(strtolower($clientes['nome']))) ?></p>
                <p>Email: <?= htmlspecialchars($clientes['email']) ?></p>
                <p>CPF: <?= htmlspecialchars($clientes['cpf']) ?></p>
                <p>Telefone: <?= htmlspecialchars($clientes['telefone']) ?></p>
                <p>Contato: <?= htmlspecialchars($clientes['contato']) ?></p>
                <p>Sexo: <?= htmlspecialchars(pessoas::formatarSexo(ucwords(strtolower($clientes['sexo'])))) ?></p>
                <p>Cidade: <?= htmlspecialchars(ucwords(strtolower($clientes['cidade']))) ?>, <?= htmlspecialchars(strtoupper($clientes['estado'])) ?> , Complemento: <?= htmlspecialchars(ucwords(strtolower($clientes['complemento']))) ?>, Nº: <?= htmlspecialchars($clientes['numero_residencia']) ?></p>
            </div>
        <?php else : ?>
            <h2 style="text-align: center;">Cliente não encontrado</h2>
        <?php endif; ?><br>

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
                <p>Não há informações disponíveis sobre o pet.</p>
            <?php endif; ?>
        </div>

        <h2 style="text-align: center;">Agendamentos</h2><br>
        <div id="agendamentosInfo" class="content" style="text-align: left;">
            <h3>Informações dos Agendamentos:</h3><br>
            <?php if (!empty($agendamentos)) : ?>
                <?php foreach ($agendamentos as $agendamento) : ?>
                    <p>Data do Agendamento: <?= htmlspecialchars($agendamento['data_agendamento']) ?></p>
                    <p>Hora do Agendamento: <?= htmlspecialchars($agendamento['hora_agendamento']) ?></p>
                    <p>Especialização: <?= htmlspecialchars($agendamento['especializacao_nome']) ?></p>
                    <p>Médico: <?= htmlspecialchars($agendamento['medico_nome']) ?> (CRM: <?= htmlspecialchars($agendamento['crm']) ?>)</p>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Não há agendamentos disponíveis.</p>
            <?php endif; ?>
        </div>

        <div id="opcoes-container">
            <button id="baixo" onclick="toggleDropdown()">Opções ▼</button>
            <div id="oculto" class="bnt_oculto">
                <p><a href="cadastro.php?id_cliente=<?= $_SESSION['id_cliente'] ?>">Editar Informações</a></p>
                <?php if (isset($_SESSION['Nivel']) && $_SESSION['Nivel'] !== 'base') : ?>
                    <p><a href="cadastrarServicos.php">Tela de Serviços</a></p>
                    <p><a href="criar_usuario.php">Cadastrar ADM</a></p>
                    <p><a href="listarUser.php">Listar Usuários</a></p>
                    <p><a href="cadastro_medico.php">Sou Médico</a></p>
                    <p><a href="horarios.php">Horários dos Médicos</a></p>
                <?php endif; ?>
                <p><a href="agendamento.php">Agendar Consulta</a></p>
                <p><a href="index.php">Sair</a></p>
            </div>
        </div>

        <script src="./assets/js/login.js"></script>
    </div>
</body>

</html>
