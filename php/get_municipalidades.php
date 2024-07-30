<?php
include 'db.php';

$provincia_id = $_GET['provincia_id'];
$query = $conn->prepare('SELECT id, nombre FROM municipalidades WHERE provincia_id = ?');
$query->bind_param('i', $provincia_id);
$query->execute();
$result = $query->get_result();

$options = "<option value=''>Seleccione una provincia</option>";
while ($row = $result->fetch_assoc()) {
    $options .= "<option value = '{$row['id']}'>{$row['nombre']}</option>";
}

echo $options;

$query->close();
?>