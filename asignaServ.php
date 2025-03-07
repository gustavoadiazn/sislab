<?php
$data = $_REQUEST["q"];
$data2 = $_REQUEST["ser"];
$data3 = $_REQUEST["cos"];

include("conectarsislab.php");

$sql = "select estudios_idestudio from estudiosxservicio es where servicios_idservicio='$data2' and estudios_idestudio='$data'";
$result = $db->query($sql);
if ($result->num_rows > 0) {
    $borrar = "delete from estudiosxservicio where servicios_idservicio='$data2' and estudios_idestudio='$data'";
    $delete = $db->query($borrar);
    $borrar = "delete from datosxestudiosxservicio where estudiosxServicio_idestudiosxServicio in 
    (SELECT idestudiosxServicio FROM estudiosxservicio e where e.servicios_idservicio='$data2' and e.estudios_idestudio='$data');";
    $delete = $db->query($borrar);
} else {
    $insertar = "insert into estudiosxservicio(idestudiosxServicio,costo,servicios_idservicio,estudios_idestudio) values(null,$data3,$data2,$data)";
    $agregar = $db->query($insertar);
    $insertar2 = "insert into datosxestudiosxservicio SELECT iddato,idestudiosxServicio,'','' FROM estudiosxservicio e,datos d where e.servicios_idservicio='$data2' and e.estudios_idestudio='$data' and e.estudios_idestudio=d.estudios_idestudio;";
    $agregar2 = $db->query($insertar2);
}
?>

<div class="container">
    <div class="row align-items-start">
        <div class="col">
            <h3>Por Asignar</h3> <br>
            <table>
                <tr>
                    <th style="size: 70%;">Nombre</th>
                </tr>
                <?php
                $sqlbusca = "SELECT * FROM estudios e where idestudio not in (select estudios_idestudio from estudiosxservicio es where servicios_idservicio='$data2');";
                $result2 = $db->query($sqlbusca);
                while ($row2 = $result2->fetch_array()) {
                    $costo = $row2["costo"];
                ?>
                    <tr>
                        <td><button class="btn btn-success" type="button" onclick="asignaSer(<?php echo $row2["idestudio"] . ',' . $data2 . ',' . $costo; ?>)"><?php echo $row2["nombre"]; ?></button></td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
        <div class="col">
            <h3>Asignados</h3><br>
            <table>
                <tr>
                    <th style="size: 70%;">Nombre</th>
                    <th>Costo</th>
                </tr>
                <?php
                $sqlbusca3 = "SELECT * FROM estudios e where idestudio in (select estudios_idestudio from estudiosxservicio es where servicios_idservicio='$data2');";
                $result3 = $db->query($sqlbusca3);
                $suma = 0;
                while ($row3 = $result3->fetch_array()) {
                    $costo = $row3["costo"];
                    $suma += $costo;
                ?>
                    <tr>
                        <td><button class="btn btn-info" type="button" onclick="asignaSer(<?php echo $row3["idestudio"] . ',' . $data2 . ',' . $costo; ?>)"><?php echo $row3["nombre"]; ?></button></td>
                        <td><?php echo $costo; ?></td>
                    </tr>
                <?php
                }
                ?>
                <tr>
                    <td style="text-align: right; padding:20px;"> Total </td>
                    <td><?php echo "$ " . number_format($suma, 2); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>