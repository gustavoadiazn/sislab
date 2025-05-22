<?php
include 'conectarsislab.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo $fecha = $_POST["theDate"];
    echo $gen = $_POST["gen"];
    echo $impclin = $_POST["impclin"];
    echo $nocon = $_POST["idmedico"];
    echo $nocon2 = $_POST["idqfb"];
    echo $ids = $_POST["ids"];

    $sql = "update servicios set fecha='$fecha', embarazada='$gen', impresionClinica='$impclin', medicos_idmedico='$nocon', qfbs_idqfb='$nocon2' where idservicio=$ids";
    if ($db->query($sql) === TRUE) {
        echo "Servicio actualizado exitosamente";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<html>

<head>
    <title>Redirigir al navegador a otra URL</title>
    <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=home.php">

</head>

<body>

</body>

</html>