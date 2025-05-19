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
<form action="createEvent.php" method="POST">
<button class="submit-btn" type="submit">Create Event</button>
</form>
<form action="addDateEvent.php" method="POST">
<button class="submit-btn" type="submit">Add Date To Event</button>
</form>
<form action="addGalleryEvent.php" method="POST">
<button class="submit-btn" type="submit">Add Image/Video To Event</button>
</form>
<form action="readEvent.php" method="POST">
<button class="submit-btn" type="submit">Read Event</button>
</form>
<form action="updateEvent.php" method="POST">
<button class="submit-btn" type="submit">Update Event</button>
</form>
<form action="deleteEvent.php" method="POST">
<button class="submit-btn" type="submit">Delete Event</button>
</form>
<a href="profileAdmin.php">Salir</a>