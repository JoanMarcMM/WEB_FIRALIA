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
        // Validar email
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            die("Email no válido");
        }

        // Validar rol (1, 2 o 3)
        if (!preg_match("/^[1-3]$/", $_POST["rol"])) {
            die("El rol debe ser 1, 2 o 3");
        }

        // Validar contraseña
        $password = $_POST["password"];
        if (strlen($password) < 8) {
            die("La contraseña debe contener al menos 8 caracteres");
        }

        if (!preg_match("/[a-z]/i", $password)) {
            die("La contraseña debe contener al menos una letra");
        }

        if (!preg_match("/[0-9]/", $password)) {
            die("La contraseña debe contener al menos un número");
        }

        if ($password !== $_POST["password_confirmation"]) {
            die("Las contraseñas deben coincidir");
        }

        // Hashear la contraseña
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Conectar con la base de datos
        $mysqli = require __DIR__ . "/database.php";

        // Sanitizar entradas
        $name = trim(htmlspecialchars($_POST["name"]));
        $lastname = trim(htmlspecialchars($_POST["lastname"]));
        $username = trim(htmlspecialchars($_POST["user"]));
        $email = trim(htmlspecialchars($_POST["email"]));
        $rol = intval(value: $_POST["rol"]); // Convertir a número entero

        // Subida de imagen
        $img_name = $_FILES['imagen']['name'];
        $type = $_FILES['imagen']['type'];
        $size = $_FILES['imagen']['size'];
        $user_image = null;

        if (!empty($img_name) && ($size <= 2000000)) {
            if ($type == "image/jpeg" || $type == "image/jpg" || $type == "image/png") {
                $directory = __DIR__ . "/../controller/imgs/";
                if (!is_dir($directory)) {
                    mkdir($directory, 0777, true);
                }

                $file_name = time() . "_" . basename($img_name);
                $user_image = "imgs/" . $file_name;
                move_uploaded_file($_FILES['imagen']['tmp_name'], $directory . $file_name);
            } else {
                die("Formato de imagen no válido (solo JPG, JPEG o PNG)");
            }
        } elseif (!empty($img_name)) {
            die("La imagen es demasiado grande (máx 2MB)");
        }




        // Preparar consulta
        $sql = "INSERT INTO users (USER, NAME, LASTNAME, EMAIL, PASSWORD, ROL, USER_IMAGE) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $mysqli->prepare($sql);

        if (!$stmt) {
            die("Error SQL: " . $mysqli->error);
        }

        // Vincular parámetros (sssssi -> string, string, string, string, string, integer, blob)
        $stmt->bind_param("sssssib", $username, $name, $lastname, $email, $password_hash, $rol, $user_image);

        // Ejecutar consulta
        if ($stmt->execute()) {
            echo "Registro exitoso";
            header("Location:../view/login.php");
        } else {
            echo "Error en el registro: " . $stmt->error;
        }

        // Cerrar conexión
        $stmt->close();
        $mysqli->close();
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
