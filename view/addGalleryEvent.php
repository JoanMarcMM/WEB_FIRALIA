<?php
require_once '../controller/EventController.php';
$controller = new EventController();
$pdo = $controller->conn();

$eventos = [];

if ($pdo) {
    $stmt = $pdo->query("SELECT NOMBRE FROM eventos ORDER BY NOMBRE ASC");
    $eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<style>
  .form-container {
    display: flex;
    gap: 40px; 
    align-items: flex-start;
  }
  form {
    border: 1px solid #ccc;
    padding: 20px;
    width: 300px;
    box-sizing: border-box;
    border-radius: 6px;
    background-color: #f9f9f9;
  }
  label {
    font-weight: bold;
  }
  .submit-btn {
    margin-top: 10px;
    padding: 8px 12px;
    cursor: pointer;
  }
</style>

<div class="form-container">
  <form action="../controller/EventController.php" method="POST" enctype="multipart/form-data">
    <label for="evento-img">Selecciona un evento:</label><br>
    <select name="evento-img" id="evento-img" required>
      <option value=$evento>Elige un evento</option>
      <?php foreach ($eventos as $evento): ?>
         <option  value="<?= htmlspecialchars($evento['ID']) ?>">
          <?= htmlspecialchars($evento['NOMBRE']) ?>
        </option>
      <?php endforeach; ?>
    </select><br><br>

    <label for="imagen">IMAGEN</label><br>
    <input type="file" name="imagen" id="imagen" required><br><br>

    <input type="hidden" name="galleryImage" value="galleryImage">
    <button class="submit-btn" type="submit">Add IMAGE</button>
  </form>

  <form action="../controller/EventController.php" method="POST" enctype="multipart/form-data">
    <label for="evento-video">Selecciona un evento:</label><br>
    <select name="evento-video" id="evento-video" required>
      <option value="">Elige un evento</option>
      <?php foreach ($eventos as $evento): ?>
        <option  value="<?= htmlspecialchars($evento['ID']) ?>">
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