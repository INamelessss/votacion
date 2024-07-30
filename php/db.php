<?php
$server = "localhost";
$user = "root";
$password = "";
$db = "votacion";

$conn = new mysqli($server, $user, $password, $db);

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

?>