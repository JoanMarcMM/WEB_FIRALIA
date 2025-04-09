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
$rol = intval(value: $_POST["rol"]); // Convertir a número entero

// ===================== SUBIDA DE IMAGEN ======================
$img_name = $_FILES['imagen']['name'];
$type = $_FILES['imagen']['type'];
$size = $_FILES['imagen']['size'];
$user_image = null;

if (!empty($img_name) && ($size <= 2000000)) {
    if ($type == "image/jpeg" || $type == "image/jpg" || $type == "image/png") {
        $directory = __DIR__ . "/../imgs/";
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

?>

