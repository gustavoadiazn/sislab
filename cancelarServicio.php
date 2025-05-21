<?php
// Guardar y cancelar servicio - Identificación del servicio
include 'conectarsislab.php';


$ser = $_GET['ids'];

$sql2 = "SELECT * FROM estudiosxservicio es where servicios_idservicio='$ser'";
$result2 = $db->query($sql2);
while ($row2 = $result2->fetch_array()) {
    $idestudio = $row2["estudios_idestudio"];
    $updestudio = "update estudios set total=total+1 where idestudio='$idestudio'";
    $upd = $db->query($updestudio);

    $borrar2 = "delete from datosxestudiosxservicio where estudiosxServicio_idestudiosxServicio in
    (SELECT idestudiosxServicio FROM estudiosxservicio e where e.servicios_idservicio='$ser' and e.estudios_idestudio='$idestudio');";
    if ($db->query($sql) === TRUE) {
        echo "Estudios x Servicio Cancelados exitosamente";
    } else {
        echo "Error";
    }
}



$sql = "DELETE FROM estudiosxservicio where servicios_idservicio='$ser'";
if ($db->query($sql) === TRUE) {
    echo "Estudios x Servicio Cancelados exitosamente";
} else {
    echo "Error";
}

$sql3 = "DELETE FROM servicios where idservicio='$ser'";
if ($db->query($sql3) === TRUE) {
    echo "Servicio Cancelado exitosamente";
} else {
    echo "Error";
}

$db->close();
?>
<html>

<head>
    <title>Redirigir al navegador a otra URL</title>
    <META HTTP-EQUIV="REFRESH" CONTENT="1;URL=home.php">

</head>

<body>

</body>

</html>