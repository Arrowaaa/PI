<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<body>
    <div>
        <a href="index.php" id="botaoVoltar" class="botaoVoltar">Voltar</a>
    </div>
    <div class="imagens">
        <img src="assets/img/cachorros/cachorro.png" id="imagem-direita" alt="Imagem 2" class="imagem-direita">
        <img src="assets/img/cachorros/6.png" id="imagem-esquerda" alt="Imagem 6" class="imagem-esquerda">
    </div>
    <div class="container">
        <h2>Login</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario = $_POST['usuario'];
            $senha = $_POST['senha'];

            try {
                $conn = 'mysql:host=62.72.62.1;dbname=u687609827_edilson';
                $UsuarioSenha = new PDO($conn, 'u687609827_edilson', '>2Ana=]b');
                $UsuarioSenha->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $select = "SELECT * FROM usuarios WHERE usuario = :usuario";
                $paramentro = $UsuarioSenha->prepare($select);
                $paramentro->bindParam(':usuario', $usuario, PDO::PARAM_STR);
                $paramentro->execute();

                if ($paramentro->rowCount() > 0) {
                    $linha = $paramentro->fetch(PDO::FETCH_ASSOC);

                    if (password_verify($senha, $linha['senha'])) {
                        echo "<p>Login bem-sucedido!</p>";
                        header("Location: perfil.php");
                        exit();
                    } else {
                        echo "<p>Credenciais inválidas. Tente novamente.</p>";
                    }
                } else {
                    echo "<p>Credenciais inválidas. Tente novamente.</p>";
                }
            } catch (PDOException $e) {
                echo 'Erro: ' . $e->getMessage();
            }
        }
        ?>
        <div class="login-box">
            <form id="loginForm" method="POST" action="">
                <div class="input-group">
                    <label for="usuario">Usuário:</label>
                    <input type="text" id="usuario" name="usuario" required>
                </div>
                <div class="input-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                    <button type="button" id="mostrarSenha"></button>
                </div>
                <div class="input-group">
                    <div>
                        <input type="checkbox" id="lembrar" name="lembrar">
                        <label for="lembrar">Lembre-me</label>
                    </div>
                    <span class="forgot-password" onclick="location.href='esqueceu-senha.php'">Esqueceu a senha?</span>
                </div>
                <div class="button-group">
                    <center>
                    <button type="submit" class="button-link">Entrar <span></span></button>
                    </center>
                </div>
                <div class="button-group">
                    <a href="cadastro.php" class="button">Cadastrar <span></span></a>
                </div>
            </form>
        </div>
    </div>

    <script src="assets/js/login.js"></script>
</body>

</html>
