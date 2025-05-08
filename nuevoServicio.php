<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Laboratorio - Servicios x Paciente</title>
    <!-- Favicon-->

    <!-- Bootstrap Icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
    <!-- SimpleLightbox plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="styles/styles2.css" rel="stylesheet" />
    <link rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen" />
    <script type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20121025"></script>
    <style>
        /* Add CSS rules for the square border */
        .input-container {
            border: 2px solid #ccc;
            padding: 10px;
            display: inline-block;
            border-radius: 4px;
        }

        .containerCol {
            display: flex;
        }

        .columnCol {
            flex: 1;
            /* Cada columna ocupa la mitad del espacio */
            padding: 10px;
            border: 1px solid #ccc;
        }
    </style>
    <script>
        function asignaSer(str, ser, costo) {
            if (str.length == 0) {
                document.getElementById("txtHint").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("cambios").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "asignaServ.php?q=" + str + "&ser=" + ser + "&cos=" + costo, true);
                xmlhttp.send();
            }
        }

        function showHint(str) {
            if (str.length == 0) {
                document.getElementById("txtHint").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "getMedicos.php?q=" + str, true);
                xmlhttp.send();
            }
        }

        function showHint2(str) {
            if (str.length == 0) {
                document.getElementById("txtHint2").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtHint2").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "getQFBs.php?q=" + str, true);
                xmlhttp.send();
            }
        }
    </script>

</head>

<body id="page-top">
    <!-- Navigation-->
    <div class="container">
        <nav class="navbar navbar-light bg-light">
            <span class="navbar-brand mb-0 h1">
                <h1>Agregar Servicio al Paciente</h1>
            </span>
        </nav>
    </div>

    <?php
    include("conectarsislab.php");
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $idp = $_POST['idp'];
    } else {
        $idp = $_GET['ipd'];
    }
    $fechahoy = date("Y-m-d");

    $sqlins = "Insert into servicios values(null,'$fechahoy','','0',4,1,1,1,$idp)";
    if ($db->query($sqlins) === FALSE) {
        echo "Estudio NO agregado, CUIDADO";
    }

    $sqlser = "SELECT max(idservicio) as ult FROM servicios";
    $resultser = $db->query($sqlser);

    if ($rowser = $resultser->fetch_array()) {
        $ult = $rowser["ult"];
    }

    $sqlserv = "SELECT * FROM servicios where idservicio=$ult";
    $resultserv = $db->query($sqlserv);

    if ($rowserv = $resultserv->fetch_array()) {
        $fecha = $rowserv["fecha"];
        $impcl = $rowserv["impresionClinica"];
        $embar = $rowserv["embarazada"];
        $turno = $rowserv["turnos_idturno"];
        $tipos = $rowserv["tipoServicios_idtipoServicio"];
        $medic = $rowserv["medicos_idmedico"];
        $qfbs = $rowserv["qfbs_idqfb"];
    }

    $sqlp = "SELECT * FROM pacientes where idpaciente=$idp";
    $resultp = $db->query($sqlp);

    if ($rowp = $resultp->fetch_array()) {
        $nomp = $rowp['nombre'];
        $apel = $rowp['apellidos'];
        $sexo = $rowp['sexo'];
        $curp = $rowp['curp'];
    }
    ?>
    <!-- Contact-->
    <section class="page-section" id="contact">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8 col-xl-6 text-center">
                    <h2 class="mt-0">Datos del Paciente: <?php echo $curp; ?></h2>
                </div>
            </div>
            <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
                <div class="col-lg-6">
                    <form id="contactForm" name="form">
                        <!-- Name input-->
                        <div class="containerCol">
                            <div class="columnCol">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="apellidos" name="apellidos" type="text" value="<?php echo $apel; ?>" readonly />
                                    <label for="apellidos">Apellidos</label>
                                </div>
                            </div>
                            <div class="columnCol">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="name1" name="name1" type="text" value="<?php echo $nomp; ?>" readonly />
                                    <label for="name1">Nombre(s)</label>
                                </div>
                            </div>
                        </div>
                        <div class="containerCol">
                            <div class="columnCol">
                                <div class="form-floating mb-3">
                                    Servicio: <?php echo $ult; ?>
                                </div>
                            </div>
                            <div class="columnCol">
                                <div class="form-floating mb-3">
                                    Fecha: <input id="theDate" type="text" readonly onclick="displayCalendar(document.forms[0].theDate,'yyyy-mm-dd',this)" name="theDate" size="10" value="<?php echo $fecha; ?>" />
                                </div>
                            </div>
                            <div class="columnCol">
                                <div class="form-floating mb-3">
                                    Embarazada:
                                    <select name="gen">
                                        <?php
                                        if ($sexo == 'F') {
                                        ?>
                                            <option value="1" <?php if ($embar == TRUE) {
                                                                    echo "selected";
                                                                } ?>>Si</option>
                                            <option value="0" <?php if ($embar == FALSE) {
                                                                    echo "selected";
                                                                } ?>>No</option>
                                        <?php
                                        } else {
                                        ?>
                                            <option value="0" <?php if ($embar == FALSE) {
                                                                    echo "selected";
                                                                } ?>>No Aplica</option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="impclin" name="impclin" rows="4"><?php echo $impcl; ?></textarea>
                            <label for="impclin">Impresión Clínica</label>
                        </div>
                        <div class="containerCol">
                            <div class="columnCol">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="nocon" name="nocon" type="text" onkeyup="showHint(this.value)" size="50" maxlength="50" placeholder="Nombre" required />
                                    <span id="txtHint"></span>
                                    <label for="nocon">Médico tratante</label>
                                </div>
                            </div>
                            <div class="columnCol">
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="nocon2" name="nocon2" type="text" onkeyup="showHint2(this.value)" size="50" maxlength="50" placeholder="Nombre" required />
                                    <span id="txtHint2"></span>
                                    <label for="nocon2">Químico Responsable</label>
                                </div>
                            </div>
                        </div>
                        <hr class="divider" />
                        <div id="cambios">
                            <div class="container">
                                <div class="row align-items-start">
                                    <div class="col">
                                        <h3>Por Asignar</h3> <br>
                                        <table>
                                            <tr>
                                                <th style="size: 70%;">Nombre</th>
                                            </tr>
                                            <?php
                                            $sqlbusca = "SELECT * FROM estudios e where idestudio not in (select estudios_idestudio from estudiosxservicio es where servicios_idservicio='$ult');";
                                            $result2 = $db->query($sqlbusca);
                                            while ($row2 = $result2->fetch_array()) {
                                                $costo = $row2["costo"];
                                            ?>
                                                <tr>
                                                    <td><button class="btn btn-success" type="button" onclick="asignaSer(<?php echo $row2["idestudio"] . ',' . $ult . ',' . $costo; ?>)"><?php echo $row2["nombre"]; ?></button></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </table>
                                    </div>
                                    <div class="col">
                                        <h3>Asignados</h3><br>
                                        <?php
                                        $sqlbusca3 = "SELECT * FROM estudios e where idestudio in (select estudios_idestudio from estudiosxservicio es where servicios_idservicio='$ult');";
                                        $result3 = $db->query($sqlbusca3);

                                        while ($row3 = $result3->fetch_array()) {
                                        ?>
                                            <button class="btn btn-info" type="button" onclick="asignaSer(<?php echo $row3["idestudio"] . ',' . $ult . ',' . $costo; ?>)"><?php echo $row3["nombre"]; ?></button><br><br>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="divider" />
                        <!-- Submit Button-->
                        <div><a class="btn btn-primary btn-xl" id="submitButton" target="_self" name="Guardar" href="home.php" onclick="window.open('imprimirServicio.php', '_blank');">Imprimir</a><a class="btn btn-warning btn-xl" name="Cancel" id="submitButton2" target="_self" href="cancelarServicio.php?ids=<?php echo $ult; ?>">Cancelar</a></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="bg-light py-5">
        <div class="container px-4 px-lg-5">
            <div class="small text-center text-muted">Copyright &copy; 2025 - SISLAB</div>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SimpleLightbox plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
    <!-- Core theme JS-->
</body>

</html>