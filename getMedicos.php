<?php

include("conectarsislab.php");

$busqueda = $_REQUEST["q"];
// DEBO PREPARAR LOS TEXTOS QUE VOY A BUSCAR si la cadena existe
if ($busqueda <> '') {
    //CUENTA EL NUMERO DE PALABRAS
    //SI SOLO HAY UNA PALABRA DE BUSQUEDA SE ESTABLECE UNA INSTRUCION CON LIKE
    $sql = "SELECT * FROM medicos WHERE nombre LIKE '%$busqueda%' order by idmedico limit 2;";
    $result = $db->query($sql);
?>
    <select name="idmedico" size="2">
        <?php
        if ($row = $result->fetch_array()) {
            $i = 0;
            do {
                $idmedico = $row['idmedico'];
                $nom = utf8_encode($row['nombre']);
                if ($i == 0) {
                    print "<option value='" . $idmedico . "' selected>" . $nom . "</option>";
                    $i++;
                } else {
                    print "<option value='" . $idmedico . "'>" . $nom . "</option>";
                }
            } while ($row = $result->fetch_array());
        } else {
            print "<option value='0-" . $busqueda . "' selected>" . $busqueda . "</option>";
        }
        ?>
    </select>
<?php }
?>