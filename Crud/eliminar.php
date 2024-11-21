<?php

 $id = $_GET['id'];

 include("conexion.php");

 $sql = "DELETE FROM Datospeli WHERE idPeli='".$id. "'";

 $resultado= mysqli_query($conn, $sql);

 if($resultado){
    
    echo "<script languaje='JavaScript'>
    alert('Los datos se eliminaron correctamente');
    location.assign('index.php');
    </script>";

 }else{

    echo "<script languaje='JavaScript'>
    alert('ERROR= Los datos se eliminaron correctamente');
    location.assign('index.php');
    </script>";
 }




?> 