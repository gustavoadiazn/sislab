<?php
include '../conectarsislab.php';

$sql = "SELECT * FROM medicos";
$result = $db->query($sql);
$tabla = "";

while ($row = $result->fetch_assoc()) {
    $tabla .= "<tr>
                <td>{$row['idmedico']}</td>
                <td>{$row['nombre']}</td>
                <td>{$row['descrip']}</td>                
                <td>                    
                    <button class='btn btn-warning' onclick='mostrarModalEditar({$row['idmedico']})'>Actualizar</button>
                    <button class='btn btn-danger' onclick='eliminarts({$row['idmedico']})'>Quitar</button>
                </td>
               </tr>";
}

echo $tabla;
$db->close();
