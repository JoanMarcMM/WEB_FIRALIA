 <?php

    require_once '../controller/EventController.php';

    if (isset($_SESSION['success_message']) && $_SESSION['success_message'] !== 'Evento eliminado correctamente.') {
    unset($_SESSION['success_message']);
}

    $eventController = new EventController();
    $eventos = $eventController->GetEventsForDeletion();
    ?>

 <!DOCTYPE html>
 <html lang="es">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Eliminar Evento</title>
   <!-- Css utilizado de ChatGPT -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
     <style>
         .confirmation-modal {
             display: none;
             position: fixed;
             top: 0;
             left: 0;
             width: 100%;
             height: 100%;
             background-color: rgba(0, 0, 0, 0.5);
             z-index: 1000;
             justify-content: center;
             align-items: center;
         }

         .confirmation-content {
             background: white;
             padding: 20px;
             border-radius: 5px;
             max-width: 500px;
             width: 90%;
         }
     </style>
 </head>

 <body>
     <div class="container mt-5">
         <h2 class="mb-4">Eliminar Evento</h2>

         <?php if (isset($_SESSION['error_message'])): ?>
             <div class="alert alert-danger alert-dismissible fade show">
                 <?= $_SESSION['error_message']; ?>
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             </div>
             <?php unset($_SESSION['error_message']); ?>
         <?php endif; ?>

         <?php if (isset($_SESSION['success_message'])): ?>
             <div class="alert alert-success alert-dismissible fade show">
                 <?= $_SESSION['success_message']; ?>
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             </div>
             <?php unset($_SESSION['success_message']); ?>
         <?php endif; ?>

         <div class="card shadow">
             <div class="card-body">
                 <form id="deleteForm" method="POST" action="../controller/EventController.php">
                     <div class="mb-3">
                         <label for="eventSelect" class="form-label">Seleccione el evento a eliminar:</label>
                         <select class="form-select" id="eventSelect" name="id" required>
                             <option value="">-- Seleccione un evento --</option>
                             <?php foreach ($eventos as $evento): ?>
                                 <option value="<?= htmlspecialchars($evento['ID']) ?>">
                                     <?= htmlspecialchars($evento['NOMBRE']) ?>
                                 </option>
                             <?php endforeach; ?>
                         </select>
                     </div>
                     <button type="button" id="deleteBtn" class="btn btn-danger">Eliminar Evento</button>
                     <a href="../view/eventManager.php" class="btn btn-secondary">Volver al Panel</a>
                     <input type="hidden" name="delete" value="1">
                 </form>
             </div>
         </div>
     </div>

     <!-- Modal de confirmación -->
     <div id="confirmationModal" class="confirmation-modal">
         <div class="confirmation-content">
             <h4>¿Estás seguro de que quieres eliminar este evento?</h4>
             <p class="my-3">Esta acción eliminará permanentemente el evento y todos sus datos asociados.</p>
             <div class="d-flex justify-content-end gap-2">
                 <button id="confirmCancel" class="btn btn-secondary">Cancelar</button>
                 <button id="confirmDelete" class="btn btn-danger">Eliminar</button>
             </div>
         </div>
     </div>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
     <script>
         document.addEventListener('DOMContentLoaded', function() {
             const deleteBtn = document.getElementById('deleteBtn');
             const confirmationModal = document.getElementById('confirmationModal');
             const confirmDelete = document.getElementById('confirmDelete');
             const confirmCancel = document.getElementById('confirmCancel');
             const deleteForm = document.getElementById('deleteForm');
             const eventSelect = document.getElementById('eventSelect');

             deleteBtn.addEventListener('click', function() {
                 if (eventSelect.value === "") {
                     alert("Por favor, selecciona un evento");
                     return;
                 }

                 confirmationModal.style.display = 'flex';
             });

             confirmCancel.addEventListener('click', function() {
                 confirmationModal.style.display = 'none';
             });

             confirmDelete.addEventListener('click', function() {
                 deleteForm.submit();
             });

             // Cerrar modal haciendo click fuera del contenido
             confirmationModal.addEventListener('click', function(e) {
                 if (e.target === confirmationModal) {
                     confirmationModal.style.display = 'none';
                 }
             });
         });
     </script>
 </body>

 </html>