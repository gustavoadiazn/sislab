<?php
include 'conectarsislab.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $edad = $_POST["edad"];
    $sexo = $_POST["sexo"];

    $sql = "INSERT INTO pacientes (idpacientes,nombre, apellidos, edad, sexo) VALUES (null,'$nombre', '$apellidos', $edad, '$sexo')";
    if ($db->query($sql) === TRUE) {
        echo "Paciente agregado correctamente";
    } else {
        echo "Error: " . $conn->error;
    }
    $db->close();
}
