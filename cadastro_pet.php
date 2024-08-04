<?php
session_start();
require_once './classe/Usuarios.php';
require_once './classe/pessoas.php';
$usuario = new Usuarios();

$id_cliente = isset($_SESSION['id_cliente']) ? $_SESSION['id_cliente'] : null;
$dadosUsuario = [];
if ($id_cliente) {
    $dadosUsuario = $usuario->Usuarios($id_cliente);
} else {
    die("Erro: Dados do usuário não disponíveis ou sessão não iniciada.");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pet</title>
    <link rel="shortcut icon" href="./assets/img/favicon-32x32.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/cadastro.css">
</head>

<body>
    <div class="imagens">
        <img src="assets/img/cachorros/3.png" id="esquerda" alt="Imagem 1" class="imagem-esquerda">
        <img src="assets/img/cachorros/2.png" id="direita" alt="Imagem 2" class="imagem-direita">
    </div>
    <div class="container">
        <div class="login-box">
            <a href="perfil.php" id="botaoVoltar">
                <i class="bi bi-x-circle-fill" style="font-size: 2rem;"></i>
            </a>
            <h2>Cadastro de Pet</h2><br>
            <form id="cadastroForm" action="./auxi/auxcadastropet.php" method="POST">
                <input type="hidden" name="id_cliente" value="<?= htmlspecialchars($id_cliente) ?>">

                <div class="input-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" value="<?= isset($dadosUsuario['email']) ? htmlspecialchars($dadosUsuario['email']) : '' ?>" <?= isset($id_cliente) ? 'readonly' : '' ?>>
                </div>

                <div class="input-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" maxlength="14" value="<?= isset($dadosUsuario['cpf']) ? htmlspecialchars($dadosUsuario['cpf']) : '' ?>">
                    <script src="assets/js/mascaras.js"></script>
                </div>

                <div class="input-group">
                    <label for="nomep">Nome do Pet:</label>
                    <input type="text" id="nomep" name="nomep" minlength="3" maxlength="20">
                </div>
                <div class="input-group">
                    <label for="especie">Espécie do Pet:</label>
                    <select id="especie" name="especie">
                        <option value="">Selecione uma espécie</option>
                        <?php
                        require_once './auxi/config.php';
                        $sql = "SELECT id_especie, nome FROM especies";
                        $stmt = $UsuarioSenha->prepare($sql);
                        $stmt->execute();
                        $especies = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($especies as $especie) {
                            echo "<option value='{$especie['id_especie']}'>{$especie['nome']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="input-group">
                    <label for="sexop">Sexo do Pet:</label>
                    <select id="sexop" name="sexop">
                        <option value="">Selecione o sexo</option>
                        <option value="M">Macho</option>
                        <option value="F">Fêmea</option>
                        <option value="O">Outros</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="data_nascimento">Data de Nascimento:</label>
                    <input type="date" id="data_nascimento" name="data_nascimento" min="1900-01-01" max="9999-12-31">
                </div>
                <div class="input-group">
                    <label for="raca">Raça do Pet:</label>
                    <input type="text" id="raca" name="raca" minlength="3" maxlength="20">
                </div>
                <div class="input-group">
                    <label for="peso">Peso do Pet:</label>
                    <input type="number" id="peso" name="peso" min="0" max="2" step="0.01">
                </div>
                <div class="input-group">
                    <label for="porte">Porte do Pet:</label>
                    <select id="porte" name="porte">
                        <option value=""></option>
                        <option value="pequeno">Pequeno</option>
                        <option value="medio">Médio</option>
                        <option value="grande">Grande</option>
                    </select>
                </div>
                <center>
                    <button type="submit" class="button-link">Cadastrar<span></span></button>
                </center>
            </form>
        </div>
    </div>
    <script src="./assets/js/mascaras.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const racaInput = document.getElementById('raca');
            if (racaInput) {
                racaInput.addEventListener('input', function(e) {
                    let raca = e.target.value;
                    raca = raca.replace(/[^a-zA-Z\s]/g, '');
                    e.target.value = raca;
                });
            }
        });
    </script>
</body>

</html>