<?php
include '../conectarsislab.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
    $id = $_POST["id"];

    $sql = "DELETE FROM turnos WHERE idturno = $id";
    if ($db->query($sql) === TRUE) {
        echo "Turno eliminado correctamente";
    } else {
        echo "Error al eliminar: " . $db->error;
    }
    $db->close();
}
