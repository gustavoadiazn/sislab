<?php
include '../conectarsislab.php';

$nombre = $_POST["nombre"];
$indicadores = $_POST["indicadores"];
$descrip = $_POST["descrip"];
$idestudio = $_POST["idestudio"];

$sql = "INSERT INTO datos (iddato,nombre, indicadores, descrip, estudios_idestudio) VALUES (null,'$nombre', '$indicadores', '$descrip', $idestudio);";
echo $sql;
/*if ($db->query($sql) === TRUE) {
    echo "Dato agregado correctamente".$sql;
} else {
    echo "Error: " . $db->error;
}*/
$db->query($sql);
