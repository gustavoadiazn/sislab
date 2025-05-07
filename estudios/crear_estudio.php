<?php
include '../conectarsislab.php';

$nombre = $_POST["nombre"];
$costo = $_POST["costo"];
$descrip = $_POST["descrip"];
$total = $_POST["total"];

$sql = "INSERT INTO estudios (nombre, costo, descrip,total) VALUES ('$nombre', $costo, '$descrip', $total)";
if ($db->query($sql) === TRUE) {
    echo "Estudio agregado exitosamente <input type='hidden' id='ultimoIdEstudio' value='" . $db->insert_id . "'>"; // Nuevo ID oculto
} else {
    echo "Error: " . $db->error;
}
$db->close();
