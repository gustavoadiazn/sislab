<?php
include '../conectarsislab.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["idturno"];
    $nombre = $_POST["nombre"];
    $desc = $_POST["descrip"];

    $sql = "UPDATE turnos SET nombre='$nombre', descrip='$desc' WHERE idturno=$id";
    if ($db->query($sql) === TRUE) {
        echo "Turno actualizado correctamente";
    } else {
        echo "Error: " . $db->error;
    }
    $db->close();
}
