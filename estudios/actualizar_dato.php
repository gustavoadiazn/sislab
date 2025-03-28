<?php
include '../conectarsislab.php';

$iddato = $_POST["iddato"];
$nombre = $_POST["nombre"];
$indicadores = $_POST["indicadores"];
$descrip = $_POST["descrip"];

$sql = "UPDATE datos SET nombre='$nombre', indicadores='$indicadores', descrip='$descrip' WHERE iddato=$iddato";
if ($db->query($sql) === TRUE) {
    echo "Dato actualizado exitosamente";
} else {
    echo "Error: " . $db->error;
}
$db->close();
