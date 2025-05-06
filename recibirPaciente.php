<?php
// agregar_paciente.php - Inserción de pacientes
include 'conectarsislab.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['name1'];
    $apellidos = $_POST['apellidos'];
    $edad = $_POST['edad'];
    $curp = $_POST['curp'];
    $sexo = $_POST['sexo'];
    $email = $_POST['email1'];
    $tel = $_POST['phone1'];

    $sql = "INSERT INTO pacientes (nombre, apellidos, edad, sexo, email, tel, curp) VALUES ('$nombre', '$apellidos', $edad, '$sexo', '$email', '$tel', '$curp')";
    if ($db->query($sql) === TRUE) {
        echo "Paciente agregado exitosamente";
    } else {
        echo "Error: " . $db->error;
    }
    $sqlr = "select max(idpaciente) as ultimo from pacientes;";
    $result = $db->query($sqlr);
    if ($row = $result->fetch_array()) {
        $ult = $row["ultimo"];
    }
}
$db->close();
?>
<html>

<head>
    <title>Redirigir al navegador a otra URL</title>
    <META HTTP-EQUIV="REFRESH" CONTENT="0;URL=nuevoServicio.php?ipd=<?php echo $ult; ?>">
</head>

<body>

</body>

</html>