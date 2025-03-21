<?php

session_start();

session_destroy();
// Verifica si las cabeceras no han sido enviadas antes de la redirección
if (!headers_sent()) {
    header("Location: ../view/index.php"); // Redirige al archivo index.php dentro de la carpeta view
    exit; // Termina la ejecución del script después de la redirección
} else {
    echo "Error: Las cabeceras ya han sido enviadas. No se puede redirigir.";
}

header("Location: ../view/index.php");
exit;

?>