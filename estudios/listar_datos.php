<?php
include '../conectarsislab.php';

$idestudio = $_GET['idestudio'];
$sql = "SELECT * FROM datos WHERE estudios_idestudio = $idestudio";
$result = $db->query($sql);

while ($row = $result->fetch_assoc()) {
  echo "<tr>";
  echo "<td>{$row['iddato']}</td>";
  echo "<td>{$row['nombre']}</td>";
  echo "<td>{$row['indicadores']}</td>";
  echo "<td>{$row['descrip']}</td>";
  echo "<td>
            <button class='btn btn-warning' onclick='mostrarModalActualizarDato({$row['iddato']})'>Actualizar</button>
            <button class='btn btn-danger' onclick='eliminarDato({$row['iddato']})'>Eliminar</button>
          </td>";
  echo "</tr>";
}
$db->close();
