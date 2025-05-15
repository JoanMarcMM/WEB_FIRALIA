<?php
//https://phppot.com/php/php-upload-image-to-database/
//https://www.youtube.com/watch?v=5L9UhOnuos0&t=801s
//Credenciales que usaremos para entrar en la bbdd

$host ="localhost";
$dbname = "firalia";
$username = "root"; //IMPORTANTE CAMBIAR , NO QUEREMOS ENTRAR CON ROOT
$password = "";

//Objeto mysqli

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Habilitar errores como excepciones
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;

//Si error, devolver mensaje
} catch (PDOException $e) {
    die("Connection error: " . $e->getMessage());
    }


?>