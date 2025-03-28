<?php
include '../conectarsislab.php';

$idestudio = $_GET['idestudio'];
$sql = "SELECT * FROM estudios WHERE idestudio = $idestudio";
$result = $db->query($sql);

if ($row = $result->fetch_assoc()) {
    echo json_encode($row);
} else {
    echo json_encode([]);
}
$db->close();
