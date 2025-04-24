<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>

    
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=arrow_forward" />

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/event.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body style="background-color: #F2F0EF !important;">

    <nav class="main-nav">
        <!-- ------------------------------------------------------------------ SIDE BAR --------------------------------------------------------------------------------->
        <ul class="sidebar">
            <li onclick="hideSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#">
                        <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
                    </svg></a></li>
            <li><a href="aboutus.php">NOSOTROS</a></li>
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
                </a>
            </li>
            <li class="hideOnMobile link"><a href="aboutus.php">NOSOTROS</a></li>
            <li class="hideOnMobile link"><a href="event.php">EVENTOS</a></li>
            <li class="hideOnMobile link"><a href="support.php">SOPORTE</a></li>

            <li>
                <form class="nav-form">
                    <input type="text" class="search-bx" placeholder="">
                    <input type="image" class="search-icon" src="images/search.svg" alt="Submit">
                </form>
            </li>
            <?php if (isset($_SESSION["user_id"])): ?>
                <li><a href="profile.php"><img src="images/icons/estandarPfp.jpg" alt="Pfp" class="pfpNav"></a></li>
            <?php else: ?>
                <li class="hideOnMobile"><button id="open-popup">LOG IN</button></li>
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
                        unset($_SESSION["error_message"]);
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

    <!-- ------------------------------------------------------------------ MAIN IMAGE  --------------------------------------------------------------------------------->

    <section class="main-image">
        <img src="images/blackpink.jpg" alt="main image">
        <div class="caption">
            <h1>BLACKPINK</h1>
            <p></p>
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

            <div class="events">
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
                                    <div class="date">
                                        <p>13</p>
                                        <p>MARZ</p>
                                    </div>
                                    <div class="description">
                                        <p class="p4">Jueves · 19:00</p>
                                        <p class="p5">Barcelona · Palau Sant Jordi</p>
                                        <p class="p4">BLACKPINK</p>
                                    </div>
                                    <div class="ticket-btn-container"><button class="ticket-btn" href="#">COMPRAR TICKETS</button></div>
                                </div>
                            </li>
                            <li>
                                <div class="entry">
                                    <div class="date">
                                        <p>14</p>
                                        <p>MARZ</p>
                                    </div>
                                    <div class="description">
                                        <p class="p4">Viernes · 19:00</p>
                                        <p class="p5">Barcelona · Palau Sant Jordi</p>
                                        <p class="p4">BLACKPINK</p>
                                    </div>
                                    <div class="ticket-btn-container"><button class="ticket-btn" href="#">COMPRAR TICKETS</button></div>
                                </div>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="gallery" id="gallery">
                <h1>GALLERY</h1>
                <div class="container">
                <div class="slider-wrapper">
                    <div class="image-list">
                        <iframe class="image-item" width="560" height="315" src="https://www.youtube.com/embed/2S24-y0Ij3Y?si=kjHpcbtpMblz_eVg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        <iframe class="image-item" width="560" height="315" src="https://www.youtube.com/embed/IHNzOHi8sJs?si=UaIR-tYZuo96IAcO" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        <iframe class="image-item" width="560" height="315" src="https://www.youtube.com/embed/gQlMMD8auMs?si=8r9E6lcCH08cO7Is" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        <iframe class="image-item" width="560" height="315" src="https://www.youtube.com/embed/POe9SOEKotk?si=uE-uUzjL9Fch2k-r" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        <iframe class="image-item" width="560" height="315" src="https://www.youtube.com/embed/dyRsYk0LyA8?si=tnWCZj4SGZDRBW-I" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        <iframe class="image-item" width="560" height="315" src="https://www.youtube.com/embed/bwmSjveL3Lc?si=RCPISGXfp-Wjh7PM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                     </div>
                </div>
                </div>
            </div>

            <div class="about" id="about">
                <h1>ABOUT</h1>
                <div class="about-container">
                    <div class="text">
                        <p>BLACKPINK es un grupo femenino de K-pop formado por YG Entertainment en 2016. Está compuesto por cuatro miembros: Jisoo, Jennie, Rosé y Lisa. Desde su debut, se han convertido en uno de los grupos más influyentes de la industria musical a nivel global, rompiendo récords y ganándose un lugar en la cultura pop internacional. <br>
                            <br> BLACKPINK debutó el 8 de agosto de 2016 con los sencillos "Boombayah" y "Whistle", que fueron un éxito inmediato. Con su estilo distintivo, que mezcla pop, hip-hop y EDM, el grupo ha lanzado éxitos como "DDU-DU DDU-DU", "Kill This Love", "How You Like That", y "Pink Venom". Su música ha dominado las listas de éxitos en Corea del Sur y en plataformas globales como Billboard y Spotify.
                            <br> En 2020, lanzaron su primer álbum de estudio, "THE ALBUM", que incluía colaboraciones con artistas como Selena Gomez y Cardi B. Su impacto en la música global se consolidó con su gira mundial y su presentación en Coachella 2019, convirtiéndose en el primer grupo femenino de K-pop en actuar en el festival.<br>
                            <br>BLACKPINK es reconocido por su poderosa presencia escénica, coreografías icónicas y una imagen vanguardista que ha redefinido la estética del K-pop. Cada miembro también ha desarrollado carreras individuales en la moda, la actuación y la música en solitario. Han sido embajadoras de marcas de lujo como Chanel, Dior, Celine y Bulgari, y han aparecido en portadas de revistas de renombre internacional.<br>
                            <br>Los seguidores de BLACKPINK son conocidos como BLINKs. La base de fans es una de las más activas en redes sociales, apoyando al grupo en cada lanzamiento y consiguiendo récords en plataformas digitales.<br>
                            <br>BLACKPINK ha demostrado ser más que un fenómeno pasajero en el K-pop. Su éxito ha abierto puertas para otros artistas asiáticos en la industria global y han sido reconocidas por la crítica y el público como una de las agrupaciones más influyentes del siglo XXI. Aunque su futuro es incierto debido a los contratos con YG Entertainment, su impacto en la música y la moda sigue siendo indiscutible.
                        </p>

                    </div>
                    <div class="image">
                        <img src="images/bp.jpg" alt="foto artista">
                    </div>
                </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
           
            function showSidebar() {
                const sidebar = document.querySelector('.sidebar');
                sidebar.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }

            function hideSidebar() {
                const sidebar = document.querySelector('.sidebar');
                sidebar.style.display = 'none';
                document.body.style.overflow = '';
            }

            
            function createPopup(id) {
                let popupNode = document.querySelector(id);
                let overlay = popupNode.querySelector(".overlay");
                let closeBtn = popupNode.querySelector(".close-btn");

                function openPopup() {
                    popupNode.classList.add("active");
                    document.body.style.overflow = 'hidden';
                }

                function closePopup() {
                    popupNode.classList.remove("active");
                    document.body.style.overflow = '';
                }

                if (document.querySelector(".error-message")) {
                    openPopup();
                }

                overlay.addEventListener("click", closePopup);
                closeBtn.addEventListener("click", closePopup);

                return openPopup;
            }

            
            const img = document.getElementById('logo-nav');
            if (img) {
                img.addEventListener('mouseenter', () => {
                    img.src = 'images/logo2.png';
                });

                img.addEventListener('mouseleave', () => {
                    img.src = 'images/logo2-modified.png';
                });
            }

            
            document.querySelector(".menu-button")?.addEventListener("click", showSidebar);
            document.querySelector(".sidebar li:first-child")?.addEventListener("click", hideSidebar);

            const openPopupBtn = document.querySelector("#open-popup");
            if (openPopupBtn) {
                let popup = createPopup("#popup");
                openPopupBtn.addEventListener("click", popup);
            }

            if (typeof Swiper !== 'undefined') {
                new Swiper('.swiper', {
                    slidesPerView: 'auto',
                    spaceBetween: 20,
                    freeMode: true,
                });
            }
        });
    </script>

</body>

</html>