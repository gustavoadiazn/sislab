<?php
include '../conectarsislab.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $desc = $_POST["descrip"];

    $sql = "INSERT INTO medicos (idmedico,nombre, descrip) VALUES (null,'$nombre', '$desc')";
    if ($db->query($sql) === TRUE) {
        echo "Médico agregado correctamente";
    } else {
        echo "Error: " . $conn->error;
    }
    $db->close();
}
