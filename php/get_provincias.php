<?php
include 'db.php';

$query = $conn->query('SELECT id, nombre FROM provincias');
$options = "<option value=''>Seleccione una provincia</option>";

while ($row = $query->fetch_assoc()) {
    $options .= "<option value = '{$row['id']}'>{$row['nombre']}</option>";
}
echo $options;
?>