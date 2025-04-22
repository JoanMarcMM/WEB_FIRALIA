<?php
session_start();



class UserController
{
    function login()
    {
        session_start();
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


        if ($user && password_verify($_POST["password"], $user["PASSWORD"])) {
            $_SESSION["user_id"] = $user["ID"];
            $_SESSION["rol"] = $user["ROL"];
            if ($_SESSION['rol'] == 1) {
                header("Location: ../view/profileadmin.php");
            } else {
                header("Location: ../view/profile.php");
            }

            exit();
        }


        $_SESSION["error_message"] = "Usuario o contraseña incorrectos.";
        header("Location: $redirect");
        exit();
    }

    function logout()
    {
        session_start();  
                
        session_unset();
              
        session_destroy();
        
        if (!headers_sent()) {
            header("Location: ../view/index.php");  
            exit();
        } else {
            echo "Error: Las cabeceras ya han sido enviadas. No se puede redirigir.";
        }
    }

    function register()
    {
        // Lógica para registrar usuarios (no implementada)
    }

    function deleteUser()
{
    session_start(); 

    $mysqli = conn();

    if(isset($_SESSION["user_id"])){
    $sql = "DELETE FROM users WHERE ID = ?";
    $stmt = $mysqli->prepare($sql);

    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $mysqli->error);
    }

    $stmt->bind_param("i", $_SESSION["user_id"]);
    $stmt->execute();

    $stmt->close();
    $mysqli->close();

    session_destroy();

    if (!headers_sent()) {
        header("Location: ../view/index.php");
        exit;
    } else {
        echo "Error: Las cabeceras ya han sido enviadas. No se puede redirigir.";
    }
}
}

    function updateUser()
    {session_start(); // Asegúrate de que la sesión esté iniciada

        // Validar email
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            die("Email no válido");
        }
        
        // Conectar con la base de datos
        $mysqli = require __DIR__ . "/database.php";
        
        // Sanitizar entradas
        $name = trim(htmlspecialchars($_POST["name"]));
        $lastname = trim(htmlspecialchars($_POST["lastname"]));
        $username = trim(htmlspecialchars($_POST["user"]));
        $email = trim(htmlspecialchars($_POST["email"]));
        
        // Obtener ID del usuario desde la sesión
        $userId = $_SESSION["user_id"]; // ⚠️ Asegúrate de que esté definida la sesión y este valor
        
        // Preparar consulta
        $sql = "UPDATE users SET USER = ?, NAME = ?, LASTNAME = ?, EMAIL = ? WHERE ID = ?";
        $stmt = $mysqli->prepare($sql);
        
        if (!$stmt) {
            die("Error SQL: " . $mysqli->error);
        }
        
        // Vincular parámetros
        $stmt->bind_param("ssssi", $username, $name, $lastname, $email, $userId);
        
        // Ejecutar consulta
        if ($stmt->execute()) {
            header("Location: ../view/profile.php");
            exit;
        } else {
            echo "Error en el update: " . $stmt->error;
        }
        
        // Cerrar conexión
        $stmt->close();
        $mysqli->close();


    }
}


$user = new UserController();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["login"])) {
        $user->login();
    } elseif (isset($_POST["register"])) {
        $user->register();
    } elseif (isset($_POST["logout"])) {
        $user->logout();
    } elseif (isset($_POST["deleteUser"])) {
        $user->deleteUser();
    } elseif (isset($_POST["updateUser"])) {
        $user->updateUser();
    }
}


function conn()
{
    $host = "localhost";
    $dbname = "firalia";
    $username = "root";
    $password = "";

    $mysqli = new mysqli($host, $username, $password, $dbname);

    if ($mysqli->connect_errno) {
        die("Error de conexión: " . $mysqli->connect_error);
    }

    return $mysqli;
}
