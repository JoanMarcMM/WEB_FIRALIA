<?php
require_once '../controller/eventController.php';

$eventController = new EventController();

// Llamar a ReadEvent si no hay eventos en sesión
if (!isset($_SESSION['eventos']) || empty($_SESSION['eventos'])) {
    $eventController->ReadEvent();
}

$eventos = $_SESSION['eventos'] ?? [];
unset($_SESSION['eventos']); // Limpiar después de usar
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Evento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .event-card {
            transition: transform 0.3s;
            cursor: pointer;
        }
        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <h1 class="text-center mb-5">Selecciona un Evento</h1>
        
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="alert alert-danger"><?= $_SESSION['error_message'] ?></div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>
        
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($eventos as $evento): ?>
            <div class="col">
                <form action="event.php" method="post" class="h-100">
                    <input type="hidden" name="nombre_evento" value="<?= htmlspecialchars($evento['NOMBRE']) ?>">
                    <div class="card event-card h-100" onclick="this.closest('form').submit()">
                        <img src="../view/<?= $evento['MAIN_IMAGE_PATH'] ?>" class="card-img-top" alt="<?= htmlspecialchars($evento['NOMBRE']) ?>">
                        <div class="card-body">
                            <h5 class="card-title text-center"><?= htmlspecialchars($evento['NOMBRE']) ?></h5>
                        </div>
                    </div>
                </form>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>