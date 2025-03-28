<?php
include '../conectarsislab.php';

$idestudio = $_POST["idestudio"];
$nombre = $_POST["nombre"];
$costo = $_POST["costo"];
$descrip = $_POST["descrip"];

$sql = "UPDATE estudios SET nombre='$nombre', costo=$costo, descrip='$descrip' WHERE idestudio=$idestudio";
if ($db->query($sql) === TRUE) {
    echo "Estudio actualizado exitosamente";
} else {
    echo "Error: " . $conn->error;
}
$db->close();
