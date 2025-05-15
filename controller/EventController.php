<?php
session_start();

$event = new EventController();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["create"])) {
        $event->CreateEvent();
    } elseif (isset($_POST["read"])) {
        $event->ReadEvent();
    } elseif (isset($_POST["update"])) {
        $event->UpdateEvent();
    } elseif (isset($_POST["delete"])) {
        $event->DeleteEvent();
    }
}

class EventController
{
    function CreateEvent(){

    $pdo = $this->conn();

    $nombre = strtoupper(trim(htmlspecialchars($_POST["nombre"])));
    $text1 = trim(htmlspecialchars($_POST["text1"]));


    if (
        isset($_FILES['main_image']) && isset($_FILES['image_text']) &&
        $_FILES['main_image']['error'] === UPLOAD_ERR_OK &&
        $_FILES['image_text']['error'] === UPLOAD_ERR_OK
    ) {
        $main_image_name = $_FILES['main_image']['name'];
        $main_image_type = $_FILES['main_image']['type'];
        $main_image_size = $_FILES['main_image']['size'];
        $main_image_tmp = $_FILES['main_image']['tmp_name'];

        $image_text_name = $_FILES['image_text']['name'];
        $image_text_type = $_FILES['image_text']['type'];
        $image_text_size = $_FILES['image_text']['size'];
        $image_text_tmp = $_FILES['image_text']['tmp_name'];

        
        


        $allowed_types = ["image/jpeg", "image/jpg", "image/png"];
        if (!in_array($main_image_type, $allowed_types) || !in_array($image_text_type, $allowed_types)) {
            $_SESSION["register_error_message_image_format"] = "Formato de imagen no válido (solo JPG, JPEG o PNG).";
            header("Location: ../view/createEvent.php");
            exit();
        }

        $directory = dirname(__DIR__) . "/view/events/" . $nombre . "/";
        if (!is_dir($directory)) {
            if (!mkdir($directory, 0777, true)) {
                die("Error al crear el directorio: " . $directory);
            }
        }

        move_uploaded_file($main_image_tmp, $directory . basename($main_image_name));
        move_uploaded_file($image_text_tmp, $directory . basename($image_text_name));

        $main_image_path = "events/$nombre/" . basename($main_image_name);
        $image_text_path = "events/$nombre/" . basename($image_text_name);
    } else {
        $_SESSION["register_error_message"] = "Error al subir las imágenes.";
        header("Location: ../view/createEvent.php");
        exit();
    }


    $sql = "INSERT INTO eventos (NOMBRE, MAIN_IMAGE_PATH, TEXT1, IMAGE_TEXT_PATH) 
            VALUES (?, ?, ?, ?)";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nombre, $main_image_path, $text1, $image_text_path]);

        $_SESSION["success_message"] = "Evento creado correctamente.";
        header("Location: ../view/createEvent.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION["error_message"] = "Error al guardar en base de datos: " . $e->getMessage();
        header("Location: ../view/createEvent.php");
        exit();
    }
    }
    function ReadEvent()
    {
        echo "<p>Read Event</p>";
    }
    function UpdateEvent()
    {
        echo "<p>Update Event</p>";
    }
    function DeleteEvent()
    {
        echo "<p>Delete Event</p>";
    }


    function conn()
    {
        $dbname = "firalia";
        $servername = "localhost";
        $username = "root";
        $password = "";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected successfully";
            return $conn;
        } catch (PDOException $e) {
            echo "Not connected successfully";
            die("Connection failed: " . $e->getMessage());
        }
    }
}
