<?php
include '../conectarsislab.php';

$iddato = $_GET['iddato'];
$sql = "SELECT * FROM datos WHERE iddato = $iddato";
$result = $db->query($sql);

if ($row = $result->fetch_assoc()) {
    echo json_encode($row);
} else {
    echo json_encode([]);
}
$db->close();
