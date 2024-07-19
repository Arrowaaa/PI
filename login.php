<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/login.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
</head>

<body>

    <div class="imagens">
        <img src="assets/img/cachorros/cachorro.png" id="imagem-direita" alt="Imagem 2" class="imagem-direita">
        <img src="assets/img/cachorros/6.png" id="imagem-esquerda" alt="Imagem 6" class="imagem-esquerda">
    </div>

    <div class="container">

        <a href="index.php" id="botaoVoltar">
            <i class="bi bi-arrow-left-circle-fill" style="font-size: 2rem;"></i>
        </a>

        <h1>Login</h1><br>
        <?php
        include './classe/Usuarios.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = trim($_POST['email']);
            $password = trim($_POST['senha']);

            try {
                $conn = new PDO('mysql:host=62.72.62.1;dbname=u687609827_edilson', 'u687609827_edilson', '>2Ana=]b');
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $select = "SELECT * FROM usuarios WHERE email = :email";
                $stmt = $conn->prepare($select);
                $stmt->bindParam(':email', $email);
                $stmt->execute();

                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($resultado) {
                    if ($resultado['senha'] !== null && password_verify($password, $resultado['senha'])) {
                        $id_usuario = $resultado['id_usuario'];
                        $select_cliente = "SELECT id_cliente FROM clientes WHERE id_usuario = :id_usuario";
                        $stmt_cliente = $conn->prepare($select_cliente);
                        $stmt_cliente->bindParam(':id_usuario', $id_usuario);
                        $stmt_cliente->execute();
                        $cliente_result = $stmt_cliente->fetch(PDO::FETCH_ASSOC);
                        $id_cliente = $cliente_result['id_cliente'];
                        echo '<p class="alert alert-success">Login bem-sucedido.</p>';
                        echo '<script>';
                        echo 'setTimeout(function() { window.location.href = "perfil.php?id_cliente=' . $id_cliente . '"; }, 1600);';
                        echo '</script>';
                    } else {
                            echo '<p class="alert alert-danger">Cliente não encontrado. Tente novamente.</p>';
                        }
                    } else {
                        echo '<p class="alert alert-danger">Credenciais inválidas. Tente novamente.</p>';
                    }
            } catch (PDOException $e) {
                echo 'Erro: ' . $e->getMessage();
            }
        }
        ?>

        <div class="login-box">

            <form method="POST" action="#" id="loginForm">
                <div class="input-group">
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" placeholder="exemplo@exemplo.com" required>
                </div>
                <div class="input-group">
                    <label for="senha">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                    <button type="button" id="mostrarSenha"></button>
                </div>
                <i class="forgot-password" onclick="location.href='esqueceu-senha.php'">Esqueceu a senha?</i>
                <br>
                <i id="Criaruser" onclick="location.href='cadastro.php'">Criar usuario</i>
                <br><br>
                <div class="button-group">
                    <center>
                        <button type="submit" class="button-link">Entrar <span></span></button>
                    </center>
                    <br>
                </div>
            </form>
        </div>
    </div>
    <script src="./assets/js/login.js"></script>
</body>

</html>