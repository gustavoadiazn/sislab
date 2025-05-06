<?php
include '../conectarsislab.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["idpaciente"];
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $edad = $_POST["edad"];
    $curp = $_POST["curp"];
    $sexo = $_POST["sexo"];
    $email = $_POST["email"];
    $tel = $_POST["tel"];

    $sql = "UPDATE pacientes SET nombre='$nombre', apellidos='$apellidos', edad=$edad, curp='$curp', sexo='$sexo', email='$email', tel='$tel' WHERE idpaciente=$id";
    if ($db->query($sql) === TRUE) {
        echo "Paciente actualizado correctamente";
    } else {
        echo "Error: " . $db->error;
    }
    $db->close();
}
