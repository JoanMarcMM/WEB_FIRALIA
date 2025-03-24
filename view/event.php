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


    <!-- Archivos CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/event.css">

</head>

<body style="background-color: #F2F0EF !important;">

    <nav class="main-nav">
        <!-- ------------------------------------------------------------------ SIDE BAR --------------------------------------------------------------------------------->
        <ul class="sidebar">
            <li onclick="hideSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#">
                        <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                    </svg></a></li>
            <li><a href="concerts.php">Conciertos</a></li>
            <li><a href="events.php">Eventos</a></li>
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
            <li class="hideOnMobile"><a href="events.php">EVENTOS</a></li>
            <li class="hideOnMobile"><a href="support.php">SOPORTE</a></li>
            <li>
                <form class="nav-form">
                    <input type="text" class="search-bx" placeholder="">
                    <input type="image" class="search-icon" src="images/search.svg" alt="Submit">
                </form>
            </li>
            <?php if (isset($_SESSION["user_id"])): ?>

                <li><a href="login.php">foto</a></li>

            <?php else: ?>

                <li class="hideOnMobile"><a href="login.php">INICIAR SESIÓN</a></li>
                <li class="hideOnMobile"><a href="register.php">REGISTRARSE</a></li>

            <?php endif; ?>

            <li class="menu-button" onclick="showSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg"
                        height="24px" viewBox="0 -960 960 960" width="26px" fill="#e8eaed">
                        <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
                    </svg></a></li>
        </ul>
    </nav>
    <!-- ------------------------------------------------------------------ MAIN IMAGE  --------------------------------------------------------------------------------->

    <section class="main-image">
        <img src="images/blackpink.jpg" alt="main image">
        <div class="caption">
            <h1>BLACKPINK</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit...</p>
        </div>
    </section>
    <!-- ------------------------------------------------------------------ PAGE NAV  --------------------------------------------------------------------------------->
    <nav class="page-nav">
        <ul>
            <li><a href="#events">EVENTS</a></li>
            <li><a href="#gallery">GALLERY</a></li>
            <li><a href="#about">ABOUT</a></li>
        </ul>

    </nav>
    <!-- ------------------------------------------------------------------ BODY   --------------------------------------------------------------------------------->

    <section class="main-body">
        <div class="sections-container">

            <div>
                <h1>EVENTS</h1>
                <div class="upcoming">
                    <div class="upcoming-events">
                        <p>Upcoming Events</p>
                    </div>
                    <div class="events-container">
                        <div class="subtitle">
                            <p class="p1">Barcelona</p>
                            <p class="p2">2 Eventos</p>
                        </div>
                        <ul style="list-style-type: none;">
                            <li>
                                <div class="entry">
                                    <div class="date"><p>13</p><p>MARZ</p></div>
                                    <div class="description"><p class="p4">Jueves · 19:00</p><p class="p5">Barcelona · Palau Sant Jordi</p><p class="p4">BLACKPINK</p></div>
                                    <div class="ticket-btn-container"><button class="ticket-btn" href="#">COMPRAR TICKETS</button></div>
                                </div>
                            </li>
                            <li>
                                <div class="entry">
                                <div class="date"><p>14</p><p>MARZ</p></div>
                                <div class="description"><p class="p4">Viernes · 19:00</p><p class="p5">Barcelona · Palau Sant Jordi</p><p class="p4">BLACKPINK</p></div>
                                <div class="ticket-btn-container"><button class="ticket-btn" href="#">COMPRAR TICKETS</button></div>
                                </div>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="gallery" id="gallery">
                <h1>GALLERY</h1>
            </div>

            <div class="about" id="about">
                <h1>ABOUT</h1>
            </div>


        </div>


    </section>

    <!-- ------------------------------------------------------------------ FOOTER  --------------------------------------------------------------------------------->



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