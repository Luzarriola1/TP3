<?php
include("conexion.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Peliculas</title>
    <link rel="stylesheet"  type="text/css" href="style.css">
</head>
<body>


<?php
include("conexion.php");

if(isset($_POST['enviar'])){
    // Recibir los datos del formulario
    $id = $_POST['idPeli'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    // Definir la carpeta donde se guardarán las imágenes
    $carpetaImagenes = 'imagenes/';

    // Procesar la imagen si se ha subido una nueva
    if(isset($_FILES['imagen']['name']) && $_FILES['imagen']['name'] != "") {
        $nombreImagen = basename($_FILES['imagen']['name']);
        $rutaImagen = $carpetaImagenes . $nombreImagen;

        // Mover la nueva imagen a la carpeta
        if(move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen)) {
            // Actualizar todos los campos, incluyendo la nueva imagen
            $sql = "UPDATE Datospeli SET Titulo='".$nombre."', Descripcion='".$descripcion."', Imagen='".$rutaImagen."' WHERE idPeli='".$id."'";
        } else {
            echo "<script language='JavaScript'>
            alert('Error al subir la imagen.');
            location.assign('index.php');
            </script>";
            exit;
        }
    } else {
        // Si no se sube una nueva imagen, solo actualizar título y descripción
        $sql = "UPDATE Datospeli SET Titulo='".$nombre."', Descripcion='".$descripcion."' WHERE idPeli='".$id."'";
    }

    $resultado = mysqli_query($conn, $sql);

    if($resultado){
        echo "<script language='JavaScript'>
        alert('Los datos se actualizaron correctamente');
        location.assign('index.php');
        </script>";
    } else {
        echo "<script language='JavaScript'>
        alert('ERROR: Los datos NO se actualizaron correctamente');
        location.assign('index.php');
        </script>";
    }

    mysqli_close($conn);

} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM Datospeli WHERE idPeli='".$id."'";
    $resultado = mysqli_query($conn, $sql);
    $fila = mysqli_fetch_assoc($resultado);
    $nombre = $fila["Titulo"];
    $descripcion = $fila["Descripcion"];
    $imagenActual = $fila["Imagen"];
    mysqli_close($conn);
?>

<h1>EDITAR PELICULA</h1>
<form action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?php echo $nombre;?>"> <br>
    <label>Descripcion:</label>
    <input type="text" name="descripcion" value="<?php echo $descripcion;?>"> <br>
    <label>Imagen Actual:</label><br>
    <img src="<?php echo $imagenActual; ?>" alt="Imagen de la película" style="width: 100px; height: auto;"><br>
    <label>Nueva Imagen (opcional):</label>
    <input type="file" name="imagen"> <br>
    <input type="hidden" name="idPeli" value="<?php echo $id; ?>">
    <input type="submit" name="enviar" value="ACTUALIZAR">
    <a href="index.php">Regresar</a>
</form>

<?php
}
?>



</body>
</html>

