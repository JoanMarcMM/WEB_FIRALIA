

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>

    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/login.css">
</head>

<body>
    <section class="login-section">
    <nav class="main-nav">
        <!-- ------------------------------------------------------------------ SIDE BAR --------------------------------------------------------------------------------->
        <ul class="sidebar">
            <li onclick="hideSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></a></li>
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
        <div class="login-grid">
            <div class="login-container">
                <h2>Iniciar Sesión</h2>

                <?php if ($is_invalid): ?>
                    <em>Invalid Credentials</em>
                <?php endif;?>

                <form  method="POST" action="../controller/UserController.php">
                <input type="hidden" name="redirect" value="<?php echo basename($_SERVER['PHP_SELF']); ?>">
                <input type="hidden" name="login" value="login">
                    <div class="input-box">
                        <input type="text" name="user" id="user" placeholder="Username" required>
                    </div>

                    <div class="input-box">
                        <input type="password" name="password" id="password" placeholder="Password" required>
                    </div>

                    <div class="remember-forgot">
                        <label><input type="checkbox">Recuerdame</label>
                        <a href="#">Restablecer contraseña</a>
                    </div>

                    <button type="submit" class="btn">Login</button>

                    <div class="register-box">
                        <p>No tiene cuenta? <a href="#">Regístrate</a></p>
                  <div>
                </form>
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
                    <li><a href="#">Terminos de Uso</a></li>
                    <li><a href="#">Política de Cookies</a></li>
                    <li><a href="#">Control de Cookies</a></li>
                    <li>
                        <p>© 2024-2025 FIRALIA. Todos los derechos reservados.</p>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
    <script>
        function showSidebar() {
            const sidebar = document.querySelector('.sidebar')
            sidebar.style.display = 'flex'
        }
        function hideSidebar() {
            const sidebar = document.querySelector('.sidebar')
            sidebar.style.display = 'none'
        }
    </script>


</body>

</html>