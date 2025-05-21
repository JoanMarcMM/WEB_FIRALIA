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
<form action="../controller/EventController.php" method="POST" enctype="multipart/form-data">
    <label for="nombre">NOMBRE</label><br>
    <input type="text" name="nombre" id="nombre" required><br>

    <label for="main_image">MAIN_IMAGE</label><br>
    <input type="file" name="main_image" id="main_image" required><br>

    <label for="text1">TEXT1</label><br>
    <textarea name="text1" id="text1" rows="10" cols="50"></textarea><br>

    <label for="image_text">IMAGE_TEXT</label><br>
    <input type="file" name="image_text" id="image_text" required><br>

    <input type="hidden" name="create" value="create"><br>
    <button class="submit-btn" type="submit">Create Event</button>
</form>

<a href="eventManager.php">Salir</a>