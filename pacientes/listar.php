<?php
include '../conectarsislab.php';

$sql = "SELECT * FROM pacientes";
$result = $db->query($sql);
$tabla = "";

while ($row = $result->fetch_assoc()) {
    $tabla .= "<tr>
                <td>{$row['idpaciente']}</td>
                <td>{$row['nombre']}</td>
                <td>{$row['apellidos']}</td>
                <td>{$row['edad']}</td>
                <td>{$row['sexo']}</td>
                <td>{$row['email']}</td>
                <td>{$row['tel']}</td>
                <td>                    
                    <button class='btn btn-warning' onclick='mostrarModalEditar({$row['idpaciente']})'>Actualizar</button>
                    <button class='btn btn-danger' onclick='eliminarPaciente({$row['idpaciente']})'>Quitar</button>
                </td>
               </tr>";
}

echo $tabla;
$db->close();
