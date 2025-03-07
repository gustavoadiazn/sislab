<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Laboratorio - Datos</title>
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
    <link rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
    </link>
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
        // Función para guardar los datos de todos los formularios

        function guardarFormulario(event, formId) {
            event.preventDefault(); // Evita el envío normal
            const formData = new FormData(document.getElementById(formId));

            fetch('guardarDatos.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => alert(data))
                .catch(error => console.error('Error:', error));
        }
    </script>
</head>

<body id="page-top">
    <!-- Navigation-->
    <div class="container">
        <nav class="navbar navbar-light bg-light">
            <span class="navbar-brand mb-0 h1">
                <h1>Agregar Datos a cada Estudio del Servicio al Paciente</h1>
            </span>
        </nav>
    </div>

    <?php
    include("conectarsislab.php");
    $ids = $_GET["id"];

    $sqlserv = "SELECT * FROM servicios where idservicio=$ids";
    $resultserv = $db->query($sqlserv);

    if ($rowserv = $resultserv->fetch_array()) {
        $fecha = $rowserv["fecha"];
        $impcl = $rowserv["impresionClinica"];
        $idp = $rowserv["pacientes_idpaciente"];
    }

    $sqlp = "SELECT * FROM pacientes where idpaciente=$idp";
    $resultp = $db->query($sqlp);

    if ($rowp = $resultp->fetch_array()) {
        $nomp = utf8_encode($rowp['nombre']);
        $apel = utf8_encode($rowp['apellidos']);
        $sexo = $rowp['sexo'];
    }
    ?>
    <!-- Contact-->
    <section class="page-section" id="contact">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8 col-xl-6 text-center">
                    <h2 class="mt-0">Datos del Paciente</h2>
                </div>
            </div>
            <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
                <div class="col-lg-6">
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
                                Servicio: <?php echo $ids; ?>
                            </div>
                        </div>
                        <div class="columnCol">
                            <div class="form-floating mb-3">
                                Fecha: <?php echo $fecha; ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="impclin" name="impclin" rows="4" disabled><?php echo $impcl; ?></textarea>
                        <label for="impclin">Impresión Clínica</label>
                    </div>
                    <hr class="divider" />
                    <div class="container my-5">
                        <form id="formDat" onsubmit="guardarFormulario(event, 'formDat')">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <?php
                                $sqlest = "Select * from estudios where idestudio in (select estudios_idestudio from estudiosxservicio where servicios_idservicio='$ids');";
                                $resultest = $db->query($sqlest);
                                if ($rowest = $resultest->fetch_array()) {
                                    $i = 0;
                                    do {
                                        $idest = $rowest['idestudio'];
                                        $nomest = utf8_encode($rowest['nombre']);
                                ?>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link <?php if ($i == 0) { ?>active<?php } ?>" id="Est<?php echo $idest; ?>-tab" data-bs-toggle="tab" data-bs-target="#Est<?php echo $idest; ?>" type="button" role="tab" aria-controls="<?php echo $idest; ?>" aria-selected="<?php if ($i == 0) { ?>true<?php $i++;
                                                                                                                                                                                                                                                                                                                    } else { ?>false<?php } ?>"><?php echo $nomest; ?></button>
                                        </li>
                                <?php
                                    } while ($rowest = $resultest->fetch_array());
                                }
                                ?>
                            </ul>
                            <div class="tab-content mt-3" id="myTabContent">
                                <?php
                                $sqlest = "Select * from estudios where idestudio in (select estudios_idestudio from estudiosxservicio where servicios_idservicio='$ids');";
                                $resultest = $db->query($sqlest);
                                if ($rowest = $resultest->fetch_array()) {
                                    $i = 0;
                                    do {
                                        $idest = $rowest['idestudio'];
                                        $nomest = utf8_encode($rowest['nombre']);
                                ?>
                                        <div class="tab-pane fade <?php if ($i == 0) {
                                                                        $i++; ?>show active<?php } ?>" id="Est<?php echo $idest; ?>" role="tabpanel" aria-labelledby="Est<?php echo $idest; ?>-tab">
                                            <h2 class="mb-3"><?php echo $nomest; ?></h2>
                                            <div class="row">
                                                <div class="col">
                                                    Elemento
                                                </div>
                                                <div class="col">
                                                    Dato
                                                </div>
                                                <div class="col">
                                                    Observaciones
                                                </div>
                                                <div class="col">
                                                    Indicadores
                                                </div>
                                                <div class="col">
                                                    Descripción
                                                </div>
                                            </div>

                                            <?php
                                            $sqldat = "select d.*,des.* from datos d, datosxestudiosxservicio des where estudiosxServicio_idestudiosxServicio in
                                            (select idestudiosxServicio from estudiosxservicio where servicios_idservicio='$ids' and estudios_idestudio='$idest')
                                            and d.iddato=des.datos_iddato;";
                                            $resultdat = $db->query($sqldat);
                                            if ($rowdat = $resultdat->fetch_array()) {
                                                do {
                                                    $iddat = $rowdat['iddato'];
                                                    $nomdat = utf8_encode($rowdat['nombre']);
                                                    $inddat = $rowdat['indicadores'];
                                                    $desdat = $rowdat['desc'];
                                                    $datdat = $rowdat['dato'];
                                                    $obsdat = $rowdat['observaciones'];
                                            ?>
                                                    <p>
                                                    <div class="row">
                                                        <div class="col">
                                                            <?php
                                                            echo $nomdat . ": ";
                                                            ?>
                                                        </div>
                                                        <div class="col">
                                                            <input class="form-control" id="dat<?php echo $iddat; ?>" name="dat<?php echo $iddat; ?>" type="text" size="15" value="<?php echo $datdat; ?>" />
                                                        </div>
                                                        <div class="col">
                                                            <textarea class="form-control" style="font-size: small;" id="obs<?php echo $iddat; ?>" name="obs<?php echo $iddat; ?>" rows="2"><?php echo $obsdat; ?></textarea>
                                                        </div>
                                                        <div class="col" style="font-size: small;">
                                                            <?php echo $inddat; ?>
                                                        </div>
                                                        <div class="col" style="font-size: small;">
                                                            <?php echo $desdat; ?>
                                                        </div>
                                                    </div>
                                                    </p>
                                            <?php
                                                } while ($rowdat = $resultdat->fetch_array());
                                            }
                                            ?>

                                        </div>
                                <?php
                                    } while ($rowest = $resultest->fetch_array());
                                }
                                ?>
                            </div>
                            <p id="mensaje"></p>
                            <hr class="divider" />
                            <!-- Submit Button-->
                            <div><button type="submit">Guardar Formulario 1</button></div>
                            <input type="hidden" name="ids" value="<?php echo $ids; ?>">
                        </form>
                    </div>
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
    <!-- Boots trap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
    <!-- Core theme JS-->
</body>

</html>