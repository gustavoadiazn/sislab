<?php

include("conectarsislab.php");

$busqueda = $_REQUEST["q"];
// DEBO PREPARAR LOS TEXTOS QUE VOY A BUSCAR si la cadena existe
if ($busqueda <> '') {
    //CUENTA EL NUMERO DE PALABRAS
    $trozos = explode(" ", $busqueda);
    $numero = count($trozos);
    if ($numero == 1) {
        //SI SOLO HAY UNA PALABRA DE BUSQUEDA SE ESTABLECE UNA INSTRUCION CON LIKE
        $sql = "SELECT * FROM pacientes WHERE apellidos LIKE '%$busqueda%' order by idpaciente LIMIT 15;";
    } elseif ($numero == 2) {
        //SI HAY UNA FRASE SE UTILIZA EL ALGORTIMO DE BUSQUEDA AVANZADO DE MATCH AGAINST
        //busqueda de frases con mas de una palabra y un algoritmo especializado
        $sql = "SELECT * FROM pacientes WHERE apellidos LIKE '%$trozos[0]%' and (apellidos LIKE '%$trozos[1]%' or nombre LIKE '%$trozos[1]%') order by apellidos, nombre LIMIT 15;";
    } elseif ($numero > 2) {
        //SI HAY UNA FRASE SE UTILIZA EL ALGORTIMO DE BUSQUEDA AVANZADO DE MATCH AGAINST
        //busqueda de frases con mas de una palabra y un algoritmo especializado
        $sql = "SELECT * FROM pacientes WHERE apellidos LIKE '%$trozos[0]%$trozos[1]%' and nombre LIKE '%$trozos[2]%' order by apellidos, nombre LIMIT 15;";
    }
?>

    <select name="listbox2" size="15">
        <?php

        $result = $db->query($sql);
        $i = 0;
        if ($row = $result->fetch_array()) {
            do {
                $idpaciente = $row['idpaciente'];
                $nom = $row['apellidos'] . " " . $row['nombre'] . " " . $row['edad'] . " - " . $row['sexo'];
                if ($i == 0) {
                    print "<option value='" . $idpaciente . "' selected>" . $nom . "</option>";
                    $i++;
                } else {
                    print "<option value='" . $idpaciente . "'>" . $nom . "</option>";
                }
            } while ($row = $result->fetch_array());
        } else {
            print "<option value='0' selected>Nuevo</option>";
        }
        ?>
    </select>
<?php }
?>