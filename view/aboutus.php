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
    <link rel="stylesheet" href="css/about-us.css">
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

    <!-- ------------------------------------------------------------------ Body  --------------------------------------------------------------------------------->
    <section class="main-section">
    <div class="section1">
        <!-- Hero Section -->
        <section class="hero">
            <div class="content-wrapper">
                <div class="text-center">
                    <h1>About Our Company</h1>
                    <p class="subtitle">
                        We're a team of passionate individuals dedicated to creating exceptional products and services that make
                        a difference.
                    </p>
                </div>
            </div>
        </section>

        <!-- Mission & Vision -->
        <section class="mission-vision">
            <div class="content-wrapper">
                <div class="two-column">
                    <div class="column">
                        <div class="mission light">Our Mission</div>
                        <h2>Empowering businesses through innovative solutions</h2>
                        <p>
                            We strive to create products that solve real problems and make a positive impact on our customers'
                            lives. Our mission is to continuously innovate and provide solutions that help businesses grow and
                            succeed in an ever-changing digital landscape.
                        </p>
                    </div>
                    <div class="column">
                        <div class="mission light">Our Vision</div>
                        <h2>Building a better future together</h2>
                        <p>
                            We envision a world where technology enhances human potential and creates opportunities for everyone.
                            We're committed to developing sustainable solutions that address the challenges of today while preparing
                            for the possibilities of tomorrow.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Values -->
        <section class="values">
            <div class="content-wrapper">
                <div class="text-center">
                    <div class="mission light">Our Values</div>
                    <h2>What drives us every day</h2>
                    <p class="subtitle">
                        Our core values shape everything we do and guide our decisions, actions, and interactions.
                    </p>
                </div>
                <div class="three-column">
                    <div class="card">
                        <div class="icon-circle">
                            <i class="icon heart">❤️</i>
                        </div>
                        <h3>Passion</h3>
                        <p>
                            We're passionate about what we do and committed to excellence in every aspect of our work.
                        </p>
                    </div>
                    <div class="card">
                        <div class="icon-circle">
                            <i class="icon users">👥</i>
                        </div>
                        <h3>Collaboration</h3>
                        <p>
                            We believe in the power of teamwork and foster an environment of open communication and mutual
                            respect.
                        </p>
                    </div>
                    <div class="card">
                        <div class="icon-circle">
                            <i class="icon globe">🌎</i>
                        </div>
                        <h3>Innovation</h3>
                        <p>
                            We embrace change and continuously seek new ways to solve problems and create value for our customers.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Our Team -->
        <section class="team">
            <div class="content-wrapper">
                <div class="text-center">
                    <div class="mission light">Our Team</div>
                    <h2>Meet the people behind our success</h2>
                    <p class="subtitle">
                        Our talented team brings diverse skills and perspectives to create exceptional solutions.
                    </p>
                </div>
                <div class="three-column">
                    <div class="team-member">
                        <img src="images/descarga-removebg-preview.png" alt="Mario Perez" class="team-photo">
                        <h3>Mario Pérez Martínez</h3>
                        <p class="role">Marketing manager</p>
                        <p class="subtitle">Mario is one of the founders of Firalia, from the beginning he always showed a certain interest in the appearance of the website and in 
                            trying to make it as striking as possible, with this in mind once the website was launched he was in charge of making sure that the name of Firalia 
                            resonated everywhere. With this, he achieved an incredible boost that led us to be what we are today, one of the largest ticket sales companies.</p>
                    </div>
                    <div class="team-member">
                        <img src="images/F157036F-5CDB-446C-A088-62B4DDCA3CF3-removebg-preview.png" alt="Marvin Esteban" class="team-photo">
                        <h3>Marvin Esteban Gonzales</h3>
                        <p class="role">UX/UI Designer</p>
                        <p class="subtitle">Marvin is one of Firalia’s founder and it UX/UI designer. From the start, he focused on creating an intuitive and visually appealing 
                            experience for our users. His design choices helped shape Firalia’s identity and made the platform easy to navigate and trust. Thanks to his vision, 
                            user experience became a key part of what makes Firalia one of the leading ticket sales companies today.</p>
                            
                    </div>
                    <div class="team-member">
                        <img src=" " alt="Joan Marc" class="team-photo">
                        <h3>Joan Marc Martínez Motis</h3>
                        <p class="role">Product manager</p>
                        <p class="subtitle">Joan Marc, one of the founders of Firalia —the world’s leading ticket-selling platform— has always had a natural talent for sales. 
                            With exceptional communication skills and undeniable charisma, he turns Firalia’s business negotiations into his personal battleground. 
                            His mission? To ensure that when a deal is struck, our clients walk away with the best ticket prices on the market. 
                            Thanks to his efforts, Joan Marc has helped Firalia achieve one of the highest customer satisfaction rates in the industry</p>
                        
                    </div>
                </div>
            </div>
        </section>

        <!-- Company History -->
        <section class="history">
            <div class="content-wrapper">
                <div class="text-center">
                    <div class="mission light">Our Journey</div>
                    <h2>Our company history</h2>
                    <p class="subtitle">
                        From humble beginnings to where we are today, our journey has been defined by growth and innovation.
                    </p>
                </div>
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-marker">
                            <div class="timeline-icon">🕒</div>
                        </div>
                        <div class="timeline-content">
                            <h3>2010 - Founded</h3>
                            <p>
                                Our company was founded with a vision to revolutionize the industry with innovative solutions.
                            </p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker">
                            <div class="timeline-icon">🕒</div>
                        </div>
                        <div class="timeline-content">
                            <h3>2015 - Expansion</h3>
                            <p>
                                We expanded our operations to three new countries and doubled our team size.
                            </p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-marker">
                            <div class="timeline-icon">🕒</div>
                        </div>
                        <div class="timeline-content">
                            <h3>2023 - Today</h3>
                            <p>
                                Today, we serve thousands of customers worldwide and continue to innovate and grow.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>

    
<!-------------------------------------------------------- FOOTER ----------------------------------------------------------------------------------->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-container-1-1">
                <p style="color:#F2F0EF">FIRALIA</p>
            </div>
            <div class="footer-container-1-2">
                <p style="color:#F2F0EF">Conecta con nosotros!</p>
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
                <p style="color:#F2F0EF">Descarga Nuestra App</p>
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
                        <p style="color:#F2F0EF">© 2024-2025 FIRALIA. Todos los derechos reservados.</p>
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