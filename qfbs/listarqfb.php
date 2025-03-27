<?php
include '../conectarsislab.php';

$sql = "SELECT * FROM qfbs";
$result = $db->query($sql);
$tabla = "";

while ($row = $result->fetch_assoc()) {
    $tabla .= "<tr>
                <td>{$row['idqfb']}</td>
                <td>{$row['nombre']}</td>
                <td>{$row['descrip']}</td>                
                <td>                    
                    <button class='btn btn-warning' onclick='mostrarModalEditar({$row['idqfb']})'>Actualizar</button>
                    <button class='btn btn-danger' onclick='eliminarts({$row['idqfb']})'>Quitar</button>
                </td>
               </tr>";
}

echo $tabla;
$db->close();
