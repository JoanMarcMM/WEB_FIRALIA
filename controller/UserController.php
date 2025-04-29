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
    } elseif (isset($_POST["deleteUser"])) {
        $user->deleteUser();
    } elseif (isset($_POST["updateUser"])) {
        $user->updateUser();
    }
}



class UserController
{
    function login()
    {
        session_start();
        $mysqli = $this->conn();

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
        session_start();
        $mysqli = $this->conn();
    
        // VALIDACIONES

        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $_SESSION["register_error_message_email"] = "Email no válido.";
            header("Location: ../view/register.php");
            exit();
        }
    
        if (!preg_match("/^[1-3]$/", $_POST["rol"])) {
            $_SESSION["register_error_message_rol"] = "El rol debe ser 1, 2 o 3.";
            header("Location: ../view/register.php");
            exit();
        }
    
        $password = $_POST["password"];
        if (strlen($password) < 8 || !preg_match("/[a-z]/i", $password) || !preg_match("/[0-9]/", $password)) {
            $_SESSION["register_error_message_password"] = "La contraseña debe tener al menos 8 caracteres, una letra y un número.";
            header("Location: ../view/register.php");
            exit();
        }
    
        if ($password !== $_POST["password_confirmation"]) {
            $_SESSION["register_error_message_confirmation"] = "Las contraseñas no coinciden.";
            header("Location: ../view/register.php");
            exit();
        }
    
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
    
        // SANITIZAR ENTRADAS
        $name = trim(htmlspecialchars($_POST["name"]));
        $lastname = trim(htmlspecialchars($_POST["lastname"]));
        $username = trim(htmlspecialchars($_POST["user"]));
        $email = trim(htmlspecialchars($_POST["email"]));
        $rol = intval($_POST["rol"]);
    
        // SUBIDA DE IMAGEN
        $user_image = null;
        if (!empty($_FILES['imagen']['name'])) {
            $img_name = $_FILES['imagen']['name'];
            $type = $_FILES['imagen']['type'];
            $size = $_FILES['imagen']['size'];
    
            if ($size > 2000000) {
                $_SESSION["register_error_message_image_size"] = "La imagen es demasiado grande (máx 2MB).";
                header("Location: ../view/register.php");
                exit();
            }
    
            if ($type == "image/jpeg" || $type == "image/jpg" || $type == "image/png") {
                $directory = __DIR__ . "/images/";
                if (!is_dir($directory)) {
                    mkdir($directory, 0777, true);
                }
    
                $file_name = time() . "_" . basename($img_name);
                $user_image = "images/" . $file_name;
                move_uploaded_file($_FILES['imagen']['tmp_name'], $directory . $file_name);
            } else {
                $_SESSION["register_error_message_image_format"] = "Formato de imagen no válido (solo JPG, JPEG o PNG).";
                header("Location: ../view/register.php");
                exit();
            }
        }
    
        // INSERTAR EN BASE DE DATOS
        $sql = "INSERT INTO users (USER, NAME, LASTNAME, EMAIL, PASSWORD, ROL, USER_IMAGE) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($sql);
    
        if (!$stmt) {
            $_SESSION["register_error_message_sql"] = "Error SQL: " . $mysqli->error;
            header("Location: ../view/register.php");
            exit();
        }
    
        $stmt->bind_param("sssssis", $username, $name, $lastname, $email, $password_hash, $rol, $user_image);
    
        if ($stmt->execute()) {
            $_SESSION["success_message"] = "Registro exitoso. Ahora puedes iniciar sesión.";
            $stmt->close();
            $mysqli->close();
            header("Location: ../view/login.php");
            exit();
        } else {
            $_SESSION["error_message"] = "Error en el registro: " . $stmt->error;
            $stmt->close();
            $mysqli->close();
            header("Location: ../view/register.php");
            exit();
        }
    }
    
    
    



    function deleteUser()
    {
        session_start();

        $mysqli = $this->conn();

        if (isset($_SESSION["user_id"])) {
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
    {
        session_start(); // Asegúrate de que la sesión esté iniciada

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
}
