<?php
include 'conectarsislab.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha = $_POST["theDate"];
    $gen = $_POST["gen"];
    $impclin = $_POST["impclin"];
    $nocon = $_POST["nocon"];
    $nocon2 = $_POST["nocon2"];

    $sql = "update servicios set fecha='$fecha', gen='$gen', impclin='$impclin', nocon='$nocon', nocon2='$nocon2' where idservicio=$ids";
    if ($db->query($sql) === TRUE) {
        echo "Servicio actualizado exitosamente";
    } else {
        echo "Error: " . $conn->error;
    }


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
    <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=home.php">

</head>

<body>
Listo
</body>

</html>