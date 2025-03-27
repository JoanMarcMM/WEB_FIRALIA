<?php

session_start();

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>

    <!-- Google Fonts -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=arrow_forward" />

    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Archivos CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body style="background-color: #F2F0EF !important;">

    <nav class="main-nav">
        <!-- ------------------------------------------------------------------ SIDE BAR --------------------------------------------------------------------------------->
        <ul class="sidebar">
            <li onclick="hideSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#">
                        <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                    </svg></a></li>
            <li><a href="concerts.php">Conciertos</a></li>
            <li><a href="event.php">Eventos</a></li>
            <li><a href="support.php">Soporte</a></li>
            <?php if (isset($_SESSION["user_id"])): ?>
                <li><a href="login.php">Perfil</a></li>
            <?php else: ?>
                <li><a href="login.php">Iniciar Sesión</a></li>
                <li><a href="register.php">Registrarse</a></li>
            <?php endif; ?>
        </ul>
        <!-- ------------------------------------------------------------------ MAIN MENU --------------------------------------------------------------------------------->
        <ul class="main-menu">
            <li>
                <a href="index.php">
                    <img class="logo-nav" src="images/logo2-modified.png" alt="logo" id="logo-nav">
                    <script>
                        const img = document.getElementById('logo-nav');

                        img.addEventListener('mouseenter', () => {
                            img.src = 'images/logo2.png';
                        });

                        img.addEventListener('mouseleave', () => {
                            img.src = 'images/logo2-modified.png';
                        });
                    </script>


                </a>

            </li>
            <li class="hideOnMobile"><a href="concerts.php">CONCIERTOS</a></li>
            <li class="hideOnMobile"><a href="event.php">EVENTOS</a></li>
            <li class="hideOnMobile"><a href="support.php">SOPORTE</a></li>
            <li>
                <form class="nav-form">
                    <input type="text" class="search-bx" placeholder="">
                    <input type="image" class="search-icon" src="images/search.svg" alt="Submit">
                </form>
            </li>
            <?php if (isset($_SESSION["user_id"])): ?>

                <li><a href="profile.php"><img src="images/icons/estandarPfp.jpg" alt="Pfp" class="pfpNav"></a></li>

            <?php else: ?>

                <li class="hideOnMobile"><button id="open-popup">INICIAR SESION</button></li>

            <?php endif; ?>

            <li class="menu-button" onclick="showSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg"
                        height="24px" viewBox="0 -960 960 960" width="26px" fill="#e8eaed">
                        <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
                    </svg></a></li>
        </ul>
    </nav>
    <!-- -------------------------------------------------------------------------- LOG IN  --------------------------------------------------------------------------------->
    <div class="popup" id="popup">
        <div class="overlay"></div>
        <div class="popup-content">
            <h2>Login</h2>
            <form method="POST" action="../controller/UserController.php">
                <div class="login-box">
                    <?php

                    if (isset($_SESSION["error_message"])) {
                        echo "<p class='error-message'>" . $_SESSION["error_message"] . "</p>";
                        unset($_SESSION["error_message"]); // Eliminar mensaje tras mostrarlo
                    }
                    ?>
                    <input type="text" name="user" id="user" placeholder="Username" required>
                    <input type="hidden" name="login" value="login">
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <input type="hidden" name="redirect" value="<?php echo basename($_SERVER['PHP_SELF']); ?>">
                    <a href="register.php" class="atext">Problemas con la contraseña?</a>
                    <a href="register.php" class="atext">No tienes cuenta? Registrate!</a>

                </div>
                <div class="controls">
                    <button class="close-btn">Cancelar</button>
                    <button class="submit-btn" type="submit">Iniciar Sesión</button>
                </div>
            </form>
        </div>
    </div>


    <!-- ------------------------------------------------------------------ MAIN carrousel  --------------------------------------------------------------------------------->
    <!-- https://www.youtube.com/watch?v=1XXY_5k8Nok -->
    <section class="main-section">
        <div class="carousel slide" id="carouselDemo" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active"
                    data-bs-interval="4000">
                    <img src="images/blackpink.jpg" class="w-100">
                    <div class="carousel-caption">
                        <h1>BLACKPINK</h1>
                        <p> Icono global del K-pop con potentes coreografías y una presencia audaz.</p>
                    </div>
                </div>

                <div class="carousel-item"
                    data-bs-interval="4000">
                    <img src="images/sabrinacarpenter.jpg" class="w-100">
                    <div class="carousel-caption">
                        <h1>SABRINA CARPENTER</h1>
                        <p>Cantante pop con letras profundas y estilo juvenil.</p>
                    </div>
                </div>

                <div class="carousel-item"
                    data-bs-interval="4000">
                    <img src="images/postmalone.jpg" class="w-100">
                    <div class="carousel-caption">
                        <h1>POST MALONE</h1>
                        <p>Artista que fusiona rap, rock y pop con una voz única y melancólica.</p>
                    </div>
                </div>
            </div>

            <!-- Controles del carrusel -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselDemo" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselDemo" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>

            <div class="carousel-indicators">
                <button type="button" class="active" data-bs-target="#carouselDemo" data-bs-slide-to="0"></button>
                <button type="button" class="active" data-bs-target="#carouselDemo" data-bs-slide-to="1"></button>
                <button type="button" class="active" data-bs-target="#carouselDemo" data-bs-slide-to="2"></button>
            </div>
        </div>
    </section>






    <!-- ------------------------------------------------------------------ RECOMENDATIONS Y QUEDA POCO --------------------------------------------------------------------------------->
    <section class="info-1">
        <div class="best-sellers">
            <div class="title">
                <h1>BEST SELLERS</h1>
            </div>
            <div class="info-1-grid">
                <div class="cont1">
                    <img href="event.php" class="cont-img" src="images/blackpink.jpg" alt="imagen">
                    <div class="contt">

                    </div>
                </div>
                <div class="cont2"><img class="cont-img" src="images/salomanga.jpg" alt="imagen"></div>
                <div class="cont3"><img class="cont-img" src="images/championsburguer.jpg" alt="imagen"></div>
                <div class="cont4"><img class="cont-img" src="images/postmalone.jpg" alt="imagen"></div>
                <div class="cont5"><img class="cont-img" src="images/sabrinacarpenter.jpg" alt="imagen"></div>
                <div class="cont6"><img class="cont-img" src="images/mobileworldcongrss.jpg" alt="imagen"></div>
            </div>
        </div>
        <div class="queda-poco">

            <div class="queda-poco-display">
                <div class="title-queda-poco">
                    <h1>QUEDA POCO</h1>
                </div>
                <div class="queda-poco-img"><img class="cont-img" src="images/mobileworldcongrss.jpg" alt="imagen"></div>
                <div class="queda-poco-img"><img class="cont-img" src="images/blackpink.jpg" alt="imagen"></div>
                <div class="queda-poco-img"><img class="cont-img" src="images/championsburguer.jpg" alt="imagen"></div>
                <div class="queda-poco-img"><img class="cont-img" src="images/bbf.jpg" alt="imagen"></div>
            </div>
        </div>

    </section>

    <!-- https://www.youtube.com/watch?v=VUtJ7FWCfZA&list=PLpwngcHZlPae68z_mLFNfbJFIJVJ_Zcx2 -->

    <section class="info-2">
        <div class="title-recomendations">
            <h1>RECOMENDACIONES</h1>
        </div>
        <div class="popular-container swiper">
            <div class="card-wrapper">
                <ul class="card-list swiper-wrapper">
                    <li class="card-item swiper-slide">
                        <a href="#" class="card-link">
                            <img src="images/salomanga.jpg" alt="" class="card-image">
                            <p class="badge culture">Cultura</p>
                            <h2 class="card-title">Salo del manga</h2>
                            <p class="card-text"></p>
                            <button class="card-button
                        material-symbols-outlined">arrow_forward</button>
                        </a>
                    </li>

                    <li class="card-item swiper-slide">
                        <a href="#" class="card-link">
                            <img src="images/championsburguer.jpg" alt="" class="card-image">
                            <p class="badge food">Comida</p>
                            <h2 class="card-title">Champ. Burguer</h2>
                            <p class="card-text"></p>
                            <button class="card-button
                        material-symbols-outlined">arrow_forward</button>
                        </a>
                    </li>

                    <li class="card-item swiper-slide">
                        <a href="#" class="card-link">
                            <img src="images/mobileworldcongrss.jpg" alt="" class="card-image">
                            <p class="badge technology">Tecnologia</p>
                            <h2 class="card-title">MWC</h2>
                            <p class="card-text"></p>
                            <button class="card-button
                        material-symbols-outlined">arrow_forward</button>
                        </a>
                    </li>

                    <li class="card-item swiper-slide">
                        <a href="#" class="card-link">
                            <img src="images/tibidabo.jpg" alt="" class="card-image">
                            <p class="badge entertainment">Entretenimiento</p>
                            <h2 class="card-title">Tibidabo</h2>
                            <p class="card-text"></p>
                            <button class="card-button
                        material-symbols-outlined">arrow_forward</button>
                        </a>
                    </li>

                    <li class="card-item swiper-slide">
                        <a href="#" class="card-link">
                            <img src="images/japanweekend.jpg" alt="" class="card-image">
                            <p class="badge culture">Cultura</p>
                            <h2 class="card-title">Japan Weekend</h2>
                            <p class="card-text"></p>
                            <button class="card-button
                        material-symbols-outlined">arrow_forward</button>
                        </a>
                    </li>

                    <li class="card-item swiper-slide">
                        <a href="#" class="card-link">
                            <img src="images/bgw.jpg" alt="" class="card-image">
                            <p class="badge videogames">Videojuegos</p>
                            <h2 class="card-title">BGW</h2>
                            <p class="card-text"></p>
                            <button class="card-button
                        material-symbols-outlined">arrow_forward</button>
                        </a>
                    </li>

                    <li class="card-item swiper-slide">
                        <a href="#" class="card-link">
                            <img src="images/bbf.jpg" alt="" class="card-image">
                            <p class="badge entertainment">Musica</p>
                            <h2 class="card-title">BBF</h2>
                            <p class="card-text"></p>
                            <button class="card-button
                        material-symbols-outlined">arrow_forward</button>
                        </a>
                    </li>

                    <li class="card-item swiper-slide">
                        <a href="#" class="card-link">
                            <img src="images/firaapat.jpg" alt="" class="card-image">
                            <p class="badge food">Comida</p>
                            <h2 class="card-title">Àpat</h2>
                            <p class="card-text"></p>
                            <button class="card-button
                        material-symbols-outlined">arrow_forward</button>
                        </a>
                    </li>

                </ul>



                <div class="swiper-slide-button swiper-button-prev" style="color:black;"></div>
                <div class="swiper-slide-button swiper-button-next" style="color:black;"></div>

                <div class="swiper-pagination" style="color:black;"></div>

            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-container-1-1">
                <p>FIRALIA</p>
            </div>
            <div class="footer-container-1-2">
                <p>Connecta con nosotros!</p>
                <nav>
                    <ul class="ul-apps">
                        <li><a href="#"><img src="images/icons/facebook.png" alt="Facebook"></a></li>
                        <li><a href="#"><img src="images/icons/instagram.png" alt="Instagram"></a></li>
                        <li><a href="#"><img src="images/icons/twitter.png" alt="X"></a></li>
                        <li><a href="#"><img src="images/icons/youtube.png" alt="YouTube"></a></li>
                        <li><a href="#"><img src="images/icons/tiktok.png" alt="TikTok"></a></li>
                    </ul>
                </nav>
            </div>
            <div class="footer-container-1-3">
                <p>Descarga Nuestra App</p>
                <nav>
                    <ul class="ul-download">
                        <li><a href="#"><img src="images/icons/appstore.png" alt="Apple Store"></a></li>
                        <li><a href="#"><img src="images/icons/googleplay.webp" alt="Google Play"></a></li>
                    </ul>
                </nav>
            </div>

            <div class="footer-container-2">
                <ul>
                    <li><a href="#">Política de Privacidad</a></li>
                    <li><a href="#">Política de Compra</a></li>
                    <li><a href="#">Términos de Uso</a></li>
                    <li><a href="#">Política de Cookies</a></li>
                    <li><a href="#">Control de Cookies</a></li>
                    <li>
                        <p>© 2024-2025 FIRALIA. Todos los derechos reservados.</p>
                    </li>
                </ul>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="js/swiper.js"></script>

    <script>
        function showSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.style.display = 'flex';
        }

        function hideSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.style.display = 'none';
        }

        function createPopup(id) {
            let popupNode = document.querySelector(id);
            let overlay = popupNode.querySelector(".overlay");
            let closeBtn = popupNode.querySelector(".close-btn");

            function openPopup() {
                popupNode.classList.add("active");
            }

            if (document.querySelector(".error-message")) {
                openPopup();
            }

            function closePopup() {
                popupNode.classList.remove("active");
            }

            overlay.addEventListener("click", closePopup);
            closeBtn.addEventListener("click", closePopup);

            return openPopup;
        }

        let popup = createPopup("#popup");
        document.querySelector("#open-popup").addEventListener("click", popup);
    </script>

</body>

</html>