<?php
//https://phppot.com/php/php-upload-image-to-database/
//https://www.youtube.com/watch?v=5L9UhOnuos0&t=801s
//Credenciales que usaremos para entrar en la bbdd

$host ="localhost";
$dbname = "firalia";
$username = "root"; //IMPORTANTE CAMBIAR , NO QUEREMOS ENTRAR CON ROOT
$password = "";

//Objeto mysqli

$mysqli = new mysqli($host, $username, $password, $dbname);

//Si error, devolver mensaje

if ($mysqli->connect_errno){

    die("Connection error: " . $mysqli->connect_error);

}

/* Comprueba si la imagen esta subida

if(isset($_FILES["user_image"]) && $_FILES["user_image"]["error"] == 0){
    $user_image = $_FILES['user_image']['tmp_name'];
    $imgContent = file_get_contents($user_image);


// Introduce la imagen en la base de datos como blob
$sql = "INSERT INTO USERS(user_image) VALUES(?)";
$statement = $mysqli ->prepare($sql);
$statement->bind_param('s', $imgContent);
$current_id =$statement->execute() or die ("<br>Error:</b> Problema al insertar la imagen <br/>" . mysqli_connect_error());

    if ($current_id){
     echo "Imagen subida correctamente.";
    } else{
        echo "Error al subir la imagen, intentelo de nuevo";
    }
}else {
    echo "Seleccione una imagen que subir.";

}

// Mostrar la imagen subida

$result = $mysqli->query("Select user_image FROM USERS ORDER BY USER DESC LIMIT 1 ");

if($result && $result -> num_rows > 0){
    $row = $result->fetch_assoc();
    $imageData = $row['user_image'];
    echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" alt="Imagen subida" style="max-width: 500px;">';
} else{
    echo 'todavia no hay ninguna imagen subida.';
}
    */


return $mysqli;
?>