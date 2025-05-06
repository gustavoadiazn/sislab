<?php
include '../conectarsislab.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $edad = $_POST["edad"];
    $curp = $_POST["curp"];
    $sexo = $_POST["sexo"];
    $email = $_POST["email"];
    $tel = $_POST["tel"];

    $sql = "INSERT INTO pacientes (idpaciente,nombre, apellidos, edad, sexo, email, tel, curp) VALUES (null,'$nombre', '$apellidos', $edad, '$sexo', '$email', '$tel', '$curp')";
    if ($db->query($sql) === TRUE) {
        echo "Paciente agregado correctamente";
    } else {
        echo "Error: " . $conn->error;
    }
    $db->close();
}
