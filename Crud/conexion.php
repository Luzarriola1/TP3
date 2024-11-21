<?php
$servername = "mysql-luzarriola.alwaysdata.net";
$username = "383186"; // Tu usuario de MySQL
$password = "004364689000"; // Tu contraseña de MySQL, deja en blanco si no tienes
$dbname = "luzarriola_bluecinema";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

?> 