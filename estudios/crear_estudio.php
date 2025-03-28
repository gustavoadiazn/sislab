<?php
include '../conectarsislab.php';

$nombre = $_POST["nombre"];
$costo = $_POST["costo"];
$descrip = $_POST["descrip"];

$sql = "INSERT INTO estudios (nombre, costo, descrip) VALUES ('$nombre', $costo, '$descrip')";
if ($db->query($sql) === TRUE) {
    echo "Estudio agregado exitosamente";
} else {
    echo "Error: " . $db->error;
}
$conn->close();
