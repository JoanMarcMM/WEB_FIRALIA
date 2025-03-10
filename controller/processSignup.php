<?php

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
$rol = intval($_POST["rol"]); // Convertir a número entero

// Preparar consulta
$sql = "INSERT INTO users (USER, NAME, LASTNAME, EMAIL, PASSWORD, ROL) VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $mysqli->prepare($sql);

if (!$stmt) {
    die("Error SQL: " . $mysqli->error);
}

// Vincular parámetros (sssssi -> string, string, string, string, string, integer)
$stmt->bind_param("sssssi", $username, $name, $lastname, $email, $password_hash, $rol);

// Ejecutar consulta
if ($stmt->execute()) {
    echo "Registro exitoso";
} else {
    echo "Error en el registro: " . $stmt->error;
}

// Cerrar conexión
$stmt->close();
$mysqli->close();

?>
/*if ($stmt->execute()) {

  header("Location: signup-success.html");
   exit;                
    } else {
                    
        if ($mysqli->errno === 1062) {
           die("email already taken");
                } else {
               die($mysqli->error . " " . $mysqli->errno);
                    }
                }
                  */
