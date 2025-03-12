<?php
include 'conectarsislab.php'; // Conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ids = $_POST["ids"] ?? "";
    $sqlest = "Select * from estudios where idestudio in (select estudios_idestudio from estudiosxservicio where servicios_idservicio='$ids');";
    $resultest = $db->query($sqlest);
    if ($rowest = $resultest->fetch_array()) {
        do {
            $idest = $rowest['idestudio'];
            $sqldat = "select * from datosxestudiosxservicio des where estudiosxServicio_idestudiosxServicio in
                                            (select idestudiosxServicio from estudiosxservicio where servicios_idservicio='$ids' and estudios_idestudio='$idest');";
            $resultdat = $db->query($sqldat);
            if ($rowdat = $resultdat->fetch_array()) {
                do {
                    $iddat = $rowdat['datos_iddato'];
                    $idestxser = $rowdat['estudiosxServicio_idestudiosxServicio'];
                    $dat = "dat" . $iddat;
                    $datoRecibido = $_POST[$dat];
                    $obsRecibido = $_POST["obs" . $iddat];
                    $sqlupdate = "UPDATE datosxestudiosxservicio SET dato='" . $datoRecibido . "', observaciones='" . $obsRecibido . "' WHERE estudiosxServicio_idestudiosxServicio='$idestxser' and datos_iddato='$iddat';";

                    if ($db->query($sqlupdate) === FALSE) {
                        echo "Error: " . $db->error;
                    }
                } while ($rowdat = $resultdat->fetch_array());
            }
        } while ($rowest = $resultest->fetch_array());
    }
    echo "Datos guardados exitosamente";
    $db->close();
}
