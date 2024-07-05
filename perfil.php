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
</head>

<body>
    <div class="imagens">
        <img src="assets/img/cachorros/4.png" alt="Imagem 2" class="imagem-direita">
        <img src="assets/img/cachorros/6.png" id="imagem-esquerda" alt="Imagem 6" class="imagem-esquerda">
    </div>
    <div class="container">
        <h2 style="text-align: center;">Bem-vindo à Seu Perfil</h2>
        <h2> Dados pessoais </h2>
        
        <div id="cadastroInfo" class="content" style="text-align: left;">
            <h3>Informações:</h3>
            <p>CPF: 000.000.000-00</p>
            <p>Nome: Arrow</p>
            <p>Email: arrow@exemplo.com</p>
            <p>Telefone: (00) 0 0000-0000</p>
            <p>Endereço: Rua: Sol - Americana-SP</p>
        </div>
        <!-- Exibir as informações do agendamento -->
        <div id="agendamentoInfo" class="content" style="text-align: left;">
            <h3>Informações do Agendamento:</h3>

            <p>Médico: Arrow</p>
            <p>Período: Manhã</p>
            <p>Data: 2024-03-28</p>
            <p>Hora: 09:00</p>
        </div>

        <div id="opcoes-container">
        <button class="btn_baixo" onclick="toggleDropdown()">Opções ▼</button>
        <div id="oculto" class="bnt_oculto">
            <p><a href="cadastro.php">Editar Informações</a></p>
            <p><a href="cadastro.php">Cadastra Suas Informações</a></p>
            <p><a href="cadastro_medico.php">Sou Médico</a></p>
            <p><a href="agendamento.php">Agendar Consulta</a></p>
            <p><a href="index.php">Sair</a></p>
        </div>
    </div>

    <script src="assets/js/login.js"></script>


</body>

</html>
