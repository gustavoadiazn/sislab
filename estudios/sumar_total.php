<?php
include '../conectarsislab.php';

$idestudio = $_POST["idestudio"];
$total = $_POST["cantidad"];
$sql = "UPDATE estudios SET total=total+$total WHERE idestudio=$idestudio";
if ($db->query($sql) === TRUE) {
    echo "Estudio actualizado exitosamente";
} else {
    echo "Error: " . $conn->error;
}
$db->close();
