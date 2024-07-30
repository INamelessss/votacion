<?php
include 'db.php';

function validarDNI($dni)
{
    return preg_match('/^[0-9]{8}$/', $dni);
}

$nombre = $_POST['nombre'];
$alias = $_POST['alias'];
$dni = $_POST['dni'];
$email = $_POST['email'];
$provincia = $_POST['provincia'];
$municipalidad = $_POST['municipalidad'];
$candidato = $_POST['candidato'];
$medio = implode(", ", $_POST['medio']);

$validaciones = [
    'El nombre no puede estar vacío.' => empty($nombre),
    'El nombre no puede contener solo espacios.' => ctype_space($nombre),
    'El alias no puede estar vacío.' => empty($alias),
    'El alias debe contener más de 5 caracteres.' => strlen($alias) <= 5,
    'El alias debe contener al menos una letra.' => !preg_match('/[a-zA-Z]/', $alias),
    'El alias debe contener al menos un número.' => !preg_match('/[0-9]/', $alias),
    'El DNI no es válido. Debe contener 8 dígitos.' => !validarDNI($dni),
    'El correo electrónico no es válido.' => !filter_var($email, FILTER_VALIDATE_EMAIL),
];

foreach ($validaciones as $message => $condition) {
    if ($condition) {
        echo $message;
        exit;
    }
}

$query = $conn->prepare('SELECT COUNT(*) FROM votos WHERE dni = ?');
$query->bind_param('s', $dni);
$query->execute();
$query->bind_result($count);
$query->fetch();
$query->close();

if ($count > 0) {
    echo 'Solo puede realizarse un voto por persona, ingrese otro DNI';
    exit;
}

$query = $conn->prepare('INSERT INTO votos (nombre, alias, dni, email, medio, provincia_id, municipalidad_id, candidato_id) VALUES (?,?,?,?,?,?,?,?)');
$query->bind_param('sssssiii', $nombre, $alias, $dni, $email, $medio, $provincia, $municipalidad, $candidato);

if ($query->execute()) {
    echo 'Votación realizada correctamente.';
} else {
    echo 'Error al realizar la votación.';
}

$query->close();
$conn->close();
?>