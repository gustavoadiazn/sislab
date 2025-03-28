<?php
include '../conectarsislab.php';

$iddato = $_POST["iddato"];
$sql = "DELETE FROM datos WHERE iddato=$iddato";
if ($db->query($sql) === TRUE) {
    echo "Dato eliminado correctamente";
} else {
    echo "Error: " . $db->error;
}
$db->close();
