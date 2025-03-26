<?php
include 'conectarsislab.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["idtipoServicio"];
    $nombre = $_POST["nombre"];
    $desc = $_POST["descrip"];

    $sql = "UPDATE tipoServicios SET nombre='$nombre', descrip='$desc' WHERE idtipoServicio=$id";
    if ($db->query($sql) === TRUE) {
        echo "Tipo de Servicio actualizado correctamente";
    } else {
        echo "Error: " . $db->error;
    }
    $db->close();
}
