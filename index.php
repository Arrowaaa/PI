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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/principal.css">
    <link rel="shortcut icon" href="./assets/img/favicon-32x32.png" type="image/x-icon">
</head>

<style>
    @keyframes moveBackground {
        0% {
            background-position: 0% center;
        }

        100% {
            background-position: 100% center;
        }
    }

    .home {
        position: relative;
        width: 100%;
        height: 100vh;
        padding: 0;
        overflow: hidden;
    }

    #background-video {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transform: translate(-50%, -50%);
        z-index: -2;
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(rgba(44, 40, 40, 0.5), rgba(48, 42, 42, 0.5));
        z-index: -1;
    }

    .content {
        position: relative;
        z-index: 1;
    }

    @keyframes rotate3D {
        0% {
            transform: rotateX(0deg) rotateY(0deg);
        }

        75% {
            transform: rotateX(180deg) rotateY(0deg);
        }

        100% {
            transform: rotateX(0deg) rotateY(0deg);
        }
    }

    body main .home main h1 {
        margin: auto 0;
        font-family: "Croissant One", "serif";
        font-size: 150px;
        color: #FF9239;
        display: flex;
        justify-content: center;
        align-items: center;
        animation: rotate3D 10s infinite;
        transform-style: preserve-3d;
        background: linear-gradient(45deg, #ff9239, #ff3d00);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 1px 1px 0 #000, 2px 2px 0 #ff9239, 3px 3px 0 #ff9239, 4px 4px 0 #ff9239, 5px 5px 0 #ff9239;
    }
</style>

<body>
    <main style="height: 90vh; width: 100%;">
        <section class="home">
            <video id="background-video" autoplay muted loop>
                <source src="./assets/video/caramelo.mp4" type="video/mp4">
            </video>
            <div class="overlay"></div>
            <div class="content">
                <header>
                    <nav class="menu-perfil">
                        <img src="./assets/img/principal.png" alt="logo da empresa" id="logo">
                        <h5 id="titulo">“Unindo amor e expertise para cuidar dos seus melhores amigos na saúde e na alegria."</h5>
                        <ul class="menu">
                            <li> <a class="linha" href="index.php">Início</a></li>
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
                <main>
                    <h1>Ven't Qui</h1>
                </main>
            </div>
        </section>
    </main>
    <?php include './includes/footer.php' ?>
</body>
</html>