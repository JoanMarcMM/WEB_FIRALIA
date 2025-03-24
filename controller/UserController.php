<?php

session_start();

$user = new UserController();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["login"])) {
        $user->login();
    } elseif (isset($_POST["register"])) {
        $user->register();
    } elseif (isset($_POST["logout"])) {
        $user->logout();
    }
}

class UserController
{
    function login()
    {
        $mysqli = conn();

        // Validar el parámetro redirect y asegurar URL relativa
        $redirect = "../view/index.php"; // Redirección por defecto
        if (isset($_POST["redirect"]) && preg_match("/^[a-zA-Z0-9\/\-_]+\.php$/", $_POST["redirect"])) {
            $redirect = "../view/" . $_POST["redirect"];
        }

        // Validar que se reciban los campos necesarios
        if (empty($_POST["user"]) || empty($_POST["password"])) {
            header("Location: $redirect");
            exit();
        }

        // Consulta preparada para evitar inyecciones SQL
        $sql = "SELECT * FROM users WHERE user = ?";
        $stmt = $mysqli->prepare($sql);

        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $mysqli->error);
        }

        $stmt->bind_param("s", $_POST["user"]);
        $stmt->execute();
        $result = $stmt->get_result();

        if (!$result) {
            die("Error en la ejecución de la consulta: " . $stmt->error);
        }

        $user = $result->fetch_assoc();

        // Verificación de contraseña
        if ($user && password_verify($_POST["password"], $user["PASSWORD"])) {
            $_SESSION["user_id"] = $user["ID"];
            header("Location: ../view/profile.php");
            exit();
        }

        // Login inválido, redirigir
        header("Location: $redirect");
        exit();
    }

    function logout()
    {
    
    }

    function register()
    {
        // Lógica para registrar usuarios (no implementada)
    }
}

// Función de conexión a la base de datos
function conn()
{
    $host = "localhost";
    $dbname = "firalia";
    $username = "root"; // Cambiar en producción para mayor seguridad
    $password = "";

    $mysqli = new mysqli($host, $username, $password, $dbname);

    if ($mysqli->connect_errno) {
        die("Error de conexión: " . $mysqli->connect_error);
    }

    return $mysqli;
}
?>