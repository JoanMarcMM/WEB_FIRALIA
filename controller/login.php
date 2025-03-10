<?php


session_start();


$usuario_valido = 'usuario';
$contrasena_usuario_valida = '12345';
$admin_valido = 'admin';
$contrasena_admin_valida = '54321';

// Si se envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['password'];

    if ($usuario === $usuario_valido && $contrasena === $contrasena_usuario_valida) {
        $_SESSION['usuario'] = $usuario;
        header("Location: ../view/bienvenidoUsuario.html");
        exit();
    } elseif ($usuario === $admin_valido && $contrasena === $contrasena_admin_valida) {
        $_SESSION['usuario'] = $usuario;
        header("Location: ../view/bienvenidoAdmin.html");
        exit();
    } else {
        // Redirigir de vuelta a login.html con un mensaje de error
        header("Location: ../login.php?error=1");
        exit();
 
    }
}
?>