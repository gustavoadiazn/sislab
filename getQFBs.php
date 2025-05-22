<?php

include("conectarsislab.php");

$busqueda = $_REQUEST["q"];
// DEBO PREPARAR LOS TEXTOS QUE VOY A BUSCAR si la cadena existe
if ($busqueda <> '') {
    //CUENTA EL NUMERO DE PALABRAS
    //SI SOLO HAY UNA PALABRA DE BUSQUEDA SE ESTABLECE UNA INSTRUCION CON LIKE
    $sql = "SELECT * FROM qfbs WHERE nombre LIKE '%$busqueda%' order by idqfb limit 2;";
    $result = $db->query($sql);
?>
    <select name="idqfb" size="2">
        <?php
        if ($row = $result->fetch_array()) {
            $i = 0;
            do {
                $idqfb = $row['idqfb'];
                $nom = utf8_encode($row['nombre']);
                if ($i == 0) {
                    print "<option value='" . $idqfb . "' selected>" . $nom . "</option>";
                    $i++;
                } else {
                    print "<option value='" . $idqfb . "'>" . $nom . "</option>";
                }
            } while ($row = $result->fetch_array());
        } else {
            print "<option value='0-" . $busqueda . "' selected>" . $busqueda . "</option>";
        }
        ?>
    </select>
<?php }
?>