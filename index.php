<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ven't qui</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/principal.css">
    
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
    background-image: linear-gradient(rgba(44, 40, 40, 0.5), rgba(48, 42, 42, 0.5)), url(assets/img/banner.png);
    background-size: cover;
    background-position: 0% center;
    width: 100%;
    height: 85vh;
    padding: 0 0 1px 0;
    animation: moveBackground 50s linear infinite;
   

}

/*Animação no h1*/
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
<body  style="height: 100%;">
    <main>
        <section class="home">
            <header>
                <nav class="menu-perfil">
                    <img src="assets/img/logo principal.png" alt="logo da empresa" class="logo">
                    <p>“Unindo amor e expertise para cuidar dos seus melhores amigos na saúde e na alegria."</p>
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
                        <!-- <div class="loguin"> -->
                        <li class="icon"><a href="login.php"><i class="bi bi-person"> Login</i></a></li>
                    <!-- </div> -->
                    </ul>
                </nav>
            </header>

            <main>
                <h1>Ven't  Qui</h1>
            </main>

        </section>
    </main>
    </html>
   
    <?php include './includes/footer.php' ?>
    
