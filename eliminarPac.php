<?php
include 'conectarsislab.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];

    $sql = "DELETE FROM pacientes WHERE idpaciente = $id";
    if ($db->query($sql) === TRUE) {
        echo "Paciente eliminado correctamente";
    } else {
        echo "Error al eliminar: " . $db->error;
    }
    $db->close();
}
