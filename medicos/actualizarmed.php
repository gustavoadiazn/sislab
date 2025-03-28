<?php
include '../conectarsislab.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["idmedico"];
    $nombre = $_POST["nombre"];
    $desc = $_POST["descrip"];

    $sql = "UPDATE medicos SET nombre='$nombre', descrip='$desc' WHERE idmedico=$id";
    if ($db->query($sql) === TRUE) {
        echo "Médico actualizado correctamente";
    } else {
        echo "Error: " . $db->error;
    }
    $db->close();
}
