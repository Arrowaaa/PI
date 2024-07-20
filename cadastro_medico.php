<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Médicos</title>
    <link rel="shortcut icon" href="./assets/img/favicon-32x32.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/medico.css">
</head>

<body>
    <div class="imagens">
        <img src="assets/img/cachorros/meddog3.png" alt="cachorro medico" id="esquerda">
        <img src="assets/img/cachorros/meddog2.png" alt="cachorro medico 2" id="direita">
        <img src="assets/img/cachorros/meddog (3).png" alt="cachorro medico" id="esquerda">
        <img src="assets/img/cachorros/meddog (2).png" alt="cachorro medico 2" id="direita">
    </div>
    <div class="container">
        <a href="perfil.php" id="botaoVoltar">
            <i class="bi bi-arrow-left-circle-fill"></i>
        </a><br>
        <h1>Cadastro de Médicos</h1>
        <form action="/auxi/auxcadastromedico.php" method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required><br>

            <label for="crm">CRM:</label>
            <input type="text" id="crm" name="crm" required><br>

            <label for="especializacao">Especialização:</label>
            <select id="especializacao" name="especializacao" required>
                <?php
                require_once './auxi/config.php';

                $conn = new mysqli($serve, $banco, $nome, $senha);
                $servidor = "62.72.62.1";
                $nome = "u687609827_edilson";
                $senha = ">2Ana=]b";
                $banco = "u687609827_edilson";

                $conn = new mysqli($servidor, $nome, $senha, $banco);


                if ($conn->connect_error) {
                    die("Falha na conexão: " . $conn->connect_error);
                }

                $selec = "SELECT id, nome FROM especializacao";
                $result = $conn->query($selec);

                if ($result->num_rows > 0) {

                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['id'] . " - " . $row['nome'] . "</option>";
                    }
                } else {
                    echo "<option value=''>Nenhuma especialização encontrada</option>";
                }


                $conn->close();
                ?>
            </select><br>

            <label for="dia_semana">Dia da Semana:</label>
            <select id="dia_semana" name="dia_semana" required>
                <option></option>
                <option value="Segunda">Segunda</option>
                <option value="Terça">Terça</option>
                <option value="Quarta">Quarta</option>
                <option value="Quinta">Quinta</option>
                <option value="Sexta">Sexta</option>
                <option value="Sábado">Sábado</option>
                <option value="Domingo">Domingo</option>
            </select><br>

            <label for="hora_inicio">Hora de Início:</label>
            <input type="time" id="hora_inicio" name="hora_inicio" required><br>

            <label for="hora_fim">Hora de Fim:</label>
            <input type="time" id="hora_fim" name="hora_fim" required><br>

            <label for="disponivel">Disponível:</label>
            <div class="check">
                <input type="checkbox" id="disponivel" name="disponivel" value="1" checked>
            </div>
            <br>
            <div class="button-group">
                <center>
                    <button type="submit" class="button-link">Cadastrar<span></span></button>
                </center>
            </div>
        </form>
    </div>

</body>

</html>