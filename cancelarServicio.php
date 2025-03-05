<?php
// Guardar y cancelar servicio - Identificación del servicio
include 'conectarsislab.php';


$ser = $_GET['ids'];
$sql = "DELETE FROM estudiosxservicio where servicios_idservicio='$ser'";
if ($db->query($sql) === TRUE) {
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