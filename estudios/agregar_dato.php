<?php
include '../conectarsislab.php';

$nombre = $_POST["nombre"];
$indicadores = $_POST["indicadores"];
$descrip = $_POST["descrip"];
$idestudio = $_POST["idestudio"];

$sql = "INSERT INTO datos (nombre, indicadores, descrip, estudios_idestudio) 
        VALUES ('$nombre', '$indicadores', '$descrip', $idestudio)";

if ($db->query($sql) === TRUE) {
    echo "Dato agregado correctamente";
} else {
    echo "Error: " . $db->error;
}
$db->close();
