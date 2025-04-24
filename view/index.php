<?php
session_start();
if (isset($_SESSION["user_image"])) {
    $user_image = $_SESSION["user_image"];
}
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
            <li onclick="hideSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24px"
                        viewBox="0 -960 960 960" width="24px" fill="#">
                        <path
                            d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
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
            <li>
                <?php if ($_SESSION["rol"] == 1): ?>
                <a href="profileadmin.php">
                    <img src="../controller/<?= $user_image ?>" alt="Pfp" class="pfpNav">
                    <?php else: ?>
                    <a href="profile.php">
                        <img src="images/icons/estandarPfp.jpg" alt="Pfp" class="pfpNav">
                        <?php endif; ?>
                    </a>
            </li>
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

    <!-- ------------------------------------------------------------------ MAIN carrousel  --------------------------------------------------------------------------------->
    <section class="main-section">
        <div class="carousel slide" id="carouselDemo" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="4000">
                    <img src="images/blackpink.jpg" class="w-100" alt="BLACKPINK concert">
                    <div class="carousel-caption">
                        <h1>BLACKPINK</h1>
                        <p> Icono global del K-pop con potentes coreografías y una presencia audaz.</p>
                    </div>
                </div>

                <div class="carousel-item" data-bs-interval="4000">
                    <img src="images/sabrinacarpenter.jpg" class="w-100" alt="Sabrina Carpenter concert">
                    <div class="carousel-caption">
                        <h1>SABRINA CARPENTER</h1>
                        <p>Cantante pop con letras profundas y estilo juvenil.</p>
                    </div>
                </div>

                <div class="carousel-item" data-bs-interval="4000">
                    <img src="images/postmalone.jpg" class="w-100" alt="Post Malone concert">
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
                <button type="button" data-bs-target="#carouselDemo" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#carouselDemo" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#carouselDemo" data-bs-slide-to="2"></button>
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
                    <div class="image-to-overlay">
                        <img href="event.php" class="cont-img" src="images/blackpink.jpg" alt="BLACKPINK concert">
                        <div class="content">
                            <h2>BLACKPINK</h2>
                            <p>World Tour 2024</p>
                        </div>
                    </div>
                </div>
                <div class="cont2">
                    <div class="image-to-overlay">
                        <img class="cont-img" src="images/salomanga.jpg" alt="Salomanga event">
                        <div class="content">
                            <h2>Salomanga</h2>
                            <p>Food Festival</p>
                        </div>
                    </div>
                </div>
                <div class="cont3">
                    <div class="image-to-overlay">
                        <img class="cont-img" src="images/championsburguer.jpg" alt="Champions Burger event">
                        <div class="content">
                            <h2>Champions Burger</h2>
                            <p>Food Competition</p>
                        </div>
                    </div>
                </div>
                <div class="cont4">
                    <div class="image-to-overlay">
                        <img class="cont-img" src="images/postmalone.jpg" alt="Post Malone concert">
                        <div class="content">
                            <h2>Post Malone</h2>
                            <p>If Y'all Weren't Here Tour</p>
                        </div>
                    </div>
                </div>
                <div class="cont5">
                    <div class="image-to-overlay">
                        <img class="cont-img" src="images/sabrinacarpenter.jpg" alt="Sabrina Carpenter concert">
                        <div class="content">
                            <h2>Sabrina Carpenter</h2>
                            <p>Emails I Can't Send Tour</p>
                        </div>
                    </div>
                </div>
                <div class="cont6">
                    <div class="image-to-overlay">
                        <img class="cont-img" src="images/mobileworldcongrss.jpg" alt="Mobile World Congress">
                        <div class="content">
                            <h2>MWC</h2>
                            <p>Tech Conference</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="queda-poco">
            <div class="queda-poco-display">
                <div class="title-queda-poco">
                    <h1>QUEDA POCO</h1>
                </div>
                <div class="queda-poco-img">

                    <div class="image-to-overlay">
                        <img src="images/mobileworldcongrss.jpg" alt="Mobile World Congress">
                        <div class="content">
                            <h2>MWC</h2>
                            <p>Tech Conference</p>
                        </div>
                    </div>
                </div>
                <div class="queda-poco-img">

                    <div class="image-to-overlay">
                        <img src="images/blackpink.jpg" alt="BLACKPINK concert">
                        <div class="content">
                            <h2>MWC</h2>
                            <p>Tech Conference</p>
                        </div>
                    </div>
                </div>
                <div class="queda-poco-img">
                    <div class="image-to-overlay">
                        <img src="images/championsburguer.jpg" alt="Champions Burger event">
                        <div class="content">
                            <h2>MWC</h2>
                            <p>Tech Conference</p>
                        </div>
                    </div>

                </div>
                <div class="queda-poco-img">
                    <div class="image-to-overlay">
                        <img src="images/postmalone.jpg" alt="Champions Burger event">
                        <div class="content">
                            <h2>MWC</h2>
                            <p>Tech Conference</p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>


    <section class="info-2">
        <div class="title-recomendations">
            <h1>LO MEJOR DEL TEATRO</h1>
        </div>
        <div class="recomendaciones">
            <div class="container">

                <div class="image-list">

                    <img class="image-item" width="560" height="315" src="images/circodusolei.jpg"></img>
                    <img class="image-item" width="560" height="315" src="images/marcicel.jpg"></img>
                    <img class="image-item" width="560" height="315" src="images/reyleon.jpg"></img>
                    <img class="image-item" width="560" height="315" src="images/grease.jpg"></img>
                    <img class="image-item" width="560" height="315" src="images/westsidestory.jpg"></img>
                </div>

            </div>
        </div>

    </section>

    <section class="info-2">
        <div class="title-recomendations">
            <h1>LA MEJOR MUSICA EN DIRECTO</h1>
        </div>
        <div class="recomendaciones">
            <div class="container">

                <div class="image-list">
                    <img class="image-item" width="560" height="315" src="images/imaginedragons.jpg"></img>
                    <img class="image-item" width="560" height="315" src="images/taylorswift.jpg"></img>
                    <img class="image-item" width="560" height="315" src="images/ladygaga.jpg"></img>
                    <img class="image-item" width="560" height="315" src="images/katyperry.jpg"></img>
                    <img class="image-item" width="560" height="315" src="images/blackpink.jpg"></img>
                </div>

            </div>
        </div>

    </section>

    <section class="info-2">
        <div class="title-recomendations">
            <h1>RECOMENDACIONES</h1>
        </div>
        <div class="recomendaciones">
            <div class="container">

                <div class="image-list">
                    <img class="image-item" width="560" height="315" src="images/bbf.jpg"></img>
                    <img class="image-item" width="560" height="315" src="images/taylorswift.jpg"></img>
                    <img class="image-item" width="560" height="315" src="images/japanweekend.jpg"></img>
                    <img class="image-item" width="560" height="315" src="images/katyperry.jpg"></img>
                    <img class="image-item" width="560" height="315" src="images/imaginedragons.jpg"></img>
                </div>

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
    <script>
        document.addEventListener('DOMContentLoaded', function () {

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