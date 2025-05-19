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



<p><?php if (isset($_SESSION["error_message"])) {
        echo $_SESSION["error_message"];
    } ?> </p>
<p><?php if (isset($_SESSION["idevento"])) {
        echo $_SESSION["idevento"];
    } ?> </p>


<div class="form-container">

    <form action="../controller/EventController.php" method="POST" enctype="multipart/form-data">
        <label for="evento-video">Selecciona un evento:</label><br>
        <select name="evento-video" id="evento-img" required>
  <option value="">Elige un evento</option>
  <?php foreach ($eventos as $evento): ?>
    <option value="<?= htmlspecialchars($evento['ID']) ?>">
      <?= htmlspecialchars($evento['NOMBRE']) ?>
    </option>
  <?php endforeach; ?>
</select><br><br>

        <label for="link">LINK YOUTUBE</label><br>
        <input type="text" name="link" id="link" required><br><br>

        <input type="hidden" name="galleryVideo" value="galleryVideo">
        <button class="submit-btn" type="submit">Add YOUTUBE VIDEO</button>
    </form>
</div>
<br>
<a href="eventManager.php">Salir</a>