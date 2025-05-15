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