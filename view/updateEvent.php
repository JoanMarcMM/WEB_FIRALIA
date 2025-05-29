<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>

    <!-- Google Fonts -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=arrow_forward" />

    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Archivos CSS, hemos puesto class less css pq es una parte que solo accedera la gente de la empresa -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">

</head>
<?php
require_once '../controller/EventController.php';

$pdo = (new EventController())->conn();

if (!isset($_GET['id'])) {
    $stmt = $pdo->query("SELECT ID, NOMBRE FROM eventos");
    $eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <h2>Selecciona un evento para editar:</h2>
    <form method="GET" action="updateEvent.php">
        <label for="id">Evento:</label>
        <select name="id" id="id" required>
            <option value="">-- Selecciona --</option>
            <?php foreach ($eventos as $evento): ?>
                <option value="<?php echo $evento['ID']; ?>">
                    <?php echo htmlspecialchars($evento['NOMBRE']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Cargar Evento</button>
    </form>

    <?php
    exit(); // No continúa si aún no se ha elegido evento
}
?>
<?php
// Ya hay ID, cargar datos del evento
$id = $_GET['id'];
echo "<pre>DEBUG: ID recibido = $id</pre>";
$stmt = $pdo->prepare("SELECT * FROM eventos WHERE ID = ?");
$stmt->execute([$id]);
$evento = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$evento) {
    echo "Evento no encontrado.";
    exit;
}
?>

<h2>Editando Evento: <?php echo htmlspecialchars($evento['NOMBRE']); ?></h2>

<form action="../controller/EventController.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="update" value="update">
    <input type="hidden" name="id" value="<?php echo $evento['ID']; ?>">

    <label for="nombre">NOMBRE</label><br>
    <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($evento['NOMBRE']); ?>"
        required><br>

    <label for="main_image">MAIN_IMAGE (dejar vacío para mantener actual)</label><br>
    <input type="file" name="main_image" id="main_image"><br>
    <?php if (!empty($evento['MAIN_IMAGE_PATH'])): ?>
        <img src="../view/<?php echo $evento['MAIN_IMAGE_PATH']; ?>" width="150"><br>
    <?php endif; ?>

    <label for="text1">TEXT1</label><br>
    <textarea name="text1" id="text1" rows="10" cols="50"><?php echo html_entity_decode($evento['TEXT1']); ?></textarea>
    <br>

    <label for="image_text">IMAGE_TEXT (dejar vacío para mantener actual)</label><br>
    <input type="file" name="image_text" id="image_text"><br>
    <?php if (!empty($evento['IMAGE_TEXT_PATH'])): ?>
        <img src="../view/<?php echo $evento['IMAGE_TEXT_PATH']; ?>" width="150"><br>
    <?php endif; ?>

    <button class="submit-btn" type="submit">Actualizar Evento</button>
</form>
<a href="eventManager.php"><button>Salir</button></a>