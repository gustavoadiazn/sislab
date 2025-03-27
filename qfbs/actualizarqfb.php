<?php
include '../conectarsislab.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["idqfb"];
    $nombre = $_POST["nombre"];
    $desc = $_POST["descrip"];

    $sql = "UPDATE qfbs SET nombre='$nombre', descrip='$desc' WHERE idqfb=$id";
    if ($db->query($sql) === TRUE) {
        echo "QFB actualizado correctamente";
    } else {
        echo "Error: " . $db->error;
    }
    $db->close();
}
