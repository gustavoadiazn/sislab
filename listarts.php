<?php
include 'conectarsislab.php';

$sql = "SELECT * FROM tipoServicios";
$result = $db->query($sql);
$tabla = "";

while ($row = $result->fetch_assoc()) {
    $tabla .= "<tr>
                <td>{$row['idtipoServicio']}</td>
                <td>{$row['nombre']}</td>
                <td>{$row['descrip']}</td>                
                <td>                    
                    <button class='btn btn-warning' onclick='mostrarModalEditar({$row['idtipoServicio']})'>Actualizar</button>
                    <button class='btn btn-danger' onclick='eliminarts({$row['idtipoServicio']})'>Quitar</button>
                </td>
               </tr>";
}

echo $tabla;
$db->close();
