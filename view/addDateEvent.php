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