<?php
include '../conectarsislab.php';

$sql = "SELECT * FROM estudios";
$result = $db->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<option value='{$row["idestudio"]}'>{$row["nombre"]} - {$row["costo"]}</option>";
}
$db->close();
