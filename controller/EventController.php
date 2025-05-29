<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();


$event = new EventController();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["create"])) {
        $event->CreateEvent();
    } elseif (isset($_POST["read"])) {
        $event->ReadEvent();
    } elseif (isset($_POST["update"])) {
        $id = $_POST['id'] ?? null;
        if ($id) {
            $event->UpdateEvent($id);
        }
        $event->UpdateEvent($id);
    } elseif (isset($_POST["delete"])) {
        $event->DeleteEvent();
    } elseif (isset($_POST["date"])) {
        $event->AddDateEvent();
    } elseif (isset($_POST["galleryVideo"])) {
        $event->AddGalleryVideoEvent();
    }
}

class EventController
{
    function CreateEvent()
    {

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
       $pdo = $this->conn();
    
    try {
        $sql = "SELECT ID, NOMBRE, MAIN_IMAGE_PATH FROM eventos ORDER BY NOMBRE ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        
        $eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $_SESSION['eventos'] = $eventos;
        
        header("Location: ../view/readEvent.php");
        exit();
        
    } catch (PDOException $e) {
        $_SESSION["error_message"] = "Error al leer eventos: " . $e->getMessage();
        header("Location: ../view/readEvent.php");
        exit();
    }
    }
    function UpdateEvent($id)
    {
        $pdo = $this->conn();

        $nombre = strtoupper(trim(htmlspecialchars($_POST["nombre"])));
        $text1 = trim(htmlspecialchars($_POST["text1"]));

        $stmt = $pdo->prepare("SELECT MAIN_IMAGE_PATH, IMAGE_TEXT_PATH, NOMBRE FROM eventos WHERE ID = ?");
        $stmt->execute([$id]);
        $evento = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$evento) {
            $_SESSION["error_message"] = "Evento no encontrado.";
            header("Location: ../view/updateEvent.php?id=$id");
            exit();
        }

        $main_image_path = $evento['MAIN_IMAGE_PATH'];
        $image_text_path = $evento['IMAGE_TEXT_PATH'];
        $old_nombre = $evento['NOMBRE'];

        $directory = dirname(__DIR__) . "/view/events/" . $nombre . "/";
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        $allowed_types = ["image/jpeg", "image/jpg", "image/png"];

        if (isset($_FILES['main_image']) && $_FILES['main_image']['error'] === UPLOAD_ERR_OK) {
            $main_image_type = $_FILES['main_image']['type'];
            if (!in_array($main_image_type, $allowed_types)) {
                $_SESSION["register_error_message_image_format"] = "Formato de imagen principal no válido.";
                header("Location: ../view/updateEvent.php?id=$id");
                exit();
            }

            $main_image_name = $_FILES['main_image']['name'];
            $main_image_tmp = $_FILES['main_image']['tmp_name'];
            move_uploaded_file($main_image_tmp, $directory . basename($main_image_name));
            $main_image_path = "events/$nombre/" . basename($main_image_name);
        }

        if (isset($_FILES['image_text']) && $_FILES['image_text']['error'] === UPLOAD_ERR_OK) {
            $image_text_type = $_FILES['image_text']['type'];
            if (!in_array($image_text_type, $allowed_types)) {
                $_SESSION["register_error_message_image_format"] = "Formato de imagen de texto no válido.";
                header("Location: ../view/updateEvent.php?id=$id");
                exit();
            }

            $image_text_name = $_FILES['image_text']['name'];
            $image_text_tmp = $_FILES['image_text']['tmp_name'];
            move_uploaded_file($image_text_tmp, $directory . basename($image_text_name));
            $image_text_path = "events/$nombre/" . basename($image_text_name);
        }

        $sql = "UPDATE eventos 
            SET NOMBRE = ?, MAIN_IMAGE_PATH = ?, TEXT1 = ?, IMAGE_TEXT_PATH = ?
            WHERE ID = ?";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nombre, $main_image_path, $text1, $image_text_path, $id]);

            header("Location: ../view/updateSuccess.php?id=$id");
            exit();
        } catch (PDOException $e) {
            $_SESSION["error_message"] = "Error al actualizar en base de datos: " . $e->getMessage();
            header("Location: ../view/updateEvent.php?id=$id");
            exit();
        }

    }
  function DeleteEvent()
{
    $pdo = $this->conn();
    
    $id = $_POST["id"] ?? null;
    
    if (!filter_var($id, FILTER_VALIDATE_INT)) {
        $_SESSION["error_message"] = "ID de evento inválido.";
        header("Location: ../view/deleteEvent.php");
        exit();
    }

    try {
        // Iniciamos una transacción para asegurar la integridad de los datos
        $pdo->beginTransaction();

        // 1. Obtenemos los datos del evento
        $stmt = $pdo->prepare("SELECT NOMBRE, MAIN_IMAGE_PATH, IMAGE_TEXT_PATH FROM eventos WHERE ID = ?");
        $stmt->execute([$id]);
        $evento = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$evento) {
            throw new Exception("Evento no encontrado.");
        }

        // 2. Eliminamos registros relacionados primero (claves foráneas)
        $pdo->prepare("DELETE FROM fechas_eventos WHERE ID_EVENTO = ?")->execute([$id]);
        $pdo->prepare("DELETE FROM galeria_eventos WHERE ID_EVENTO = ?")->execute([$id]);

        // 3. Eliminamos el evento
        $pdo->prepare("DELETE FROM eventos WHERE ID = ?")->execute([$id]);

        // 4. Eliminamos archivos físicos
        $mainImagePath = dirname(__DIR__) . "/view/" . $evento['MAIN_IMAGE_PATH'];
        $textImagePath = dirname(__DIR__) . "/view/" . $evento['IMAGE_TEXT_PATH'];
        $eventDir = dirname($mainImagePath);

        if (file_exists($mainImagePath)) unlink($mainImagePath);
        if (file_exists($textImagePath)) unlink($textImagePath);

        // Intentamos eliminar el directorio si está vacío
        if (is_dir($eventDir)) {
            @rmdir($eventDir); // @ suprime warnings si no está vacío
        }

        $pdo->commit();
        
        $_SESSION["success_message"] = "Evento eliminado correctamente.";
    } catch (Exception $e) {
        $pdo->rollBack();
        $_SESSION["error_message"] = "Error al eliminar el evento: " . $e->getMessage();
    }
    
    header("Location: ../view/deleteEvent.php");
    exit();
}

// Nueva función solo para obtener eventos para el formulario de eliminación
function GetEventsForDeletion()
{
    $pdo = $this->conn();
    
    try {
        $sql = "SELECT ID, NOMBRE FROM eventos ORDER BY NOMBRE ASC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $_SESSION["error_message"] = "Error al cargar eventos: " . $e->getMessage();
        return [];
    }
}
    


    function AddDateEvent()
    {

        $pdo = $this->conn();

        $evento = (htmlspecialchars($_POST["evento"]));
        $localizacion = trim(htmlspecialchars($_POST["localizacion"]));
        $ciudad = trim(htmlspecialchars($_POST["ciudad"]));
        $date = $_POST["fecha"];
        $hora = $_POST["hora"];
        $nombre_dia = date('l', strtotime($date));
        $mes = date('M', strtotime($date));
        $dia = date('d', strtotime($date));
        $hora = date('G', strtotime($hora));
        $minuto = date('i', strtotime($hora));


        $sql = "INSERT INTO fechas_eventos (NUM_DIA,MES,NOMBRE_DIA,HORA,MINUTO,CIUDAD,LOCALIZACION,ID_EVENTO) 
            VALUES (?, ?, ?, ? , ? , ? , ?,?)";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$dia, $mes, $nombre_dia, $hora, $minuto, $ciudad, $localizacion, $evento]);

            $_SESSION["success_message"] = "Evento creado correctamente.";
            header("Location: ../view/addDateEvent.php");
            exit();
        } catch (PDOException $e) {
            $_SESSION["error_message"] = "Error al guardar en base de datos: " . $e->getMessage();
            header("Location: ../view/addDateEvent.php");
            exit();
        }
    }
    function AddGalleryVideoEvent()
    {

        $pdo = $this->conn();

        $id = $_POST["evento-video"] ?? null;
        $video = $_POST["link"] ?? null;

        if (!filter_var($id, FILTER_VALIDATE_INT)) {
            $_SESSION["error_message"] = "ID de evento inválido.";
            header("Location: ../view/addGalleryEvent.php");
            exit();
        }

        if (empty($video)) {
            $_SESSION["error_message"] = "El enlace del video está vacío.";
            header("Location: ../view/addGalleryEvent.php");
            exit();
        }

        $stmt = $pdo->prepare("SELECT NOMBRE FROM eventos WHERE ID = ?");
        $stmt->execute([$id]);
        $nombre = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$nombre) {
            $_SESSION["error_message"] = "Evento no encontrado.";
            header("Location: ../view/addGalleryEvent.php");
            exit();
        }

        // Insertar en la base de datos
        $sql = "INSERT INTO galeria_eventos (VIDEO, ID_EVENTO) VALUES (?, ?)";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$video, $id]);

            $_SESSION["success_message"] = "Video añadido correctamente a la galería.";
            header("Location: ../view/addGalleryEvent.php");
            exit();
        } catch (PDOException $e) {
            $_SESSION["error_message"] = "Error al guardar en base de datos: " . $e->getMessage();
            header("Location: ../view/addGalleryEvent.php");
            exit();
        }
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
            //echo "Connected successfully";
            return $conn;
        } catch (PDOException $e) {
            echo "Not connected successfully";
            die("Connection failed: " . $e->getMessage());
        }
    }
}

