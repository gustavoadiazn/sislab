<?php
include '../conectarsislab.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $desc = $_POST["descrip"];

    $sql = "INSERT INTO turnos (idturno,nombre, descrip) VALUES (null,'$nombre', '$desc')";
    if ($db->query($sql) === TRUE) {
        echo "Turno agregado correctamente";
    } else {
        echo "Error: " . $conn->error;
    }
    $db->close();
}
