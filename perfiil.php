<?php

if (isset($_GET['id_cliente'])) {
    $id_cliente = $_GET['id_cliente'];

    
    $preparo = $selec->prepare("SELECT * FROM clientes WHERE id_cliente = ?");
    $preparo->execute([$id_cliente]);
    $cliente = $preparo->fetch(PDO::FETCH_ASSOC);


    $preparo = $selec->prepare("SELECT * FROM pets WHERE id_cliente = ?");
    $preparo->execute([$id_cliente]);
    $pet = $preparo->fetch(PDO::FETCH_ASSOC);

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
</head>

<body>
    <div class="imagens">
        <img src="assets/img/cachorros/4.png" alt="Imagem 2" class="imagem-direita">
        <img src="assets/img/cachorros/6.png" id="imagem-esquerda" alt="Imagem 6" class="imagem-esquerda">
    </div>
    <div class="container">
        <h2 style="text-align: center;">Bem-vindo ao Seu Perfil</h2>
        <h2>Dados pessoais</h2>

        <div id="cadastroInfo" class="content" style="text-align: left;">
            <h3>Informações:</h3>
            <p>CPF: <?= $cliente['cpf'] ?></p>
            <p>Nome: <?= $cliente['nome'] ?></p>
            <p>Email: <?= $cliente['email'] ?></p>
            <p>Telefone: <?= $cliente['telefone'] ?></p>
            <p>Endereço: <?= $cliente['endereco'] ?>, <?= $cliente['numero_residencia'] ?> - <?= $cliente['cidade'] ?></p>
        </div>

        <h2>Dados do Pet</h2>
        <div id="petInfo" class="content" style="text-align: left;">
            <h3>Informações do Pet:</h3>
            <p>Nome do Pet: <?= $pet['nome'] ?></p>
            <p>Espécie: <?= $pet['especie'] ?></p>
            <p>Idade: <?= $pet['idade'] ?></p>
            <p>Raça: <?= $pet['raca'] ?></p>
            <p>Peso: <?= $pet['peso'] ?></p>
            <p>Sexo: <?= $pet['sexo'] ?></p>
            <p>Porte: <?= $pet['porte'] ?></p>
        </div>

        <button class="btn_baixo" onclick="toggleDropdown()">Opções ▼</button>
        
        <div id="oculto" class="bnt_oculto">
            <p><a href="cadastro.php">Editar</a></p>
            <p><a href="agendamento.php">Agendar Consulta</a></p>
            <p><a href="index.php">Sair</a></p>
        </div>
    </div>

    <script src="assets/js/login.js"></script>
</body>

</html>
<?php
} else {
    
    header('Location: login.php');
    exit();
}
?>

