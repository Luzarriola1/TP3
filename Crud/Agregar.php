<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Pelicula</title>
    <link rel="stylesheet"  type="text/css" href="style.css">
</head>
<body>

<?php

include("conexion.php");

if(isset($_POST['enviar'])){
    
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    // Definir la carpeta donde se guardarán las imágenes
    $carpetaImagenes = 'imagenes/'; // Cambia esto por la ruta donde quieras guardar las imágenes

    // Procesa la imagen subida
    if(isset($_FILES['imagen']['name']) && $_FILES['imagen']['name'] != "") {
        $nombreImagen = basename($_FILES['imagen']['name']); // Obtiene el nombre del archivo
        $rutaImagen = $carpetaImagenes . $nombreImagen; // Crea la ruta completa donde se guardará la imagen

        // Mueve el archivo subido a la carpeta deseada
        if(move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen)) {
            // La imagen se ha subido correctamente, ahora puedes guardar la información en la base de datos
            
            $sql = "INSERT INTO Datospeli (Titulo, Descripcion, Imagen) VALUES ('".$nombre."', '".$descripcion."', '".$rutaImagen."')";
            $resultado = mysqli_query($conn, $sql);

            if($resultado) {
                echo "<script language='JavaScript'>
                alert('Los datos fueron ingresados correctamente');
                location.assign('index.php');
                </script>";
            } else {
                echo "<script language='JavaScript'>
                alert('ERROR: Los datos NO fueron ingresados correctamente');
                location.assign('index.php');
                </script>";
            }
        } else {
            echo "Error al mover el archivo subido.";
        }
    } else {
        echo "No se ha seleccionado ninguna imagen.";
    }

    if (isset($conn)) {
        mysqli_close($conn);
    }

} else {
?>


<h1>AGREGAR NUEVA PELICULA</h1>
<form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
    <label>Nombre:</label>
    <input type="text" name="nombre"> <br>
    <label>Descripcion:</label>
    <input type="text" name="descripcion"> <br>
    <label>Imagen:</label>
    <input type="file" name="imagen"> <br> <!-- Campo para seleccionar la imagen -->
    <input type="submit" name="enviar" value="AGREGAR">
    <a href="index.php">Regresar</a>
</form>

<?php
}
?>
    
</body>
</html>