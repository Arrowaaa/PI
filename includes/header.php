<?php
session_start();

include './auxi/config.php'; 
require_once './classe/Usuarios.php';

if (isset($_SESSION['id_cliente'])) {
    $id_cliente = $_SESSION['id_cliente'];

    try {
        global $UsuarioSenha;

        // Busca as informações do cliente
        $preparo = $UsuarioSenha->prepare("SELECT * FROM clientes WHERE id_cliente = ?");
        $preparo->execute([$id_cliente]);
        $cliente = $preparo->fetch(PDO::FETCH_ASSOC);

        // Verifica se o cliente foi encontrado
        if (!$cliente) {
            header('Location: login.php');
            exit();
        }

        // Define a foto de perfil com base no nível do cliente
        if (isset($cliente['nivel'])) {
            $_SESSION['Nivel'] = $cliente['nivel'];
            if ($_SESSION['Nivel'] == 'adm') {
                $_SESSION['fotoPerfilLogado'] = './assets/img/img_clientes/mick.jpg';
            } else {
                $_SESSION['fotoPerfilLogado'] = './assets/img/img_clientes/cachorro.png';
            }
        }
    } catch (PDOException $e) {
        echo 'Erro: ' . $e->getMessage();
    }
} else {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ven't qui</title>
    <link rel="shortcut icon" href="./assets/img/favicon-32x32.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/principal.css">
    <link rel="stylesheet" href="assets/css/servico.css">
</head>

<body>
    <main>
        <section class="home">
            <header>
                <nav class="menu-perfil">
                    <img src="./assets/img/principal.png" alt="logo da empresa" id="logo">
                    <h5 id="titulo">“Unindo amor e expertise para cuidar dos seus melhores amigos na saúde e na alegria."</h5>
                    <ul class="menu">
                        <li><a href="index.php">Início</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropbtn">Requisições &#9660;</a>
                            <div class="dropdown-content">
                                <a href="raiox.php">Raio-X</a>
                                <a href="internacao.php">Internação</a>
                            </div>
                        </li>
                        <li> <a href="servicos.php">Serviços</a></li>
                        <li> <a href="sobre.php">Sobre</a></li>
                        <?php
                        if (isset($_SESSION["usuario"]) && $_SESSION["usuario"] !== "") {
                        ?>
                            <li>
                                <img class="rounded-circle" height="20" src="<?php echo $_SESSION['fotoPerfilLogado']; ?>" alt="Foto de Perfil">
                                <?php echo $_SESSION["usuario"]; ?>
                            </li>
                        <?php
                        } else { ?>
                            <li class="icon"><a href="login.php"><i class="bi bi-person"> Login</i></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </nav>
            </header>
        </section>
    </main>
    <hr>