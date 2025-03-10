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
</head>

<body>
    <section class="search-section">
        <nav class="main-nav">

            <ul class="sidebar">
                <li onclick="hideSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24px"
                            viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                            <path
                                d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                        </svg></a></li>
                <li><a href="recomendations.html">Recomendaciones</a></li>
                <li><a href="soon.html">Queda Poco</a></li>
                <li><a href="support.html">Soporte</a></li>
                <li><a href="login.php">Iniciar Sesión</a></li>
                <li><a href="register.php">Registrarse</a></li>
            </ul>

            <ul class="main-menu">
                <li><a href="index.html"><img class="logo-nav" src="images/IMG_0037.PNG" alt="Logo"></a></li>
                <li class="hideOnMobile"><a href="recomendations.html">Recomendaciones</a></li>
                <li class="hideOnMobile"><a href="soon.html">Queda Poco</a></li>
                <li class="hideOnMobile"><a href="support.html">Soporte</a></li>

                <?php if (isset($_SESSION["user_id"])): ?>

                    <li><a href="login.php">foto</a></li>ot

                <?php else: ?>

                    <li class="hideOnMobile"><a href="login.php">Iniciar Sesión</a></li>
                    <li class="hideOnMobile"><a href="register.php">Registrarse</a></li>

                <?php endif; ?>

                <li class="menu-button" onclick="showSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg"
                            height="24px" viewBox="0 -960 960 960" width="26px" fill="#e8eaed">
                            <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
                        </svg></a></li>
            </ul>
        </nav>
        <div class="grid-container">
            <div class="title-container">
                <p class="title-text">Explora, descubre y disfruta </p>
            </div>
            <div class="explorer">
                <a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"
                        fill="#8B6A9C">
                        <path
                            d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z" />
                    </svg></a>
                <input type="text" class="search-box" placeholder="Buscar...">
            </div>
        </div>
    </section>


    <section class="info-1">


    </section>

    <!-- https://www.youtube.com/watch?v=VUtJ7FWCfZA&list=PLpwngcHZlPae68z_mLFNfbJFIJVJ_Zcx2 -->

    <section class="info-2">
        <h1>POPULAR TICKETS</h1>
        <div class="popular-container swiper">
            <div class="card-wrapper">
                <ul class="card-list swiper-wrapper">
                    <li class="card-item swiper-slide">
                        <a href="#" class="card-link">
                            <img src="images/salomanga.jpg" alt="" class="card-image">
                            <p class="badge culture">Cultura</p>
                            <h2 class="card-title">Salo del manga</h2>
                            <p class="card-text">Fira del manga i anime amb rellevància mundial i referent a Europa.</p>
                            <button class="card-button
                        material-symbols-outlined">arrow_forward</button>
                        </a>
                    </li>

                    <li class="card-item swiper-slide">
                        <a href="#" class="card-link">
                            <img src="images/salomanga.jpg" alt="" class="card-image">
                            <p class="badge food">Comida</p>
                            <h2 class="card-title">Salo del manga</h2>
                            <p class="card-text">Fira del manga i anime amb rellevància mundial i referent a Europa.</p>
                            <button class="card-button
                        material-symbols-outlined">arrow_forward</button>
                        </a>
                    </li>

                    <li class="card-item swiper-slide">
                        <a href="#" class="card-link">
                            <img src="images/salomanga.jpg" alt="" class="card-image">
                            <p class="badge technology">Tecnologia</p>
                            <h2 class="card-title">Salo del manga</h2>
                            <p class="card-text">Fira del manga i anime amb rellevància mundial i referent a Europa.</p>
                            <button class="card-button
                        material-symbols-outlined">arrow_forward</button>
                        </a>
                    </li>

                    <li class="card-item swiper-slide">
                        <a href="#" class="card-link">
                            <img src="images/salomanga.jpg" alt="" class="card-image">
                            <p class="badge entertainment">Entretenimiento</p>
                            <h2 class="card-title">Salo del manga</h2>
                            <p class="card-text">Fira del manga i anime amb rellevància mundial i referent a Europa.</p>
                            <button class="card-button
                        material-symbols-outlined">arrow_forward</button>
                        </a>
                    </li>

                    <li class="card-item swiper-slide">
                        <a href="#" class="card-link">
                            <img src="images/salomanga.jpg" alt="" class="card-image">
                            <p class="badge culture">Cultura</p>
                            <h2 class="card-title">Salo del manga</h2>
                            <p class="card-text">Fira del manga i anime amb rellevància mundial i referent a Europa.</p>
                            <button class="card-button
                        material-symbols-outlined">arrow_forward</button>
                        </a>
                    </li>

                    <li class="card-item swiper-slide">
                        <a href="#" class="card-link">
                            <img src="images/salomanga.jpg" alt="" class="card-image">
                            <p class="badge videogames">Videojuegos</p>
                            <h2 class="card-title">Salo del manga</h2>
                            <p class="card-text">Fira del manga i anime amb rellevància mundial i referent a Europa.</p>
                            <button class="card-button
                        material-symbols-outlined">arrow_forward</button>
                        </a>
                    </li>

                    <li class="card-item swiper-slide">
                        <a href="#" class="card-link">
                            <img src="images/salomanga.jpg" alt="" class="card-image">
                            <p class="badge entertainment">Entretenimiento</p>
                            <h2 class="card-title">Salo del manga</h2>
                            <p class="card-text">Fira del manga i anime amb rellevància mundial i referent a Europa.</p>
                            <button class="card-button
                        material-symbols-outlined">arrow_forward</button>
                        </a>
                    </li>

                    <li class="card-item swiper-slide">
                        <a href="#" class="card-link">
                            <img src="images/salomanga.jpg" alt="" class="card-image">
                            <p class="badge food">Comida</p>
                            <h2 class="card-title">Salo del manga</h2>
                            <p class="card-text">Fira del manga i anime amb rellevància mundial i referent a Europa.</p>
                            <button class="card-button
                        material-symbols-outlined">arrow_forward</button>
                        </a>
                    </li>

                </ul>

                <div class="swiper-pagination"></div>


                <div class="swiper-slide-button swiper-button-prev"></div>
                <div class="swiper-slide-button swiper-button-next"></div>

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
    </script>

</body>

</html>