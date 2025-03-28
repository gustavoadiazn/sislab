<?php
include '../conectarsislab.php';

$sql = "SELECT * FROM turnos";
$result = $db->query($sql);
$tabla = "";

while ($row = $result->fetch_assoc()) {
    $tabla .= "<tr>
                <td>{$row['idturno']}</td>
                <td>{$row['nombre']}</td>
                <td>{$row['descrip']}</td>                
                <td>                    
                    <button class='btn btn-warning' onclick='mostrarModalEditar({$row['idturno']})'>Actualizar</button>
                    <button class='btn btn-danger' onclick='eliminarts({$row['idturno']})'>Quitar</button>
                </td>
               </tr>";
}

echo $tabla;
$db->close();
