<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<style>
    body {
        background-color: #9c6131;
    }
    #criar_user {
        display: flex;
        background-color: #9c6131;
    }
    .form-signin {
        max-width: 430px;
        padding: 2rem;
        background-color: #9c6131;
        border-radius: 10px;
        color: black;
    }
    h1 {
        display: flex;
        justify-content: center;
    }
</style>

<body class="d-flex align-items-center py-4 corpinho" id="criar_user">

    <div class="imagens">
        <img src="assets/img/cachorros/cachorro.png" id="imagem-direita" alt="Imagem 2" class="imagem-direita">
        <img src="assets/img/cachorros/6.png" id="imagem-esquerda" alt="Imagem 6" class="imagem-esquerda">
    </div>
    <div class="container">
        <a href="login.php" id="botaoVoltar">
            <i class="bi bi-arrow-left-circle-fill" style="font-size: 2rem;"></i>
        </a>
        <main class="form-signin w-100 m-auto">
            <form action="auxcadastro.php" method="POST">
                <h1 class="h3 mb-3 fw-normal"> Crie Seu Usuário</h1>

                <div class="form-floating my-2">
                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" required>
                    <label for="usuario">Usuario</label>
                </div>

                <div class="form-floating my-2">
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
                    <label for="senha">Senha</label>
                </div>

                <div class="form-floating my-2">
                    <input type="password" class="form-control" id="confirma" name="confirma" placeholder="Confirmar Senha" required>
                    <label for="confirma">Confirmar Senha</label>
                </div>

                <input class="btn btn-primary w-100 py-2 mt-5" type="submit" value='Criar'>
            </form>
        </main>
    </div>
</body>

</html>
