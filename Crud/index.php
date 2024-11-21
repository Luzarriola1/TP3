<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Peliculas</title>
    <script type="text/javascript">
        function confirmar(){
            return confirm('¿Estas seguro de eliminar los datos?');
        }
    </script>

    <link rel="stylesheet"  type="text/css" href="style.css">
</head>
<body>

<?php

include("conexion.php");
$sql="select * from Datospeli";
$resultado=mysqli_query($conn, $sql);

?>

<h1>LISTA DE PELICULAS</h1>

<a href="Agregar.php">Nueva Pelicula</a><br><br>

<table>
<thead>
    <tr>
        <th>ID</th>
        <th>Titulo</th>
        <th>Descripcion</th>
        <th>Imagen</th>

        <th>Acciones</th>

    </tr>
</thead>


<tbody>

    <?php

    while($filas =mysqli_fetch_assoc($resultado)){
        //var_dump($filas); // Esto mostrará los datos en la página

    ?>

<tr>

    <td><?php echo $filas['idPeli'] ?></td>
    <td><?php echo $filas['Titulo'] ?></td>
    <td><?php echo $filas['Descripcion'] ?></td>
    <!--<td><?php echo $filas['Imagen'] ?></td> --> 
    <td><img src="<?php echo $filas['Imagen']; ?>" alt="Imagen de la película" style="width: 100px; height: auto;"></td>

    <td>
    <?php echo "<a href='editar.php?id=".$filas['idPeli']."'>EDITAR</a>"; ?> -
    <?php echo "<a href='eliminar.php?id=".$filas['idPeli']."' onclick='return confirmar()'>ELIMINAR</a>"; ?>
    </td>
        

   

</tr>

<?php
}
?>



</tbody>


</table>

<?php
mysqli_close($conn);
?>
    
</body>
</html>