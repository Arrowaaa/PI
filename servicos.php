<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serviços</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/servico.css">
    <link rel="stylesheet" href="assets/css/footer.css">
</head>

<body>
    <main>
        <section class="home">
            <header>
                <nav class="menu-perfil">
                    <img src="assets/img/logo principal.png" alt="logo da empresa" class="logo">
                    <p>“Unindo amor e expertise para cuidar dos seus melhores amigos na saúde e na alegria."</p>
                    <ul class="menu">
                        <li> <a href="index.php">Início</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropbtn">Requisições &#9660;</a>
                            <div class="dropdown-content">
                                <a href="raiox.php">Raio-X</a>
                                <a href="internacao.php">Internação</a>
                            </div>
                        </li>
                        <li> <a class="linha" href="servicos.php">Serviços</a></li>
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

        <div class="container body">
            <h1>Nossos Serviços</h1><br>

            <p>Na Ven't Qui, estamos aqui para cuidar e apoiar você e seu animal de estimação em todas as fases da
                vida. Entre em contato conosco hoje mesmo para marcar uma consulta e fazer parte da família Ven't Qui.
            </p>
            <br>
            <li> Consultas Veterinárias</li>
            <br>
            <li> Vacinação e Prevenção</li>
            <br>
            <li> Cirurgia:</li>
            <br>
            <li> Exames Laboratoriais:</li>
            <br>
            <li> Atendimento de Emergência:</li>
            <br>
            <li>Entre Outros</li> <br>

            <section id="produtos me-5">
                <main class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-2 col-sm-12">
                            <!-- criando o Card -->
                            <figure>
                                <img src="assets/img/exames.png" alt="Imagem de exames no pet" class="foto-produto">
                            </figure>
                        </div>

                        <div class="col-lg-6 col-md-2 col-sm-12">
                            <figure>
                                <img src="assets/img/cirurgia.png" alt="Imagem de uma sala de cirurgia" class="foto-produto">

                            </figure>
                        </div>


                        <div class="col-lg-6 col-md-2 col-sm-12">

                            <figure>
                                <img src="assets/img/castracao.png" alt="Imagem de uma castração" class="foto-produto">

                            </figure>
                        </div>

                        <div class="col-lg-6 col-md-2 col-sm-12">

                            <figure>
                                <img src="assets/img/vacina.png" alt="Vacinação" class="foto-produto">

                            </figure>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-lg-6 col-md-2 col-sm-12">

                            <figure>
                                <img src="assets/img/aplicacao.png" alt="Aplicação de medicamento" class="foto-produto">

                            </figure>
                        </div>

                        <div class="col-lg-6 col-md-2 col-sm-12">

                            <figure>
                                <img src="assets/img/emergencia.png" alt="Emergência 24h" class="foto-produto">

                            </figure>
                        </div>

                        <div class="col-lg-6 col-md-2 col-sm-12">

                            <figure>
                                <img src="assets/img/raioX.png" alt="Exames de imagem- Raio-X" class="foto-produto">

                            </figure>
                        </div>


                        <div class="col-lg-6 col-md-2 col-sm-12">

                            <figure>
                                <img src="assets/img/animaisS.png" alt="Exames em animais silvestres" class="foto-produto">

                            </figure>
                        </div>
                    </div>
                </main>
            </section>
        </div>
    </main>

    <footer class=" rodape">
            <div class="row ">
                <div class="col md-4 text-center">
                    <h5 class="font-weight-bold">MENU</h5>
                    <ul class="list-unstyled mt-3">
                        <li><a href="./index.php">Inicio</a></li>
                        <li><a href="./servicos.php">Serviços</a></li>
                        <li><a href="./sobre.php">Sobre</a></li>
                    </ul>
                </div>


                <div class="col-md-4 text-center">
                    <h5 class="font-weight-bold">Sobre a Gente</h5>
                    <ul class="list-unstyled mt-3">
                        <li><a href="#">Rua: Germano Giusti, 26 - Jd. Paulista - Americana - SP</a></li>
                        <li><a href="#">Contato</a></li>

                    </ul>
                </div>

                <div class="col-md-4 text-center" >
                    <h5 class="font-weight-bold">Nossas Redes Sociais</h5>
                    <div class="social-icons mt-3">
                        <a href="#"><i class="bi bi-youtube"></i></a>
                        <a href="#"><i class="bi bi-whatsapp"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-facebook"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy;2024. Este site foi desenvolvido como projeto integrador (PI) - SENAC Americana.<br>
                    Não reservamos os
                    direitos e valores apresentados são meramentes ilustrativos para fins educacionais.</p>
            </div>
    </footer>

</body>

</html>
