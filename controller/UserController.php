<?php
session_start();



class UserController
{
    function login()
    {
        session_start(); // Asegurar que la sesión está iniciada
        $mysqli = conn();
        
        $redirect = "../view/index.php"; 
        if (isset($_POST["redirect"]) && preg_match("/^[a-zA-Z0-9\/\-_]+\.php$/", $_POST["redirect"])) {
            $redirect = "../view/" . $_POST["redirect"];
        }
        
        if (empty($_POST["user"]) || empty($_POST["password"])) {
            $_SESSION["error_message"] = "Usuario o contraseña vacíos.";
            header("Location: $redirect");
            exit();
        }
        
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
        
        // Si el login falla, guardar mensaje en sesión y redirigir
        $_SESSION["error_message"] = "Usuario o contraseña incorrectos.";
        header("Location: $redirect");
        exit();
    }

    function logout()
    {
        session_destroy();

        // Verifica si las cabeceras no han sido enviadas antes de la redirección
        if (!headers_sent()) {
            header("Location: ../view/index.php");
            exit;
        } else {
            echo "Error: Las cabeceras ya han sido enviadas. No se puede redirigir.";
        }

    }

    function register()
    {
        // Lógica para registrar usuarios (no implementada)
    }
}

//Inicializaión de userController() movida después de la creación
//de la clase para evitar error de referencia(Marvin)
$user = new UserController();

//Manejo de solicitudes post movida despues de crear la clase 
//para asegurar que esta ya esta creada antes de usarla (Marvin)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["login"])) {
        $user->login();
    } elseif (isset($_POST["register"])) {
        $user->register();
    } elseif (isset($_POST["logout"])) {
        $user->logout();
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