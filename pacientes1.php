<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Laboratorio - Pacientes</title>
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

</head>

<body id="page-top">
    <!-- Navigation-->
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <span class="navbar-brand mb-0 h1">
                <h1>Paciente</h1>
            </span>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="container-fluid">
                    <a href="home.php" class="btn btn-info"> Menú </a>
                    <a href="pacientes.php" class="btn btn-secondary"> Nuevo Paciente </a>
                    <a href="logout.php" class="btn btn-light"> Salir </a>
                </div>
            </div>
        </nav>
    </div>

    <?php
    if ($_POST["listbox2"] == 0) {
    ?>
        <!-- Contact-->
        <section class="page-section" id="contact">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6 text-center">
                        <h2 class="mt-0">Ingresa los datos del Paciente para su Inscripción!</h2>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
                    <div class="col-lg-6">

                        <form id="contactForm" name="form" action="recibirPaciente.php" target="_self" method="post" enctype="multipart/form-data">
                            <!-- Name input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="apellidos" name="apellidos" type="text" placeholder="Apellidos" required />
                                <label for="apPat">Apellidos</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="name1" name="name1" type="text" placeholder="Nombre" required />
                                <label for="name1">Nombre(s)</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="edad" name="edad" type="text" placeholder="Edad" required />
                                <label for="edad">Edad</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="curp" name="curp" type="text" placeholder="Curp" required />
                                <label for="curp">CURP</label>
                            </div>
                            <!-- Turno input-->
                            <div class="form-floating mb-3">
                                <select class="form-control" id="sexo" name="sexo">
                                    <option value="">Selecciona</option>
                                    <option value="F">Femenino</option>
                                    <option value="M">Masculino</option>
                                </select>
                                <label for="sexo">Sexo</label>
                            </div>
                            <!-- Email address input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="email1" name="email1" type="email" placeholder="nombre@example.com" required />
                                <label for="email1">correo electrónico</label>
                            </div>
                            <!-- Phone number input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" id="phone1" name="phone1" type="tel" placeholder="1234567890" required />
                                <label for="phone1">Teléfono</label>
                            </div>
                            <br>
                            <hr class="divider" />
                            <br>
                            <!-- Submit Button-->
                            <div class="d-grid"><button class="btn btn-primary btn-xl" id="submitButton" type="submit">Nuevo Paciente</button></div>
                            <input type="hidden" value="<?php echo $idp; ?>" name="idp" />
                        </form>
                    </div>
                </div>
            </div>
        </section>
    <?php
    } else {
        include("conectarsislab.php");
        $idp = $_POST["listbox2"];
        $sqlp = "SELECT * FROM pacientes where idpaciente=$idp";
        $resultp = $db->query($sqlp);

        if ($rowp = $resultp->fetch_array()) {
            $nomp = $rowp['nombre'];
            $apel = $rowp['apellidos'];
            $edad = $rowp['edad'];
            $curp = $rowp['curp'];
            $sexo = $rowp['sexo'];
            $email = $rowp['email'];
            $telp = $rowp['tel'];
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
                        <form id="contactForm" name="form" action="nuevoServicio.php" target="_self" method="post" enctype="multipart/form-data">
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
                                        <input class="form-control" id="edad" name="edad" type="text" value="<?php echo $edad; ?>" readonly />
                                        <label for="edad">Edad</label>
                                    </div>
                                </div>
                                <div class="columnCol">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="curp" name="curp" type="text" value="<?php echo $curp; ?>" readonly />
                                        <label for="curp">CURP</label>
                                    </div>
                                </div>
                                <div class="columnCol">
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="sexo" name="sexo" type="text" value="<?php echo $sexo; ?>" readonly />
                                        <label for="edad">Sexo</label>
                                    </div>
                                </div>
                            </div>
                            <div class="containerCol">
                                <div class="columnCol">
                                    <!-- Email address input-->
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="email1" name="email1" type="email" value="<?php echo $email; ?>" readonly />
                                        <label for="email1">correo electrónico</label>
                                    </div>
                                </div>
                                <div class="columnCol">
                                    <!-- Phone number input-->
                                    <div class="form-floating mb-3">
                                        <input class="form-control" id="phone1" name="phone1" type="tel" value="<?php echo $telp; ?>" readonly />
                                        <label for="phone1">Teléfono</label>
                                    </div>
                                </div>
                            </div>
                            <hr class="divider" />
                            <!-- Submit Button-->
                            <div class="d-grid"><button class="btn btn-primary btn-xl" id="submitButton" type="submit">Nuevo Servicio</button></div>
                            <?php
                            $sql = "SELECT s.idservicio,m.nombre as nommed,q.nombre as nomqfb,t.nombre as nomtur, impresionClinica, embarazada,fecha
                                    FROM servicios s, medicos m, qfbs q, turnos t
                                    where pacientes_idpaciente=$idp and medicos_idmedico=m.idmedico and qfbs_idqfb=q.idqfb and turnos_idturno=t.idturno order by s.idservicio desc;";
                            $result = $db->query($sql);

                            if ($result->num_rows > 0) {
                            ?>
                                <h2>Lista de Servicios</h2>
                                <table border='1'>
                                    <tr>
                                        <th style="width: 35%;">impresion</th>
                                        <th style="width: 20%;">Médico</th>
                                        <th style="width: 20%;">Químico</th>
                                        <th style="width: 5%;">Turno</th>
                                        <th style="width: 3%;">Emb</th>
                                        <th style="width: 12%;">fecha</th>
                                        <th style="width: 5%;">Acción</th>
                                    </tr>
                                    <?php
                                    while ($row = $result->fetch_assoc()) {
                                        $ids = $row["idservicio"];
                                        echo "<tr style='font-size: small;'>";
                                        echo "<td>{$row['impresionClinica']}</td>";
                                        echo "<td>" . $row['nommed'] . "</td>";
                                        echo "<td>" . $row['nomqfb'] . "</td>";
                                        echo "<td>{$row['nomtur']}</td>";
                                        echo "<td>{$row['embarazada']}</td>";
                                        echo "<td>{$row['fecha']}</td>";
                                        echo "<td><a href='datosxservicio.php?id={$ids}'>Datos</a>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </table>
                            <?php
                            } else {
                                echo "No hay servicios registrados.";
                            }
                            ?>
                            <input type="hidden" value="<?php echo $idp; ?>" name="idp" />
                        </form>
                    </div>
                </div>
            </div>
        </section>
    <?php

    }
    ?>
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