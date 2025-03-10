<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>

    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/REGISTER.css">
</head>

<body>
    <section class="login-section">
        <nav class="main-nav">
            <ul class="sidebar">
                <li onclick=hideSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24px"
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
                <li class="hideOnMobile"><a href="login.php">Iniciar Sesión</a></li>
                <li class="hideOnMobile"><a href="register.php">Registrarse</a></li>
                <li class="menu-button" onclick=showSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg"
                            height="24px" viewBox="0 -960 960 960" width="26px" fill="#e8eaed">
                            <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
                        </svg></a></li>
            </ul>
        </nav>
        <div class="login-grid">
            <div class="login-container">
                <h2>Regístrate</h2>
                <form action="../controller/processSignup.php" method="POST">
                    <div class="input-box">
                        <input type="text" name="name" id="name" placeholder="Nombre" required>
                    </div>

                    <div class="input-box">
                        <input type="text" name="lastname" id="lastname" placeholder="Apellidos" required>
                    </div>

                    <div class="input-box">
                        <input type="text" name="email" id="email" placeholder="Email" required formnovalidate>
                    </div>

                    <div class="input-box">
                        <input type="text" name="user" id="user" placeholder="Username" required>
                    </div>

                    <div class="input-box">
                        <input type="text" name="rol" id="rol"" placeholder="Rol" required formnovalidate>
                    </div>

                    <div class="input-box">
                        <input type="password" name="password" id="password" placeholder="Constraseña" required formnovalidate>
                    </div>

                    <div class="input-box">
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmación Constraseña" required formnovalidate>
                    </div>

                    <div class="input-box">
                        <input type="image" name="user_image" id="user_image" placeholder="Imagen Usuario">
                    </div>



                    <button type="submit" class="btn">Register</button>

                    <div class="register-box">
                        <p>Eres una empresa? <a href="#">Registro para empresas</a></p>
                    </div>
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