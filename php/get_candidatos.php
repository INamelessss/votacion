<?php
include 'db.php';

$query = $conn->query('SELECT id, nombre FROM candidatos');
$options = "<option value=''>Seleccione un candidato</option>";

while ($row = $query->fetch_assoc()) {
    $options .= "<option value = '{$row['id']}'>{$row['nombre']}</option>";
}

echo $options;
?>