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
$controller = new EventController();
$pdo = $controller->conn();

$eventos = [];

if ($pdo) {
    $stmt = $pdo->query("SELECT ID, NOMBRE FROM eventos ORDER BY NOMBRE ASC");
    $eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<form action="../controller/EventController.php" method="POST" enctype="multipart/form-data">
   <label for="evento">Selecciona un evento:</label>
<select name="evento" id="evento" required>
    <option value="">Elige un evento</option>
    <?php foreach ($eventos as $evento): ?>
        <option value="<?= htmlspecialchars($evento['ID']) ?>">
            <?= htmlspecialchars($evento['NOMBRE']) ?>
        </option>
    <?php endforeach; ?>
</select><br>

    

    <label for="fecha">FECHA</label><br>
    <input type="date" name="fecha" id="fecha" required><br>

    <label for="hora">HORA</label><br>
    <input type="time" name="hora" id="hora" required><br>

    <label for="ciudad">CIUDAD</label><br>
    <input type="text" name="ciudad" id="ciudad" required><br>

    <label for="localizacion">LOCALIZACIÓN</label><br>
    <input type="text" name="localizacion" id="localizacion" required><br>

    <input type="hidden" name="date" value="date"><br>
    <button class="submit-btn" type="submit">Add Date Event</button>
</form>

<a href="eventManager.php">Salir</a>