<?php
include '../conectarsislab.php';

$sql = "SELECT * FROM estudios";
$result = $db->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<tr onclick='cargarDatos({$row["idestudio"]})'>";
    echo "<td>{$row["idestudio"]}</td>";
    echo "<td>{$row["nombre"]}</td>";
    echo "<td>{$row["costo"]}</td>";
    echo "<td>{$row["descrip"]}</td>";
    echo "<td>
            <button class='btn btn-warning' onclick='mostrarModalEditarEstudio({$row["idestudio"]})'>Actualizar</button>
            <button class='btn btn-danger' onclick='eliminarEstudio({$row["idestudio"]})'>Eliminar</button>
          </td>";
    echo "</tr>";
}
$conn->close();
